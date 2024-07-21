<?php

namespace App\Http\Controllers;

use App\Models\TrainData;
use Illuminate\Http\Request;
use League\Csv\Reader;
use League\Csv\Statement;

class TrainDataController extends Controller
{
    public function index()
    {
        $data['trainData'] = TrainData::get();
        return view('admin.traindata.index', $data);
    }

    public function destroy($id)
    {
        $data = TrainData::findOrFail($id);
        $data->delete();
        return redirect()->route('admin.traindata.index')->with('success', 'Data deleted successfully');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required',
        ]);

        $file = $request->file('file');
        if ($file->getClientOriginalExtension() != "csv") {
            return redirect()->back()->with("error", "File required csv.");
        }

        $csv = Reader::createFromPath($file->getRealPath(), 'r');
        $csv->setHeaderOffset(0);
        foreach (["text", "sentiment"] as $header) {
            if (!in_array($header, $csv->getHeader())) {
                return redirect()->back()->with("error", "Header tidak sesuai.");
            }
        }

        $stmt = (new Statement())
            ->offset(0);

        $records = $stmt->process($csv);

        foreach ($records as $record) {
            TrainData::create([
                "text" => $record["text"],
                "sentiment" => $this->mapSentimentToInteger($record["sentiment"]),
                "single_id" => 0
            ]);
        }

        return redirect()->back()->with('success', 'Data added to traindata successfully!');
    }

    public function manyDelete(Request $request)
    {
        $ids = explode(", ", $request->id);
        $sentiments = TrainData::whereIn('id', $ids)->get();

        if ($sentiments->count() > 0) {
            TrainData::whereIn('id', $ids)->delete();

            return redirect()->back()->with('success', 'Data berhasil dihapus dari TrainData!');
        }

        return redirect()->back()->with('error', 'Gagal menghapus data dari TrainData.');
    }

    private function mapSentimentToInteger($sentiment)
    {
        $map = [
            'positif' => 1,
            'negatif' => 0,
        ];

        return $map[$sentiment] ?? 0;  // Default to 0 if sentiment is not found
    }
}

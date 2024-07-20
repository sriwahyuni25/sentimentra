<?php

namespace App\Http\Controllers;

use App\Models\TestData;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Http\Request;
use League\Csv\Reader;
use League\Csv\Statement;

class TestDataController extends Controller
{
    public function index()
    {
        $data['testData'] = TestData::get();
        return view('admin.testdata.index', $data);
    }

    public function destroy($id)
    {
        $data = TestData::findOrFail($id);
        $data->delete();
        return redirect()->route('admin.testdata.index')->with('success', 'Data deleted successfully');
    }

    public function delete($id)
    {
        $testdata = TestData::findOrFail($id);

        if ($testdata) {
            $testdata->delete();

            return redirect()->back()->with('success', 'Data removed from testdata successfully!');
        }

        return redirect()->back()->with('error', 'Failed to remove data from testdata.');
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
            TestData::create([
                "text" => $record["text"],
                "sentiment" => $this->mapSentimentToInteger($record["sentiment"]),
                "single_id" => 0
            ]);
        }

        return redirect()->back()->with('success', 'Data added to testdata successfully!');
    }

    public function downloadTestData()
    {
        $testData = TestData::all();

        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=test-data.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

        $callback = function () use ($testData) {
            $file = fopen('php://output', 'w');

            // Headers
            fputcsv($file, ['Text', 'Sentiment']);

            // Data
            foreach ($testData as $data) {
                $sentiment = $data->sentiment == 1 ? 'positif' : 'negatif';
                fputcsv($file, [$data->text, $sentiment]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
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

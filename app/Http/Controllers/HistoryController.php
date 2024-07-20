<?php

namespace App\Http\Controllers;

use App\Models\Single;
use App\Models\TestData;
use App\Models\TrainData;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function addToTestData(Request $request)
    {
        $sentiment = Single::find($request->id);


        if ($sentiment) {
            $testdata = TrainData::firstOrCreate(
                ['single_id' => $sentiment->id],
                ['sentiment' => $this->mapSentimentToInteger($sentiment->sentiment), 'text' => $sentiment->text]
            );

            return redirect()->back()->with('success', 'Data berhasil ditambahlan ke TrainData!');
        }

        return redirect()->back()->with('error', 'Gagal menambahkan data ke TrainData.');
    }

    public function multiToTestData(Request $request)
    {
        $ids = explode(", ", $request->id);
        $sentiments = Single::whereIn('id', $ids)->get();

        if ($sentiments->count() > 0) {
            foreach ($sentiments as $sentiment) {
                TrainData::firstOrCreate(
                    ['single_id' => $sentiment->id],
                    ['sentiment' => $this->mapSentimentToInteger($sentiment->sentiment), 'text' => $sentiment->text]
                );
            }

            return redirect()->back()->with('success', 'Data berhasil ditambahlan ke TrainData!');
        }

        return redirect()->back()->with('error', 'Gagal menambahkan data ke TrainData.');
    }

    public function deleteMultiFromTestData(Request $request)
    {
        $ids = explode(", ", $request->id);
        $sentiments = TrainData::whereIn('single_id', $ids)->get();

        if ($sentiments->count() > 0) {
            TrainData::whereIn('single_id', $ids)->delete();

            return redirect()->back()->with('success', 'Data berhasil dihapus dari TrainData!');
        }

        return redirect()->back()->with('error', 'Gagal menghapus data dari TrainData.');
    }

    public function deleteFromTestData($id)
    {
        $testdata = TrainData::where('single_id', $id)->first();

        if ($testdata) {
            $testdata->delete();

            return redirect()->back()->with('success', 'Data berhasil dihapus dari TrainData!');
        }

        return redirect()->back()->with('error', 'Gagal menghapus data dari TrainData.');
    }

    // Contoh penghapusan data pada controller
    public function delete($id)
    {
        // Proses penghapusan data

        return redirect()->back()->with('success', 'Data berhasil dihapus.');
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

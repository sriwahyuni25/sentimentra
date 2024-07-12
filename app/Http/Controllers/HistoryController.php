<?php

namespace App\Http\Controllers;

use App\Models\Single;
use App\Models\TestData;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function addToTestData(Request $request)
    {
        $sentiment = Single::find($request->id);

        if ($sentiment) {
            $testdata = TestData::firstOrCreate(
                ['single_id' => $sentiment->id],
                ['sentiment' => $this->mapSentimentToInteger($sentiment->sentiment), 'text' => $sentiment->text]
            );

            return redirect()->back()->with('success', 'Data berhasil ditambahlan ke TestData!');
        }

        return redirect()->back()->with('error', 'Gagal menambahkan data ke TestData.');
    }

    public function deleteFromTestData($id)
    {
        $testdata = TestData::where('single_id', $id)->first();

        if ($testdata) {
            $testdata->delete();

            return redirect()->back()->with('success', 'Data berhasil dihapus dari TestData!');
        }

        return redirect()->back()->with('error', 'Gagal menghapus data dari TestData.');
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

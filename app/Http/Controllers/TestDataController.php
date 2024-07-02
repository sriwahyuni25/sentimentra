<?php

namespace App\Http\Controllers;

use App\Models\TestData;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Http\Request;

class TestDataController extends Controller
{
    public function index()
    {
        $data['testData'] = TestData::all();
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

        $callback = function() use ($testData) {
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
}

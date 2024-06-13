<?php

namespace App\Http\Controllers;

use App\Models\TestData;
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
}

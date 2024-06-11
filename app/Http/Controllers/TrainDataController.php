<?php

namespace App\Http\Controllers;

use App\Models\TrainData;
use Illuminate\Http\Request;


class TrainDataController extends Controller
{
    public function index()
    {
        $data['trainData'] = TrainData::all();
        return view('admin.traindata.index', $data);
    }

    public function destroy($id)
    {
        $data = TrainData::findOrFail($id);
        $data->delete();
        return redirect()->route('admin.traindata.index')->with('success', 'Data deleted successfully');
    }
}

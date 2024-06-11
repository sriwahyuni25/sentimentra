<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CobaController extends Controller
{
    public function index(){
        return view('admin.batchanalysis.index');
    }
    public function tambah(Request $request)
    {
        try {
            $input = $request->name;

            $stemmerFactory = new \Sastrawi\Stemmer\StemmerFactory();
            $stemmer  = $stemmerFactory->createStemmer();

            $output   = $stemmer->stem($input);
            dd($output);
        }catch (\Exception $e) {
        }
    }
}

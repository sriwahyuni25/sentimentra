<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WordcloudController extends Controller
{
    public function index(){
        return view('admin.wordcloud.index');
    }

    public function wordcloudAction(Request $request){
        $options = $request->option;
        if ($options === 'all') {
            $imagePath = 'wordcloud/word-cloud-all.png';
        } else if ($options === 'neg') {
            $imagePath = 'wordcloud/word-cloud-neg.png';
        } else if ($options === 'pos') {
            $imagePath = 'wordcloud/word-cloud-pos.png';
        }

        $selectedSentiment = $request->input('option');
        session(['selectedSentiment' => $selectedSentiment]);

        return view('admin.wordcloud.index', ['image' => $imagePath]);
    }
}

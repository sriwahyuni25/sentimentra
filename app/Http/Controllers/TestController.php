<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

use Illuminate\Support\Facades\Http;

class TestController extends Controller
{
    public function analyzeText(Request $request)
{
    $theUrl = config('app.guzzle_test_url').'/api/analyze/text';
    $response = Http::post($theUrl, [
        'text' => $request->text
    ]);
    return $response;
}

public function analyzeCSV(Request $request)
{
    $theUrl = config('app.guzzle_test_url').'/api/analyze/csv';
    $response = Http::post($theUrl, [
        'file' => $request->file('csv_file')
    ]);
    return $response;
}


    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'http://127.0.0.1:5000/predict',
            'timeout'  => 2.0,
        ]);
    }

    public function getData()
    {
        $response = $this->client->get('data');
        $data = $response->getBody()->getContents();
        return $data;
    }
}

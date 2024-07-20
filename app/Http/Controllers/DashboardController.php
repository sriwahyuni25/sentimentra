<?php

namespace App\Http\Controllers;

use App\Models\Single;
use App\Models\TestData;
use App\Models\TrainData;
use App\Models\Visitor;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use League\Csv\Reader;

class DashboardController extends Controller
{
    public function admin()
    { {
            // Ambil jumlah pengunjung dari database
            $visitorCount = Visitor::distinct('ip_address')->count();

            // Mengambil jumlah data test dan train
            $data = [
                'testDataCount' => TestData::count(),
                'trainDataCount' => TrainData::count(), // Ganti dengan model dan method yang sesuai untuk menghitung data train
                'visitorCount' => $visitorCount
            ];

            // Kirim data ke view 'admin.dashboard.index'
            return view('admin.dashboard.index', $data);
        }
    }


    public function testaja()
    {
        return view('admin.test.index');
    }

    public function test(Request $request)
    {
    }

    public function guest()
    {
        return view('guest.index');
    }

    public function singleAnalysis(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'single' => 'required|string|min:1',
        ], [
            'single.required' => 'Text tidak boleh kosong.',
            'single.string' => 'Text harus berupa string.',
            'single.min' => 'Text tidak boleh kosong.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->withFragment('sentiment');
        }

        $text = [
            'json' => [
                'text' => $request->single,
            ],
        ];
        $client = new Client([
            'verify' => false,
        ]);
        $url = 'https://train-data.sentimentra.my.id/predict';
        try {
            $response = $client->request('POST', $url, $text);
            $data = json_decode($response->getBody(), true);
            // Simpan hasil analisis ke database
            Single::create([
                'text' => $request->single,
                'sentiment' => $data['sentiment'],
                'status' => 'false'
            ]);

            // Kirim data ke view
            return redirect()->route('guest.index')->with([
                'success' =>
                'Analysis Berhasil Dilakukan!',
                'sentiment' => $data['sentiment'],
                'text' => $request->single,
            ])->withFragment('sentiment');
        } catch (\Exception $e) {
            return redirect()->route('guest.index')
                ->withErrors(['error' => 'Error fetching data from API: ' . $e->getMessage()])
                ->withFragment('sentiment');
        }
    }

    public function multiAnalysis(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'texts' => 'required|array|min:1',
            'texts.*' => 'required|string|min:1',
        ], [
            'texts.*.required' => 'Text tidak boleh kosong.',
            'texts.*.string' => 'Text harus berupa string.',
            'texts.*.min' => 'Text tidak boleh kosong.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->withFragment('sentiment');
        }


        $text = [
            'json' => [
                'texts' => $request->texts,
            ],
        ];
        $client = new Client([
            'verify' => false,
        ]);
        $url = 'https://train-data.sentimentra.my.id/predicts';
        try {
            $response = $client->request('POST', $url, $text);
            $responseData = json_decode($response->getBody(), true);
            // Simpan hasil analisis ke database
            foreach ($responseData as $data) {
                Single::create([
                    'sentiment' => $data['sentiment'],
                    'text' => $data['text'],
                    'status' => 'false'
                ]);
            }

            // Kirim data ke view
            return redirect()->route('guest.index')->with([
                'success' =>
                'Analysis Berhasil Dilakukan!',
                'response' => $responseData,
            ])->withFragment('sentiment');
        } catch (\Exception $e) {
            return redirect()->route('guest.index')
                ->withErrors(['error' => 'Training Data Is Not Available.'])
                ->withFragment('sentiment');
        }
    }

    public function batchAnalysis(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|file|mimes:csv,txt|max:2048',
        ], [
            'file.required' => 'File tidak boleh kosong.',
            'file.file' => 'Harap pilih file yang valid.',
            'file.mimes' => 'File harus berformat CSV atau TXT.',
            'file.max' => 'File tidak boleh lebih dari 2048 KB.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->withFragment('sentiment');
        }

        $client = new Client();
        $url = 'http://train-data.sentimentra.my.id/predict_csv';

        try {
            $file = $request->file('file');
            $filePath = $file->getPathname();
            $fileName = $file->getClientOriginalName();
            $fileMime = $file->getMimeType();

            // Membaca file CSV
            $csv = Reader::createFromPath($filePath, 'r');
            $csv->setHeaderOffset(0);
            $header = $csv->getHeader();

            // Memeriksa apakah file CSV memiliki kolom 'text'
            if (!in_array('text', $header)) {
                return redirect()->back()->withErrors(['error' => 'File tidak memiliki kolom text'])->withFragment('sentiment');
            }

            // Membaca semua baris dari kolom 'text'
            $records = $csv->getRecords();
            $textColumn = array_column(iterator_to_array($records), 'text');

            // Memeriksa apakah ada baris pada kolom 'text'
            if (empty($textColumn)) {
                return redirect()->back()->withErrors(['error' => 'Kolom text tidak memiliki baris'])->withFragment('sentiment');
            }

            $response = $client->post($url, [
                'multipart' => [
                    [
                        'name'     => 'file',
                        'contents' => fopen($filePath, 'r'),
                        'filename' => $fileName,
                        'MimeType' => $fileMime
                    ],
                ],
            ]);

            if ($response->getStatusCode() == 200) {
                $responseData = json_decode($response->getBody()->getContents(), true);
                foreach ($responseData as $data) {
                    Single::create([
                        'sentiment' => $data['sentiment'],
                        'text' => $data['text'],
                        'status' => 'false'
                    ]);
                }

                return redirect()->route('guest.index')->with([
                    'success' =>
                    'Analysis Berhasil Dilakukan!',
                    'response' => $responseData,
                ])->withFragment('sentiment');
            } else {
                return redirect()->back()->withErrors(['error' => 'Gagal mengirimkan data ke server.'])->withFragment('sentiment');
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])->withFragment('sentiment');
        }
    }
}

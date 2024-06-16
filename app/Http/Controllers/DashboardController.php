<?php

namespace App\Http\Controllers;

use App\Models\Single;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use League\Csv\Reader;

class DashboardController extends Controller
{
    public function admin()
    {
        return view('admin.dashboard.index');
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
            return redirect()->back()->withErrors($validator)->withInput()->withFragment('about');
        }

        $text = [
            'json' => [
                'text' => $request->single,
            ],
        ];

        $client = new Client();
        $url = 'http://127.0.0.1:5000/predict';

        try {
            $response = $client->request('POST', $url, $text);
            $data = json_decode($response->getBody(), true);

            // Simpan hasil analisis ke database
            Single::create([
                'text' => $request->single,
                'sentiment' => $data['sentiment'],
            ]);

            // Kirim data ke view
            return redirect()->route('guest.index', [
                'sentiment' => $data['sentiment'],
                'text' => $request->single,
                'error' => null
            ])->withFragment('about');
        } catch (\Exception $e) {
            return redirect()->route('guest.index')
                ->withErrors(['error' => 'Error fetching data from API: ' . $e->getMessage()])
                ->withFragment('about');
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
            return redirect()->back()->withErrors($validator)->withInput()->withFragment('about');
        }

        $client = new Client();
        $url = 'http://127.0.0.1:5000/predict_csv';

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
                return redirect()->back()->withErrors(['error' => 'File tidak memiliki kolom text'])->withFragment('about');
            }

            // Membaca semua baris dari kolom 'text'
            $records = $csv->getRecords();
            $textColumn = array_column(iterator_to_array($records), 'text');

            // Memeriksa apakah ada baris pada kolom 'text'
            if (empty($textColumn)) {
                return redirect()->back()->withErrors(['error' => 'Kolom text tidak memiliki baris'])->withFragment('about');
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
                    ]);
                }
                return redirect()->route('guest.index', ['response' => $responseData])->withFragment('about');
            } else {
                return redirect()->back()->withErrors(['error' => 'Gagal mengirimkan data ke server.'])->withFragment('about');
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])->withFragment('about');
        }
    }
}

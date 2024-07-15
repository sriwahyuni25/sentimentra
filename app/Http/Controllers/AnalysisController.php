<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Models\Single;
use Illuminate\Support\Facades\Storage;
use League\Csv\Reader;

class AnalysisController extends Controller
{
    public function singleAnalysis(Request $request)
    {
        // Validasi input
        $request->validate([
            'single' => 'required|string|min:1',
        ], [
            'single.required' => 'Text tidak boleh kosong.',
            'single.string' => 'Text harus berupa string.',
            'single.min' => 'Text tidak boleh kosong.',
        ]);

        $text = [
            'json' => [
                'text' => $request->single,
            ],
        ];

        $client = new Client();
        $url = 'http://train-data.sentimentra.my.id/predict';

        try {
            $response = $client->request('POST', $url, $text);
            $data = json_decode($response->getBody(), true);

            // Simpan hasil analisis ke database
            Single::create([
                'text' => $request->single,
                'sentiment' => $data['sentiment'],
            ]);

            // Kirim data ke view
            return view('admin.singleanalysis.index', [
                'sentiment' => $data['sentiment'],
                'text' => $request->single,
                'error' => null
            ]);
        } catch (\Exception $e) {
            return view('admin.singleanalysis.index', [
                'sentiment' => null,
                'error' => 'Error fetching data from API: ' . $e->getMessage(),
                'text' => $request->single
            ]);
        }
    }


    public function batchAnalysis(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:csv,txt|max:2048',
        ], [
            'file.required' => 'File tidak boleh kosong.',
            'file.file' => 'Harap pilih file yang valid.',
            'file.mimes' => 'File harus berformat CSV atau TXT.',
            'file.max' => 'File tidak boleh lebih dari 2048 KB.',
        ]);

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
                return redirect()->back()->withErrors(['error' => 'File tidak memiliki kolom text']);
            }

            // Membaca semua baris dari kolom 'text'
            $records = $csv->getRecords();
            $textColumn = array_column(iterator_to_array($records), 'text');

            // Memeriksa apakah ada baris pada kolom 'text'
            if (empty($textColumn)) {
                return redirect()->back()->withErrors(['error' => 'Kolom text tidak memiliki baris']);
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
                return view('admin.batchanalysis.index', ['response' => $responseData]);
            } else {
                return redirect()->back()->withErrors(['error' => 'Gagal mengirimkan data ke server.']);
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }


    public function showData()
    {
        $sentiments = Single::all();
        return view('admin.historyanalysis.index', compact('sentiments'));
    }

    // public function deleteData($id)
    // {
    //     try {
    //         $sentiments = Single::where('id', $id)->first();
    //         $sentiments->delete();
    //         return back()->with('success','Data berhasil Dihapus.');
    //     } catch (\Exception $e) {
    //         return back()->with($e->getMessage());
    //     }
    // }

    public function deleteData($id)
    {
        try {
            $sentiment = Single::findOrFail($id);
            $sentiment->delete();
            return back()->with('success', 'Data berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function falsestatus($id){
        $params['status'] = 'true';
        $status = Single::where('id', $id)->first();
        if ($status->update($params)) {
            return back()->withErrors(['error' => 'Gagal mengirimkan data ke server.']);
        } else {
            return back()->withErrors(['error' => 'Gagal mengirimkan data ke server.']);
        }
        return back()->withErrors(['error' => 'Gagal mengirimkan data ke server.']);

    }
    public function truestatus($id){
        $params['status'] = 'false';
        $status = Single::where('id', $id)->first();
        if ($status->update($params)) {
            return back()->withErrors(['error' => 'Gagal mengirimkan data ke server.']);
        } else {
            return back()->withErrors(['error' => 'Gagal mengirimkan data ke server.']);
        }
        return back()->withErrors(['error' => 'Gagal mengirimkan data ke server.']);
    }
}

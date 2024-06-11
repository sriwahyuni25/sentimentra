<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ImportController extends Controller
{
    public function importCsv()
    {
        // Path to your CSV file
        $filePath = 'D:/SKRIPSHE/DATA/data train-test/test_data.csv';

        if (!File::exists($filePath)) {
            return response()->json(['message' => 'File not found.'], 404);
        }

        try {
            // Enable local infile option for this session
            DB::statement("SET GLOBAL local_infile = 1");

            // Load data from CSV file into the database
            $query = "
                LOAD DATA LOCAL INFILE '{$filePath}'
                INTO TABLE test_data
                FIELDS TERMINATED BY ','
                LINES TERMINATED BY '\n'
                IGNORE 1 ROWS
                (text, sentiment)
            ";

            DB::connection()->getpdo()->exec($query);

            return response()->json(['message' => 'Data imported successfully.']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error importing data: ' . $e->getMessage()], 500);
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class RecordController extends Controller
{
	public function add_record(Request $request) {
		$error = $request->input('error');
		return view('add_record', ['error' => $error]);
	}

	public function all_records() {
		$jsonFiles = File::files(storage_path('records'));

		$data = [];
		foreach ($jsonFiles as $jsonFile) {
			$jsonData = file_get_contents($jsonFile);
			$decodedData = json_decode($jsonData, true);
			$data[] = $decodedData;
		}

		return view('all_records', ['records' => $data]);
	}

	public function record(Request $request) {
        $fileName = $request->input('filename');
        $filePath = storage_path("records/{$fileName}");


        if (File::exists($filePath)) {

            $jsonData = file_get_contents($filePath);
            $record = json_decode($jsonData, true);
        } else {
            return response()->json(['error' => 'File not found'], 404);
        }
		
		return view('record', compact('record'));
	}

	public function store(Request $request) {
		$validData = Validator::make($request->all(), [
			'title' => 'required|string|max:255',
			'content' => 'required|string',
			'author' => 'string|max:50',
		]);

		if ($validData->fails()) {
			return redirect('add_record?error='.$validData->errors());
		}
		echo $request->input('title');
		$record = [
			'title' => $request->input('title'),
			'content' => $request->input('content'),
            'author' => $request->input('author'),
		];
        
		$filename = 'record_' . uniqid() . '.json';
		File::put(storage_path('records/' . $filename), json_encode($record, JSON_UNESCAPED_UNICODE));

		return redirect('/record?filename=' . $filename);
    }
}

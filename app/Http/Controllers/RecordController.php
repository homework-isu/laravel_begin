<?php

namespace App\Http\Controllers;

use App\Models\Record;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

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

	public function record($id) {
        $record = Record::find($id);
		return view('record', compact('record'));
	}

	public function store(Request $request) {
		$data  = $request->validate([
			'title' => ['required', 'string'],
			'text' => ['required', 'string'],
		]);
		
		$data['user_id'] = Auth::id();
        
		$record = Record::add_record($data);
		return redirect('/record/' . $record->id);
    }
}

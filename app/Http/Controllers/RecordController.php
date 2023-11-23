<?php

namespace App\Http\Controllers;

use App\Models\Record;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecordController extends Controller
{
	public function add_record(Request $request) {
		$error = $request->input('error');
		return view('record.add_record', ['error' => $error]);
	}

	public function update_record($id) {
		$user_id = Auth::id();
		$record = Record::get_record_for_effect($user_id, $id);
		if ($record != null) {
			return view('record.update_record', compact('record'));
		} else {
			return back();
		}
	}

	public function all_records() {
		$data = Record::get_all_records();
		return view('record.all_records', ['records' => $data]);
	}

	public function record($id) {
        $record = Record::get_record($id);
		return view('record.record', compact('record'));
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

	public function delete(Request $request) {
		$data  = $request->validate([
			'id' => ['required', 'numeric'],
		]);
		Record::destroy($data['id']);
		return back();
	}

	public function update(Request $request) {
		$data  = $request->validate([
			'id' => ['required', 'numeric'],
			'title' => ['required', 'string'],
			'text' => ['required', 'string'],
		]);
		$record = Record::find($data['id']);
		$record->update($data);
		return redirect('/profile/');
	}
}

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
			'publish_at_time' => ['nullable', 'boolean'],
			'publisher_time' => ['nullable', 'date_format:Y-m-d\TH:i']
		]);
		$data['user_id'] = Auth::id();
        // dd($data);
		$record = Record::add_record($data);
		return redirect('/record/' . $record->id);
    }

	public function delete(Request $request) {
		$data  = $request->validate([
			'id' => ['required', 'numeric'],
		]);

		if (Record::can_user_edit(Auth::id(), $data['id'])) {
			Record::destroy($data['id']);
			return back();
		}
		return back()->withErrors([
            'error' => 'You can not eddit this note',
        ]);
	}

	public function update(Request $request) {
		$data  = $request->validate([
			'id' => ['required', 'numeric'],
			'title' => ['required', 'string'],
			'text' => ['required', 'string'],
		]);
		$user_id = Auth::id();
		if (Record::can_user_edit($user_id, $data['id'])) {
			$record = Record::find($data['id']);
			$record->update($data);
			return redirect('/profile/');
		}
		
		return back()->withErrors([
            'error' => 'You can not eddit this note',
        ]);
	}

	public function remove_note_from_publication(Request $request) {
		$data  = $request->validate([
			'id' => ['required', 'numeric'],
		]);
		$user_id = Auth::id();
		
		if (Record::can_user_edit($user_id, $data['id'])) {
			$note = Record::find($data['id']);
			$note->update(['removed_from_publication' => true]);
			return back();
		}
		dd($data);
		return back()->withErrors([
            'error' => 'You can not eddit this note',
        ]);
	}

	public function return_record_to_publication(Request $request) {
		$data  = $request->validate([
			'id' => ['required', 'numeric'],
		]);
		$user_id = Auth::id();
		if (Record::can_user_edit($user_id, $data['id'])) {
			$note = Record::find($data['id']);
			$note->update(['removed_from_publication' => false]);

			return back();
		}
		return back()->withErrors([
            'error' => 'You can not eddit this note',
        ]);
	}
}

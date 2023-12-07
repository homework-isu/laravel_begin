<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Record;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;



class UserController extends Controller
{
    public function get($id) {
		if ($id == null) {
			return 'no id';
		}
		$user = User::find($id);
		if ($user) {
			$name = $user->toArray();
			dump($name);
		} else {
			return 'User not found';
		}
	}

	public function profile() {
		$user = Auth::user();
		$records = Record::get_all_user_records($user->id);
		$comments = [];
		foreach ($records as $record) {
			$comments[$record['id']] = Comment::get_comments_for_record($record['id']);
		}
		return view('user.profile', compact('user', 'records', 'comments'));
	}
}

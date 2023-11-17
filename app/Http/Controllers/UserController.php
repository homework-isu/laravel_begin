<?php

namespace App\Http\Controllers;

use App\Models\User;
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
		if (Auth::check()) {
			$user = Auth::user();
			return view('user.profile', compact('user'));
		} else {
			redirect('/login');
		}
	}
}
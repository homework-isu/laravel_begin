<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

function creatSalt($str) {
	return bcrypt($str);
}

class AuthController extends Controller
{
    public function login_page() {
		return view('auth.login_page');
	}

	public function register_page() {
		return view('auth.register_page');
	}

	public function login(Request $request) {

		$credentials  = $request->validate([
			'username' => ['required', 'string', 'min:3', 'max:20', 'regex:/^[a-zA-Z0-9\.\_\-\']+$/', 'alpha'],
			'password' => ['required', 'string', 'min:5', 'max:20', 'regex:/^[a-zA-Z0-9\.\_\-\']+$/', 'alpha'],
		]);

		$user = User::login($credentials);

		if (Auth::attempt($credentials) && $user) {
			auth(guard: 'web')->login($user);
			return redirect('/profile');
		}

		return back()->withErrors([
            'summary' => 'Invalid username or password',
        ]);
	}

	
	public function register(Request $request) {
		$credentials = $request->validate([
			'username' => ['required', 'string', 'min:3', 'max:20', 'regex:/^[a-zA-Z0-9\.\_\-\']+$/', 'unique:users,username'],
			'name' => ['required', 'string', 'alpha'],
			'surname' => ['required', 'string', 'alpha'],
			'password' => ['required', 'string', 'min:5', 'max:20', 'regex:/^[a-zA-Z0-9\.\_\-\']+$/', 'confirmed'],
		]);

		$credentials['password'] = creatSalt($credentials['password']);
		$user = User::register_user($credentials);
		if ($user == null) {
			return "username already exists";
		}

		if ($user) {
			auth(guard: 'web')->login($user);
		}

		return redirect('/profile');
	}

	public function logout() {
		Auth::logout();
		return redirect('/login');
	}
}

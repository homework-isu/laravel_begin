<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function create_comment(Request $request) {
		$data  = $request->validate([
			'record_id' => ['required', 'numeric'],
			'text' => ['required', 'string'],
		]);
		$data['user_id'] = Auth::id();
		// dd($data);
		$comment = Comment::create($data);
		return response()->json([
			'id' => $comment->id,
			'user_id' => $comment->user_id,
			'record_id' => $comment->record_id,
			'text' => $comment->text,
		]);
	}

	public function get_comments_for_record($record_id) {
		$data = Comment::get_comments_for_record($record_id);
		return response()->json($data);
	}

	public function get_comments_count_for_record($record_id) {
		$data = Comment::get_comments_count_for_record($record_id);
		return response()->json(['count' => $data]);
	}

}

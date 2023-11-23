<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
	protected $table = 'comments';
	protected $primaryKey = 'id';
	protected $fillable = [
        'user_id', 'record_id','text'
    ];

	static public function get_comments_for_record($record_id) {
		$query = Comment::join('users', 'comments.user_id', '=', 'users.id')->select('comments.id', 'users.username', 'comments.text', 'comments.created_at')->where("comments.record_id", $record_id);
		return $query->get();
	}

	static public function get_comments_count_for_record($record_id) {
		$count = Comment::where('record_id', $record_id)->count();;
		return $count;
	}
}

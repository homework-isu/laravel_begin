<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    use HasFactory;
	protected $table = 'records';
	protected $primaryKey = 'id';
	protected $fillable = [
        'user_id', 'title','text'
    ];

	static public function add_record($data) {
		return Record::create($data);
	}

	static public function get_user_records($user_id) {
		return Record::find($user_id);
	}

	static public function get_record($id) {
		$query = Record::join('users', 'records.user_id', '=', 'users.id')->select('records.*', 'users.username')->where("records.id", $id);
		return $query->first();
	}

	static public function get_all_records() {
		$query = Record::join('users', 'records.user_id', '=', 'users.id')->select('records.*', 'users.username');
		return $query->get();
	}

	static public function get_all_user_records($user_id) {
		$query = Record::join('users', 'records.user_id', '=', 'users.id')->select('records.*', 'users.username')->where("user_id", $user_id);
		return $query->get();
	}

	static public function get_record_for_effect($user_id, $record_id) {
		$query = Record::select('records.*')->where('user_id', $user_id)->where('id', $record_id);
		return $query->first();
	}	

}

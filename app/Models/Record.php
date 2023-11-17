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

}

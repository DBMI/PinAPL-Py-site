<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/*
+------------+------------------+------+-----+---------+----------------+
| Field      | Type             | Null | Key | Default | Extra          |
+------------+------------------+------+-----+---------+----------------+
| id         | int(10) unsigned | NO   | PRI | NULL    | auto_increment |
| name, 100  | varchar(255)     | NO   |     | NULL    |                |
| email      | varchar(100)     | NO   |     | NULL    |                |
| status     | varchar(25)      | NO   |     | NULL    |                |
| dir        | varchar(25)      | NO   |     | NULL    |                |
| created_at | timestamp        | YES  |     | NULL    |                |
| updated_at | timestamp        | YES  |     | NULL    |                |
+------------+------------------+------+-----+---------+----------------+

 */
class Run extends Model 
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'email', 'status', 'dir'
	];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	// protected $hidden = [
		
	// ];
	
	public function directory()
	{
		return storage_path()."/runs/$this->dir";
	}
}

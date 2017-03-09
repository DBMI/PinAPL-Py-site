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

	public function delete()
	{
		File::deleteDirectory($this->directory);
		parent::delete();
	}

	public function url()
	{
		return "http://pinapl-py.ucsd.edu/run/".$this->dir;
	}

	public function redirectFromStatus($status)
	{
		$hash = $this->dir;
		$runStatus = strtolower(trim($this->status));
		if ($runStatus == "finished" || $runStatus == "error" || $runStatus == "queued") {
			\Log::debug("Status: ".$runStatus." --- Set to running");
			$runStatus = "running";
		}
		if ($runStatus == $status) {
			return false;
		}
		switch ($runStatus) {
			case 'uploading':
				return redirect("/upload/$hash");
				break;
			case 'error':
			case 'running':
			case 'queued':
			case 'finished':
				return redirect("/run/$hash");
				break;
			case 'managing-files':
				return redirect("/files/$hash");
				break;
			case 'setting-parameters':
				return redirect("/parameters/$hash");
				break;
			default:
				abort(404);
		}
	}
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\RunController;

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
		'name', 'email', 'status', 'dir', 'data_dir'
	];


  // Get gene rankings belonging to this run
  public function geneRankings()
  {
    return $this->hasMany('App\GeneRanking', 'dir', 'dir');
  }

  // Get gene combined rankings belonging to this run
  public function geneCombinedRankings()
  {
    return $this->hasMany('App\GeneCombinedRanking', 'dir', 'dir');
  }

  // Get sgrna rankings belonging to this run
  public function sgrnaRankings()
  {
    return $this->hasMany('App\SgrnaRanking', 'dir', 'dir');
  }


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
		\File::deleteDirectory($this->directory());
		$dataDir = $this->data_dir;
		// If this is the only run using it's data AND it's data is not the example data
		if (Run::where('data_dir',$dataDir)->count() == 1 && $dataDir != 'example-run'){
			\File::deleteDirectory(storage_path("/data/$dataDir"));
		}
		$this->geneRankings()->delete();
		$this->geneCombinedRankings()->delete();
		$this->sgrnaRankings()->delete();
		return parent::delete();
	}

	public function url()
	{
		return "http://pinapl-py.ucsd.edu/run/".$this->dir;
	}

	/**
	 * Return the mapping of files to samples
	 * @param string $dir Optional directory, name of run folder; to get mapping without database entry (e.g. example run)
	 * 
	 * @return object array
	 */
	public static function getMapping($dir=null){
		// Assume this has a database entry;
		if ($dir == null) {
			$dir = $this->dir;
		}
		$file = storage_path("/runs/$dir/workingDir/DataSheet.xlsx");
		$mapping = \Excel::load($file)->get();
		return $mapping;
	}

	/**
	 * Return the treatments 
	 * @param string $dir Optional directory, name of run folder; to get treatments without database entry (e.g. example run)
	 * 
	 * @return object array
	 */
	public static function getTreatmentsFromXlsx($dir=null){
		$mapping = self::getMapping($dir);
		return self::getTreatments($mapping);
	}

	public function getTreatments($mapping=null)
	{
		if (!empty($mapping)) {
			$mapping = $this->getMapping($this->dir);
		}
		return RunController::getTreatments($mapping);
	}

	public function redirectFromStatus($status)
	{
		$hash = $this->dir;
		$runStatus = strtolower(trim($this->status));
		if ($runStatus == "finished" || $runStatus == "error" || $runStatus == "queued" || $runStatus == "compressing" ) {
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
				\Log::error('RunId:'.$this->status.' Unknown run status:'.$runStatus);
				abort(404);
		}
	}

	public function importRankings(){
		$dir = $this->dir;	
		RunController::importRankings($dir);
	}
}

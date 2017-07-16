<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SgrnaRanking extends Model
{
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'sgrna_rankings';

	/**
	 * Indicates if the model should be timestamped.
	 *
	 * @var bool
	 */
	public $timestamps = false;

	// Get run which owns this ranking
  public function run()
  {
    return $this->hasOne('App\Run', 'dir', 'dir');
  }

  public static $columns = [
	  'sgrna'=>'sgRNA',
	  'gene'=>'Gene',
	  'counts'=>'Counts',
	  'control_mean'=>'Control Mean',
	  'control_stdev'=>'Control StDev',
	  'fold_change'=>"Fold Change",
	  'p_value'=>"p_value",
	  'fdr'=>"FDR",
	  'significant'=>'Significant'
	];
 }

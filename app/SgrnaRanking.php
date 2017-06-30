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
	protected $table = 'sgrna_ranking';

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
 }

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GeneCombinedRanking extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */	
    protected $table = 'gene_combined_rankings';

	/**
	 * The attributes that aren't mass assignable.
	 *
	 * @var array
	 */
	protected $guarded = ['id'];

	// Get run which owns this ranking
	public function run() {
		return $this->hasOne('App\Run', 'dir', 'dir');
	}

	/**
	 * Indicates if the model should be timestamped.
	 *
	 * @var bool
	 */
	public $timestamps = false;

	public static $columns = [
	  'gene'=>'Gene',
	  'fisher_statistic' => 'Fisher Statistic',
	  'p_Value_combined' => 'p-value Combined',
	  'significant'=>'Significant',
	];
}

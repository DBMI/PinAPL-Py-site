<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GeneRanking extends Model
{
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */	
	protected $table = 'gene_rankings';

	/**
   * The attributes that aren't mass assignable.
   *
   * @var array
   */
	protected $guarded = ['id'];

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
	  'gene'=>'Gene',
	  'arra'=>'Gene Score',
	  'arra_p_value'=>'Gene Score p_value',
	  'arra_fdr'=>'Gene Score FDR',
	  'significant'=>'Significant',
	  'num_sgrna' => '# sgRNAs',
	  'num_sig_sgrna'=>"# Signif. sgRNAs",
	  'avg_log_fc'=>"Avg. Log FC",
	];
  
}

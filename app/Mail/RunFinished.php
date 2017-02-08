<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RunFinished extends Mailable
{
	use Queueable, SerializesModels;

	protected $run;

	/**
	 * Create a new message instance.
	 *
	 * @return void
	 */
	public function __construct($run)
	{
		$this->run = $run;
	}

	/**
	 * Build the message.
	 *
	 * @return $this
	 */
	public function build()
	{
		return $this->view('emails.run_finished')
			->with([
					'runUrl'=>$this->run->url(), 
					'runName' => $this->run->name,
				]
		);
	}
}

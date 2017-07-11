<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class BugReport extends Mailable
{
    use Queueable, SerializesModels;

    protected $url;
    protected $description;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($description, $url="")
    {
        $this->url = $url;
        $this->description = $description;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.bug_report')
            ->with([
                    'url'=>$this->url, 
                    'description' => $this->description,
                ]
        );
    }
}

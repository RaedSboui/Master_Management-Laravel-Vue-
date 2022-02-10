<?php

namespace App\Mail;

use App\Models\Candidacy;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CandidacyResultMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $candidacy;
    public $view;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Candidacy $candidacy)
    {
        $this->candidacy = $candidacy;

        switch ($candidacy->result) {
            case 'Accepted':
                $this->view = 'acceptedCandidacy';
                break;
            case 'Refused':
                $this->view = 'refusedCandidacy';
                break;
            case 'Pending':
                $this->view = 'pendingCandidacy';
                break;
        }
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('raedsboui1995@gmail.com')
                    ->subject('Masters Application Result')
                    ->view('emails.'.$this->view , [
                        'candidacy' => $this->candidacy,
                    ]);
    }
}

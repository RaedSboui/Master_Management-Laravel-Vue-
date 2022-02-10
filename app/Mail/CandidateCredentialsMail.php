<?php

namespace App\Mail;

use App\Models\Candidate;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CandidateCredentialsMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $candidate;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Candidate $newCandidate)
    {
        $this->candidate = $newCandidate;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('raedsboui1995@gmail.com')
                    ->subject('Your application to Masters')
                    ->view('emails.candidateCredentials', [
                        'candidate' => $this->candidate,
                    ]);
    }
}

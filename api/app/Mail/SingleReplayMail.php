<?php

namespace App\Jobs;

use App\Mail\SingleReplayMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Mail\Mailer;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendSingleReplayJob implements ShouldQueue
{
    use Queueable;


    protected string $MessageOwnerName;
    protected string $MessageOwnerEmail;
    protected string $replaySubject;
    protected string $replayMessage;

    /**
     * Create a new job instance.
     */
    public function __construct(string $name, string $email, string $subject, string $message)
    {
        $this->MessageOwnerName = $name;
        $this->MessageOwnerEmail = $email;
        $this->replaySubject = $subject;
        $this->replayMessage = $message;
    }

    /**
     * Execute the job.
     */
    public function handle(Mailer $mailer): void
    {
        $mailer->to($this->MessageOwnerEmail)->send(new SingleReplayMail($this->replaySubject, $this->replayMessage, $this->MessageOwnerName));
    }
}

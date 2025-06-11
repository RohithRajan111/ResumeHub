<?php

namespace App\Jobs;

use App\Mail\ActionResultMail;
use App\Mail\AdminNotificationMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendUserMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $validated;
    public $filepath; // Relative

    public function __construct(array $validated, string $filepath)
    {
        $this->validated = $validated;
        $this->filepath = $filepath;
    }

    public function handle(): void
    {
        $fullPath = public_path($this->filepath); // Make absolute for attachment

        if (!empty($this->validated['email']) && filter_var($this->validated['email'], FILTER_VALIDATE_EMAIL)) {
            Mail::to($this->validated['email'])->send(new ActionResultMail(
                $this->validated['name'],
                $this->validated['email'],
                $this->validated['phone'],
                $fullPath
            ));
        }

        Mail::to('rohithrajan111@gmail.com')->send(new AdminNotificationMail(
            $this->validated['name'],
            $this->validated['email'],
            $this->validated['phone'],
            $fullPath
        ));
    }
}

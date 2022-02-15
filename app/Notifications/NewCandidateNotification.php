<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewCandidateNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $applicant;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($applicant)
    {
        $this->applicant = $applicant;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }


    public function toDatabase($notifiable)
    {
        return [
            'job' => $this->applicant->job,
            'candidate' => $this->applicant->user,
            'user' => $this->applicant->job->user,
            'time' => $this->applicant->time
        ];
    }


    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'data' => [
                'job' => $this->applicant->job,
                'candidate' => $this->applicant->user,
                'user' => $this->applicant->job->user,
                'time' => $this->applicant->time
            ]
        ]);
    }
}

<?php

namespace App\Notifications;

use App\Models\Notice;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NoticeSent extends Notification
{
    use Queueable;

    private $notice;
    private $notifyViaEmail;

    /**
     * Create a new notification instance.
     * @param Notice $notice
     * @param bool $notifyViaEmail
     */
    public function __construct(Notice $notice, $notifyViaEmail = false)
    {
        $this->notice         = $notice;
        $this->notifyViaEmail = $notifyViaEmail;
    }

    /**
     * Get the notification's delivery channels.
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        if ($this->notifyViaEmail)
        {
            return [ 'mail', 'database' ];
        }
        else
        {
            return [ 'database' ];
        }
    }

    /**
     * Get the mail representation of the notification.
     * @param  mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return ( new MailMessage )->line('Notification Received')->action('View', route('notice.show', $this->notice->slug))->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     * @param  mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'notice_id' => $this->notice->id,
            'message'   => 'Notification Received!'
        ];
    }
}

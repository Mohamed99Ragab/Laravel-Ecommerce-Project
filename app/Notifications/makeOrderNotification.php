<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use function Symfony\Component\Translation\t;

class makeOrderNotification extends Notification
{
    use Queueable;

    public $username;
    public $order_id;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user,$order_id)
    {
        $this->username = $user->first_name." ".$user->last_name ;
        $this->order_id = $order_id;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }



    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'title'=>'Order Request',
            'body'=>"{you have order by {$this->username}",
            'order_id'=>$this->order_id,
        ];
    }
}

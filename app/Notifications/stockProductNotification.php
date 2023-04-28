<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class stockProductNotification extends Notification
{
    use Queueable;
    public $product_id;
    public $product_name;
    public $product_quantity;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($product_id,$product_name,$product_quantity)
    {
        $this->product_id = $product_id;
        $this->product_name = $product_name;
        $this->product_quantity = $product_quantity;
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
            'title'=>"notify about product quantity",
            'body'=>"quantity of this {$this->product_name} is {$this->product_quantity} items should increase stock ",
            'product_id'=>$this->product_id,
        ];
    }
}

<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MessageSent extends Notification
{
    use Queueable;
    public $message; //se declara propiedad message para almacenar el mensaje recibido por el método constructor

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($message)
    {
        $this->message = $message;
        return ['mail'];
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {   /*First and default option to send the message*/
        /*return (new MailMessage)
                    ->subject('Tienes un mensaje nuevo')
                    ->greeting('Hola!')
                    ->line('Haz click en el botón para acceder al mensaje')
                    ->action('Ver Mensaje', route('messages.show', $this->message->id))
                    ->line('Hasta Luego!');*/

        /*Message using markdown method*/
        return (new MailMessage)
                    ->subject('Tienes un mensaje nuevo')
                    ->markdown('mail.message', ['message' => $this->message]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'url' => route('messages.show', $this->message->id),
            'message' => 'Has recibido un mensaje de ' .  User::find($this->message->from_user_id)->name
        ];
    }
}

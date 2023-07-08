<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NuevoCandidato extends Notification
{
    use Queueable;

    public $id_vacante;
    public $nombre_vacante;
    public $usuario_id;

    /**
     * Create a new notification instance.
     */
    // pasar informacion del componente PostularVacante.php, hacia la notoficacion
    public function __construct($id_vacante, $nombre_vacante, $usuario_id)
    {
        $this->id_vacante     = $id_vacante;
        $this->nombre_vacante = $nombre_vacante;
        $this->usuario_id     = $usuario_id;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        // Ademas de enviar la notificacion via email, indicamos q debe almacenarse en la db
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        // la notificacion se envia al reclutador
        $url = url('/notificaciones');
        return (new MailMessage)
                    ->line('Has recibido un nuevo candidato en tu vacante.')
                    ->line('La vacante es: ' . $this->nombre_vacante)
                    ->action('Ver Notificaciones', $url)
                    ->line('Gracias por utilizar DevJobs');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }

    // Almacena las notificaciones en la DB
    public function toDatabase($notifiable)
    {
        // retornamos un arreglo y se convierte en un obj para alamacenarse en la DB
        return [
            // almacenar la informacion para q el usuario la pueda leer
            'id_vacante'     => $this->id_vacante,
            'nombre_vacante' => $this->nombre_vacante,
            'usuario_id'     => $this->usuario_id
        ];
    }
}

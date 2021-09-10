<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Empleado;
use App\Models\Cliente;
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
        VerifyEmail::toMailUsing(function ($notifiable, $url) {
            //$user = User::findOrFail($notifiable->id);
            if ($notifiable->tipo == 0) {
                $empleado = Empleado::where('idUsuario', '=', $notifiable->id)->first();
                return (new MailMessage)
                    ->subject('Confirme su dirección de correo electrónico para Farmacias GI')
                    ->line('Le informamos que la clave con la que podra relaizar las ventas será el siguiente: ' . $empleado->claveE)
                    ->line('Haga clic en el botón de abajo para verificar su dirección de correo electrónico. ')
                    ->action('Verify Email Address', $url)
                    ->line('Si más por el momento le agradecemos por fomar parte de Farmacias GI');
            }
            if($notifiable->tipo == 2){
                $cliente = Cliente::where('idUsuario', '=', $notifiable->id)->first();
                return (new MailMessage)
                    ->subject('Por favor confirme su dirección de correo electrónico para que pueda disfrutar de todos lo beneficios de Farmacias GI')
                    ->line($cliente->nombre.' '.$cliente->apellidoPaterno.' '.$cliente->apellidoMaterno.' '.'Muchas gracias por registrarse, ahora podra realizar compras en nuestra tienda online')
                    ->line('Haga clic en el botón de abajo para verificar su dirección de correo electrónico. ')
                    ->action('Verify Email Address', $url)
                    ->line('Si más por el momento le agradecemos por confiar en nuestro servicio Farmacias GI');
            }
        });
    }
}

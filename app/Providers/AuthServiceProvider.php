<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Mail\SendEmailVerificationMail;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Mail\Markdown;
use Illuminate\Notifications\Messages\MailMessage;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
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
       
        VerifyEmail::toMailUsing(function ($notifiable,$url){
            return (new MailMessage)
                    ->markdown("verification_mail",compact('notifiable','url'));
                // ->subject('Verification du compte')
                // ->line('Cliquez sur le bouton suivant pour valider votre compte.')
                // ->action('Verify Email Address', $url);
//            return (new SendEmailVerificationMail($notifiable,$url))->cc("bakari@gmail.com") ;
        });
    }
}

<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\Models\UserExperience;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMailAtUserForPurchaseExperienceTourist extends Mailable
{
    use Queueable, SerializesModels;

    public $user_experience;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(UserExperience $user_experience)
    {
        $this->user_experience = $user_experience;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('sidriz@technodatasolutions.bj')
                    ->subject('Nouvelle commande d\'une expérience utilisateur')
                    ->markdown('emails.send-mail-at-user-for-purchase-experience-tourist')
                    ->with([
                        'user_experience' => $this->user_experience,
                    ]);
    }
}

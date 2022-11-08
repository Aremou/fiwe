<?php

namespace App\Mail;

use App\Models\UserExperience;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMailAtAdminForPurchaseExperienceTourist extends Mailable
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
                    ->subject('Notification de nouvelle commande FIWE')
                    ->markdown('emails.send-mail-at-admin-for-purchase-experience-tourist')
                    ->with([
                        'user_experience' => $this->user_experience,
                    ]);
    }
}

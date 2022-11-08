<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\Models\InterestCenter;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMailForInteresteCenterAddByUser extends Mailable
{
    use Queueable, SerializesModels;

    public $id;
    public $label;
    public $description;
    public $image;
    public $location;
    public $category;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(InterestCenter $interest_center)
    {
        $this->id = $interest_center->id;
        $this->label = j_json_decode($interest_center->label, 'fr');
        $this->description = j_json_decode($interest_center->description, 'fr');
        $this->image = $interest_center->image_id;
        $this->location = show_location($interest_center->geolocation_id);
        $this->category =j_json_decode($interest_center->interest_center_category->label, 'fr');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('sidriz@technodatasolutions.bj')
                    ->subject('Demande de validation d\'un centre intérêt')
                    ->markdown('emails.send-mail-for-interest-center-add-by-user')
                    ->with([
                        'id' => $this->id,
                        'label' => $this->label,
                        'description' => $this->description,
                        'image' => $this->image,
                        'category' => $this->category,
                        'location' => $this->location,
                    ]);
    }
}

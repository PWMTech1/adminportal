<?php

namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use InvModels\SharedModels\User;


class SendMailable extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    public $password;
    public $type;
    
    public function __construct(User $user, $password, $type) {
        $this->user = $user;
        $this->password = $password;
        $this->type = $type;
    }
    
    public function build(){
        if($this->type == "welcome"){
            return $this->from('no-reply@pinnaclewoundmanagement.com', 'No reply')->subject('Pinnacle Wound Management Portal - New User Registration')->view('emails.welcome');
        }
        if($this->type == "mileage"){
            return $this->from('no-reply@pinnaclewoundmanagement.com', 'No reply')->subject('Mileage Approval pending')->view('emails.mileage');
        }
        if($this->type == "ordersupplies"){
            return $this->from('no-reply@pinnaclewoundmanagement.com', 'No reply')->subject('Order Supplies Approval pending')->view('emails.ordersupplies');
        }
    }
}
<?php

namespace Utyemma\Notifire;

use Illuminate\Mail\Mailable as MailMailable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\HtmlString;
use Utyemma\Notifire\Models\Mailable;
use Utyemma\Notifire\Notifications\MailableNotification;

class Notify extends MailMessage {

    public $content = [];
    private Mailable $mail;


    public function __construct(string $subject = '', $data = []) {
        $this->content = $data;

        if(class_exists($subject)){
            $this->mail = Mailable::where('mailable', get_class($this))->first();
            return $this->parse($data);
        }

        $this->subject($subject);
    }

    function send($receivers, $channels = null){
        if(is_string($receivers)) return $this->mail($receivers)->send($this->mailable());
        return Notification::send($receivers, new MailableNotification($channels, $this));
    }

    function sendNow($receivers, $channels = null){
        if(is_string($receivers)) return $this->mail($receivers)->send($this->mailable());
        return Notification::sendNow($receivers, new MailableNotification($channels, $this));
    }

    function mailable(){
        $mailable = new MailMailable();
        $mailable->subject = $this->subject;
        return $mailable->html($this->render()->toHtml());
    }

    function mail($email){
        return Mail::to($email);
    }
    
    function parse($data){

        $subject = Blade::render($this->subject, $data);
        $this->subject($subject);

        $this->greeting(' ');
        $this->salutation(' ');

        $text = preg_replace('/(["\']{3,})/', '"', $this->mail->content);
        $message = Blade::render(trim($text), $data);
        $this->line(new HtmlString($message));
        return $this;
    }

}

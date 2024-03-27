<?php

namespace Utyemma\Notifire;

use Illuminate\Mail\Mailable as LaravelMailable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification as LaravelNotification;
use Illuminate\Support\HtmlString;
use Mustache_Engine;
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

    private static function __callStatic($name, $arguments) {
        if($name == 'send') return self::send(...$arguments);
        if($name == 'sendNow') return self::sendNow(...$arguments);
    }

    function send($receivers, $channels = null){
        return LaravelNotification::send($receivers, new MailableNotification($channels, $this));
    }

    function sendNow($receivers, $channels = null){
        if(is_string($receivers)) return $this->mail($receivers)->send($this->mailable());
        return LaravelNotification::sendNow($receivers, new MailableNotification($channels, $this));
    }

    private function mailable(){
        $mailable = new LaravelMailable();
        $mailable->subject = $this->subject;
        return $mailable->html($this->render()->toHtml());
    }

    function mail($email){
        return Mail::to($email)->send($this->mailable());
    }
    
    private function parse($data){
        $subject = (new Mustache_Engine)->render($this->subject, $data);
        $this->subject($subject);
        $this->greeting(' ');
        $this->salutation(' ');
        $text = preg_replace('/(["\']{3,})/', '"', $this->mail->content);
        $message = $this->resolver(trim($text), $data);
        $this->line(new HtmlString($message));
        return $this;
    }

    private function resolver($content, $data){
        if($resolver = config('notifire.resolver')) return new $resolver($content, $data);
        return $this->setResolver($content, $data);
    }
    
    protected function setResolver($content, $data){
        return (new Mustache_Engine)->render(trim($content), $data);
    }

}

<?php

namespace Utyemma\Notifire;

use Exception;
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
    private Mailable | null $mailable = null;
    protected $source;

    function setBody() { }

    function __construct($data = []) {
        $this->content = $data;

        $class = get_class($this);
        $model = Mailable::class;

        if($this->source == 'database') {
            if(!$this->mailable = Mailable::whereMailable(get_class($this))->first()) {
                throw new Exception("Database mailable [{$class}] does not exist on $model model");
            }

            return $this->parse($this->mailable);
        }

        if($this->source == 'inline') {
            return $this->parse([
                'subject' => $this->subject,
                'body' => $this->setBody(),
            ]);
        }
    }

    function send($receivers, $channels = null){
        if(is_string($receivers)) return $this->mail($receivers);
        LaravelNotification::send($receivers, new MailableNotification($channels, $this));
        $this->record();
    }

    function sendNow($receivers, $channels = null){
        if(is_string($receivers)) return $this->mail($receivers);
        LaravelNotification::sendNow($receivers, new MailableNotification($channels, $this));
        $this->record();
    }

    private function mailable(){
        $mailable = new LaravelMailable();
        $mailable->subject = $this->subject;    
        return $mailable->html($this->render()->toHtml());
    }

    function mail($email){
        $this->record();
        return Mail::to($email)->send($this->mailable());
    }

    private function parse($data){
        $this->subject($data['subject']);
        $this->greeting(' ');
        $this->salutation(' ');
        $text = preg_replace('/(["\']{3,})/', '"', $data['body']);
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

    function record(){
        if($this->mailable) {
            ++$this->mailable->sent;
            $this->mailable->save();
        }
    }

}

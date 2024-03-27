<?php

namespace Utyemma\Notifire\Commands;

use Illuminate\Console\GeneratorCommand;
use Utyemma\Notifire\Models\Mailable;

class CreateMailable extends GeneratorCommand {

    private $source, $subject, $message;

    protected $signature = 'make:mailable
                    {name : The name of the mailable class}
                    {--source=inline : The content source database | inline }
                    {--subject : The subject of the email message }
                ';

    protected $description = 'Create a new Mailable Class';

    protected $type = 'Mailable';

    protected function getStub(){
        $this->source = $this->option('source') ?? config('notifire.source');
        if($this->source == 'inline') return __DIR__.'/../../stubs/notifire-inline.stub';
        if($this->source == 'database') return __DIR__.'/../../stubs/notifire-database.stub';
    }

    protected function getDefaultNamespace($rootNamespace) {
        return $rootNamespace.'\Mailables';
    }

    protected function buildClass($name) {
        $this->subject = $this->option('subject') ? $this->option('subject') : config('notifire.defaults.subject');
        $this->message = config('notifire.defaults.body');
        $this->createMailable($name);

        return str_replace(['{{subject}}', "{{message}}"], [$this->subject, $this->message], parent::buildClass($name));
    }

    function createMailable($name){
        $source = $this->option('source');
        $this->subject = $this->option('subject') ? $this->option('subject') : config('notifire.defaults.subject');
        $this->message = config('notifire.defaults.body');

        if($source == 'database') {
            Mailable::create([
                'mailable' => $name,
                'subject' => $this->subject,
                'body' => $this->message
            ]);
        }
    }
    
}

<?php

namespace Utyemma\Notifire\Commands;

use Illuminate\Console\GeneratorCommand;

class CreateMailable extends GeneratorCommand {

    protected $signature = 'make:mailable
                    {name : The name of the mailable class}
                    {--source=database : The content source database | inline }
                ';

    protected $description = 'Command description';

    protected $type = 'Mailable';

    protected function getStub(){
        return base_path('../stubs/notifire.stub');
    }

    protected function getDefaultNamespace($rootNamespace) {
        return $rootNamespace.'\Mailable';
    }

    protected function buildClass($name) {
        $source = config('notifire.source') ?? $this->option();
        str_replace("{{SOURCE}}", $source, parent::buildClass($name));
    }
    
}

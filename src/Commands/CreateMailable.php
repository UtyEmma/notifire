<?php

namespace Utyemma\Notifire\Console;

use Illuminate\Console\GeneratorCommand;

class CreateMailable extends GeneratorCommand {

    protected $signature = 'make:mailable
                    {name : The name of the mailable class}
                    {--source=database : The content source database | class }
                ';

    protected $description = 'Command description';

    protected $type = 'Mailable';

    protected function getStub(){
        return base_path('stubs/notifire.stub');
    }

    protected function getDefaultNamespace($rootNamespace) {
        return $rootNamespace.'\Mailable';
    }

    protected function buildClass($name) {
        if($source = $this->option('source')) return str_replace("{{source}}", $source, parent::buildClass($name));
        return parent::buildClass($name);
    }
    
}

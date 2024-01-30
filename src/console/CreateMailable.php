<?php

namespace Utyemma\Notifire\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Utyemma\Notifire\Models\Mailable;

class CreateMailable extends Command {

    private Filesystem $files;
    private $variables;
    private $stub = __DIR__."/../stubs/notifire.stub";
    private $mailableClassname;
    private $mailableNamespace;
    private $namespace;
    private $content;
    private $path;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:mailable 
                {name : The name of the mailable class}
                {--Q|--title : The title or short description of the mailable}
                {--subject : The default subject of the email}
                ';
    
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new mailable class';

    /**
     * Execute the console command.
     */
    public function handle() {
        if (! app()->runningInConsole()) {
            return;
        }

        $this->files = new Filesystem();
        $this->files->ensureDirectoryExists(app_path('Mailables'));
    
        $this->setVariables();

        $this->path = implode("\\", $this->variables).'.php';
        
        if($this->createMailable()) {
            Mailable::create([
                'mailable' => implode('\\', $this->variables),
                'subject' => $this->option('subject') ?? str($this->mailableClassname)->headline(),
                'title' => $this->option('title') ?? str($this->mailableClassname)->headline(),
                'content' => $this->content ?? null
            ]);

            return $this->info("Mailable Class [{$this->path}] created successfully.");
        }

        $this->info("Mailable Class [{$this->path}] already exists.");
    }


    public function setVariables() {
        $name = $this->argument('name');
        $arr =  preg_split('/[' . preg_quote("/|\\\\", '/') . ']/', $name, -1, PREG_SPLIT_NO_EMPTY);

        $this->mailableClassname = array_pop($arr);
        $this->namespace =   implode("\\", $arr);
        $this->mailableNamespace = empty($this->namespace) ? "App\\Mailables" : implode("\\", ['App\\Mailables',  $this->namespace]);

        $this->variables = [
            'NAMESPACE' =>  $this->mailableNamespace,
            'CLASS_NAME' => $this->mailableClassname
        ]; 

        return $this->variables;
    }

    public function createMailable() {
        $content = file_get_contents($this->stub);
        $content = str_replace('{{NAMESPACE}}', $this->mailableNamespace, $content);
        $content = str_replace('{{CLASS_NAME}}', $this->mailableClassname, $content);

        $this->content = $content;

        if ($this->files->exists($this->path)) return false; 

        $this->files->put($this->path, $this->content);
        return true;        
    }
}

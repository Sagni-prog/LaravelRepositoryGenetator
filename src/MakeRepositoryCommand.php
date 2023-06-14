<?php

namespace Sagni\Repository;

use Illuminate\Console\Command;
use Str;

class MakeRepositoryCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repository {name}
                                            {--methods={}}
                                            { --s }
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
    
       $name = $this->argument('name');
       
       
      //  return $this->createInterfaceFile($name,'App\\Repositories');
       
       $pairs = explode(",",trim($this->input->getOption('methods'), "{}"));
       $des = explode('/',$name);
        if(!is_dir(app_path('Repositories'))){
          mkdir(app_path('Repositories'));
      }
      
      if(array_key_exists(1, $des)){
         $this->createRepositoryFile($des[1],$des[0]);
         $interfacePath = app_path('Repositories'.DIRECTORY_SEPARATOR.$des[0].DIRECTORY_SEPARATOR.$des[1].'Interface.php');
         $this->createInterfaceFile($des[1],$interfacePath,'App\\Repositories\\'.$des[0]);
      }else{
         $this->createRepositoryFile($name);
         $interfacePath = app_path('Repositories'.DIRECTORY_SEPARATOR.$name.'Interface.php');
         $this->createInterfaceFile($name,$interfacePath,'App\\Repositories');
      }
      
    }
    
    private function getRepositoryStub(){
      
      return file_get_contents(__DIR__.'/stubs/repository.stub');
      
    }
    
    private function getInterfaceStub(){
      
      return file_get_contents(__DIR__.'/stubs/interface.stub');

    }
    
    private function getPath(){
    
    }
    
    private function createRepositoryFile($name, $folder=null, $mathod = null){
       
       $stub = $this->getRepositoryStub();
       $des = explode('/',$name);
       $content = str_replace('{{ methods }}',$mathod,$stub);
       
       if($folder !== null){
           
           if(!is_dir(app_path('Repositories'.DIRECTORY_SEPARATOR.$folder))){
           
            mkdir(app_path('Repositories'.DIRECTORY_SEPARATOR.$folder));
           }
           $content = str_replace('{{ namespace }}',"App\Repositories\\".$folder,$content);
           $content = str_replace('{{ repositoryinterface }}',"App\Repositories\\".$folder."\\".$name."Interface",$content);
      
       }
       
       $content = str_replace('{{ namespace }}',"App\Repositories",$content);
       $content = str_replace('{{ repositoryinterface }}',"App\Repositories"."\\".$name."Interface",$content);
       
       $content = str_replace('{{ class }}',$name, $content);
       $content = str_replace('{{ interface }}',$name.'Interface',$content);
       
       file_put_contents(app_path('Repositories'.DIRECTORY_SEPARATOR.$folder.DIRECTORY_SEPARATOR.$name.'.php'),$content);

       
    }
    
    private function createInterfaceFile($name, $path, $namespace, $signature = null){
       
       $stub = $this->getInterfaceStub();
       $content = str_replace('{{ interface }}',$name.'Interface',$stub);
       $content = str_replace('{{ namespace }}',$namespace,$content);
       $content = str_replace('{{ signature }}',$signature,$content);
       file_put_contents($path, $content);
    }
    
   private function addServiceProviderToConfig(){
       
      $file = base_path('config'.DIRECTORY_SEPARATOR.'app.php');
    
      $content = file_get_contents($file);
      $classToConcatenate = "\t".'Sagni\Repository\RepositoryInterfaces::class,'."\n";
      $pattern = '/(\'providers\'\s*=>\s*\[.*?\]\s*,)/s';
      preg_match($pattern, $content, $matches);
      $closingBracket = strrpos($matches[0], ']');
      $newContent = substr_replace($matches[0], $classToConcatenate, $closingBracket, 0);
      $content = str_replace($matches[0], $newContent, $content);
      
   } 
    
    private function saveContent($path,$content){
      
      return file_put_contents($path,$content);

    }
    
    private function createDirectory($path){
       
       return mkdir($path); 
    }
    
}

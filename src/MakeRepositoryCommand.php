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
       
       $stub = file_get_contents(__DIR__.'/stubs/repository.stub');
       
       if(!is_dir(app_path('Repositories'))){
              
         mkdir(app_path('Repositories'));

      }
      
       if(array_key_exists(1, $des)){
       
        if(!is_dir(app_path('Repositories'.DIRECTORY_SEPARATOR.$des[0]))){
        
           mkdir(app_path('Repositories'.DIRECTORY_SEPARATOR.$des[0]));
        }
        
        $content = str_replace('{{ class }}',$des[1],$stub);
        $content = str_replace('{{ interface }}',$des[1].'Interface',$content);
        $content = str_replace('{{ namespace }}',"App\Repositories\\".$des[0],$content);
        $content = str_replace('{{ repositoryinterface }}',"App\Repositories\\".$des[0]."\\".$des[1]."Interface",$content);
        
        $interfacePath = app_path('Repositories'.DIRECTORY_SEPARATOR.$des[0].DIRECTORY_SEPARATOR.$des[1].'Interface.php');
        
        if($pairs[0]){
          $content = str_replace('{{ methods }}',$pairs[0],$content);
          echo $this->createInterfaceFile($des[1],$interfacePath,'App\\Repositories\\'.$des[0],$pairs[0]);

         
       }else{
          $content = str_replace('{{ methods }}','',$content);
          echo $this->createInterfaceFile($des[1],$interfacePath,'App\\Repositories\\'.$des[0]);

       }
        
        file_put_contents(app_path('Repositories'.DIRECTORY_SEPARATOR.$des[0].DIRECTORY_SEPARATOR.$des[1].'.php'),$content);
         
       }
       else{
            $content = str_replace('{{ class }}',$name,$stub);
            $content = str_replace('{{ interface }}',$name.'Interface',$content);
            $content = str_replace('{{ namespace }}',"App\Repositories",$content);
            $content = str_replace('{{ repositoryinterface }}',"App\Repositories"."\\".$name."Interface",$content);
            
            $interfacePath = app_path('Repositories'.DIRECTORY_SEPARATOR.$name.'Interface.php');

            
            echo $this->createInterfaceFile($name,$interfacePath,'App\\Repositories');
            
            if($pairs[0]){
               $content = str_replace('{{ methods }}',$pairs[0],$content);
               
            }else{
               $content = str_replace('{{ methods }}','',$content);
           }
         
         file_put_contents(app_path('Repositories'.DIRECTORY_SEPARATOR.$name.'.php'),$content);
         
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
    
    private function createRepositoryFile(){
    
    }
    
    private function createInterfaceFile($name, $path, $namespace, $signature = null){
       
       $stub = $this->getInterfaceStub();
       $content = str_replace('{{ interface }}',$name.'Interface',$stub);
       $content = str_replace('{{ namespace }}',$namespace,$content);
       $content = str_replace('{{ signature }}',$signature,$content);
       file_put_contents($path, $content);
    }
    
   private function createServiceProvider(){
       
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

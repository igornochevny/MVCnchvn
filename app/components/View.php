<?php

namespace app\components;

class View
{
    protected $path;
    protected $variables;

    public function __construct(string $path)
    {
        $this->setPath($path);
    }
    public function setPath($path){
        if(file_exists($path)){
            $this->path = $path;
        }else{
            throw new \Exception('View file was not found');
        }
    }


    public function setVariables(array $variables) {
        $this->variables = $variables;
    }

    public function getPath():string
    {
        return $this->path;
    }

    public function render(){
        ob_start();
        extract($this->variables);
        include($this->getPath());
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }


}
<?php

namespace app\http;

use app\components\View;

abstract class Controller {

    public $action;

    public function __construct(string $action)
    {
        $this->action = $action;
    }

    public function runAction() {
        if(method_exists($this, $this->action)) {
            return $this->{$this->action}();
        }
        throw new \Exception('Requested URL was not found!', 404);
    }

    public function render($viewID, array $variables) {

        $viewPath = $_SERVER['DOCUMENT_ROOT']."/resources/views/$viewID.php";
        if(file_exists($viewPath)){
            $view = new View($viewPath);
            $view->setVariables($variables);
            return $view->render();
        }
        throw new \Exception('View was not found');
    }
}

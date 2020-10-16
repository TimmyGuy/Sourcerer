<?php

namespace App\Sourcerer;

// use App\Sourcerer\SourcererException;
use App\viewRenderer;

abstract class ControllerHead {
    protected function render(String $view, Array $variables = NULL) {
        $render = new viewRenderer();
        return $render->render($view, $variables);
    }
}
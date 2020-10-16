<?php

namespace App;

use Exception;

class viewRenderer {

    public function render(String $view, Array $variables = NULL) {
        try {
            if(!file_exists($view)) {
                throw new Exception("Template " . $view . " not found!");
            } else {
                ob_start();
                ob_get_contents();
                extract($variables);
                include_once($view);
                ob_flush();
            }
        } catch(Exception $e) {
            echo $e;
        }
    }

}
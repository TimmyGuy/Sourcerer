<?php

namespace App\Sourcerer;

use Exception;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use RecursiveCallbackFilterIterator;

class AutoLoader {

    public static $foldersToLoad = [
        'sourcerer'
    ];

    public static $exclude = [
        'sourcerer/app/autoloader.php'
    ];

    static function addFolder(String $folder) {
        self::$foldersToLoad[] = $folder;
    }
    
    static function exclude(Array $exclude) {
        self::$exclude = $exclude;
    }

    static function load(String $json = NULL) {
        if($json != NULL) {
            $settings = json_decode($json);
            if(json_last_error() != JSON_ERROR_NONE) {
                throw new Exception('Text is not in JSON format.');
            }

            if(!isset($settings->foldersToLoad)) {
                throw new Exception('You didn\'t specify any folders to be loaded. Use <code>foldersToLoad</code> to include folders');
            }

            if(!isset($settings->exclude)) {
                $settings['exclude'] = [];
            }
        } else {
            $settings = [
                'foldersToLoad' => self::$foldersToLoad,
                'exclude' => self::$exclude
            ];
        }

        foreach($settings["foldersToLoad"] as $folder) {
            $folder = new RecursiveDirectoryIterator($folder, RecursiveDirectoryIterator::SKIP_DOTS);
            foreach(new RecursiveIteratorIterator($folder) as $file) {
                if(!in_array($file, $settings['exclude'])) {
                    if(is_file($file)) {
                        require_once($file);
                        // echo $file . "<br/>";
                    } 
                }
                
            }
        }
    }

    


}
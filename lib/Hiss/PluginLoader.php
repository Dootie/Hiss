<?php


class PluginLoader {
    public static function loadPlugins(){
        $directory = Hiss::$dir.'plugins';
        $scanned_directory = array_diff(scandir($directory), array('..', '.'));
        foreach ($scanned_directory as $file) {
            if($file == '.htaccess'){ continue; }
            include Hiss::$dir.'plugins/'.$file;
        }
    }
}
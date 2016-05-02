<?php

class Hiss {

    public static $dir;
    public static $defaultErrorEngine = true;
    
    static function run($dir){
        Hiss::redirectToNonWWW();
        include_once 'ConfigFile.php';
        include_once 'CustomTags.php';
        include_once 'elements/navbar/Navbar.php';
        include_once 'elements/navbar/NavbarTab.php';
        include_once 'elements/colortheme/ColorTheme.php';
        include_once 'PluginLoader.php';
        include_once 'DirectoryParser.php';
        include_once 'PlaceholderParser.php';
        
        Hiss::$dir = $dir;
        ini_set('error_reporting', E_ALL);
	ini_set('track_errors', '1');
	ini_set('display_errors', '1');
	ini_set('display_startup_errors', '1');
        
	$ct = new CustomTags\CustomTags(array(
		'parse_on_shutdown' => true,
		'tag_directory' => Hiss::$dir.'tags',
		'sniff_for_buried_tags' => true
	));
        DirectoryParser::$dir["index"] = "index";
        $bar = each(DirectoryParser::$dir);
        Hiss::configureNavBar();
        PluginLoader::loadPlugins();
        if(Hiss::$defaultErrorEngine){
            if(isset($_GET['error'])){
                $e = intval($_GET['error']);
                http_response_code($e);
                DirectoryParser::$error = $e;
            }
        }
    }
    
    private static function configureNavBar(){
        $config = new ConfigFile('config.php');
        Navbar::$name = 'Hiss';
        Navbar::$url = '#';
        
        $tab = new NavbarTab;
        $tab->name = 'Home';
        if(DirectoryParser::getCurrentPage() == "index"){
            $tab->active = true;
        }
        $tab->url = 'index';
        array_push(Navbar::$lefttabs, $tab);
    }
    
    
    /* */
    private static function redirectToNonWWW(){
        $pageURL = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";
        if ($_SERVER["SERVER_PORT"] != "80"){
            $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
        }else{
            $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
        }
        if(strpos($pageURL, 'www.')){
            http_response_code(301);
            header('Location: '. str_replace('www.', '', $pageURL));
        }
    }
}
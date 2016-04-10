<?php

$component_path = app_path() . DIRECTORY_SEPARATOR . "Components";
$modules = $component_path . DIRECTORY_SEPARATOR . "Site/Modules";

if (\File::isDirectory($modules)){

    $list = File::directories($modules);

    foreach($list as $module){
        if (\File::isDirectory($module)){
            if(\File::isFile($module. DIRECTORY_SEPARATOR . "routes.php")){
                require_once($module. DIRECTORY_SEPARATOR. "routes.php");
            }
        }
    }
}
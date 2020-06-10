<?php

function my_autoloader($class_name) {
   if($class_name == "CFrontController") {
       include_once ('Controller/'.$class_name.'.php');
    } else {
       switch ($class_name[0]) {
           case 'V':
               include_once('View/' . $class_name . '.php');
               break;
           case 'F':
               include_once('Foundation/' . $class_name . '.php');
               break;
           case 'E':
               include_once('Entity/' . $class_name . '.php');
               break;
           case 'C':
               include_once('Controller/' . $class_name . '.php');
               break;
       }
   }

}

//include_once 'Session.php';

//include_once 'Smarty/Smarty.class.php';

//include_once 'Installation.php';

include_once 'smartyConfiguration.php';

spl_autoload_register('my_autoloader');



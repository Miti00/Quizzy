<?php
spl_autoload_register('mvcLoader');

function mvcLoader(){
  $url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

  // if Loader dir is NOT requested by the server
  if(strpos($url, 'MVC/Loader') === false){
    //* if the url is not recognized as route by the server / specify files location individually
    $path_model = '../MVC/Model/model.php'; 
    $path_view = '../MVC/View/view.php'; 
    /**
     *! controller needs subfolder / files requested by iteration
     *! https://www.php.net/manual/en/recursivedirectoryiterator.construct.php
     *! build controller file iterator neccessary to load from subfolders
     */
    $path_controller = '../MVC/Controller/controller.php'; 
    $path_database = '../config/db.php';

  }else{
    $path_model = 'Model/model.php'; 
    $path_view = 'View/view.php'; 
    $path_controller = 'Controller/controller.php'; 
    $path_database = 'config/db.php';
  }

  // error handling:
  if(!file_exists($path_database)){
    echo 'Database file missing!'.'<br>';
    return false;
  }
  elseif(!file_exists($path_model)){
    echo 'Model file missing!'.'<br>';
    return false;
  }elseif(!file_exists($path_view)){
    echo 'View file missing!'.'<br>';
    return false;
  }elseif(!file_exists($path_controller)){
    echo 'Controller file missing!'.'<br>';
    return false;
  }

  require_once($path_database);
  require_once($path_model);
  require_once($path_view);
  require_once($path_controller);
}

?>
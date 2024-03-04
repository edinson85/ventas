<?php
  require_once '../app/bootstrap.php';
    
  // Init Core Library
  $init = new Core();

  $containterBuilder = new \DI\ContainerBuilder();
  $containterBuilder->useAutowiring(true);    
  $containter = $containterBuilder->build();
 
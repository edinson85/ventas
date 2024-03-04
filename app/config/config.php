<?php
  // DB Params
  /**
   * Se definen variables de acceso a la base de datos entre 
   * otras variables usadas en diferentes vistas
   */
  
  define('DB_HOST', $_ENV['DB_HOST']);
  define('DB_USER', $_ENV['DB_USER']);
  define('DB_PASS', $_ENV['DB_PASS']);
  define('DB_NAME', $_ENV['DB_NAME']);

  // App Root
  define('APPROOT', dirname(dirname(__FILE__)));
  // URL Root
  define('URLROOT', $_ENV['URLROOT']);
  // Site Name
  define('SITENAME', 'MegaRed');
  // App Version
  define('APPVERSION', '1.0.0');
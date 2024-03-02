<?php
  // Load Config
  require_once 'config/config.php';
  require_once 'helpers/url_helpers.php';
  require_once 'helpers/session_helper.php';
  require_once 'validations/UsuarioValidations.php';
  require_once '../vendor/autoload.php';
  require_once 'core/Usuario/Application/RegistrarUsuarioService.php';
  require_once 'core/Usuario/Application/LoginUsuarioService.php';
  require_once 'core/Usuario/Application/EditarUsuarioService.php';    
  require_once 'core/Usuario/Infraestructure/Repositories/UserRepository.php';
  require_once 'core/Password/Application/EncoderService.php';
  require_once 'core/Usuario/Domain/Models/Usuario.php';
  
  
  require_once 'core/Cliente/Domain/Models/Cliente.php';
  require_once 'core/Cliente/Infraestructure/Repositories/ClienteRepository.php';
  require_once 'core/Cliente/Application/ListarClientesService.php';




  
  // Autoload Core Libraries
  spl_autoload_register(function($className){
    require_once 'libraries/' . $className . '.php';
  });
  
  $dotenv = Dotenv\Dotenv::createImmutable('../');
  $dotenv->load();


  

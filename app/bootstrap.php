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
  
  require_once 'validations/ClienteValidations.php';
  require_once 'core/Cliente/Domain/Models/Cliente.php';
  require_once 'core/Cliente/Infraestructure/Repositories/ClienteRepository.php';
  require_once 'core/Cliente/Application/ListarClientesService.php';
  require_once 'core/Cliente/Application/RegistrarClienteService.php';  
  require_once 'core/Cliente/Application/EditarClienteService.php';    
  require_once 'core/Cliente/Application/EliminarClienteService.php';    

  require_once 'core/Producto/Domain/Models/Producto.php';
  require_once 'core/Producto/Infraestructure/Repositories/ProductoRepository.php';
  require_once 'core/Producto/Application/ListarProductosService.php';
  require_once 'validations/ProductoValidations.php';
  require_once 'core/Producto/Application/RegistrarProductosService.php';  
  require_once 'core/Producto/Application/EditarProductoService.php';    
  require_once 'core/Producto/Application/EliminarProductoService.php';    

  require_once 'core/Venta/Domain/Models/Venta.php';
  require_once 'core/Venta/Domain/Models/VentaProducto.php';
  require_once 'core/Venta/Application/ListarVentasService.php';
  require_once 'core/Venta/Infraestructure/Repositories/VentaRepository.php';
  require_once 'core/Venta/Infraestructure/Repositories/VentaProductoRepository.php';

  // Autoload Core Libraries
  spl_autoload_register(function($className){
    require_once 'libraries/' . $className . '.php';
  });
  
  $dotenv = Dotenv\Dotenv::createImmutable('../');
  $dotenv->load();


  

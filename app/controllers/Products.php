<?php
  class Products extends Controller {
    protected $listarProductosService;
    protected $registrarProductosService;
    protected $editarProductoService;
    protected $eliminarProductoService;
    

    public function __construct(){
      $this->listarProductosService = new ListarProductosService();
      $this->registrarProductosService = new RegistrarProductosService();      
      $this->editarProductoService = new EditarProductoService();      
      $this->eliminarProductoService = new EliminarProductoService();
    }
    
    public function index(){
      $this->isLoggedIn();
      $products = $this->listarProductosService->listar();
      $data = [];
      foreach ($products as $product) {
        $data [] = [
          'id' => $product->getId(),          
          'nombre' => $product->getNombre(),
          'valor' => $product->getValor(),
          'estado' => $product->getEstado() 
        ];
      }         
      if ($_SESSION['flash_message'] != '') {
        flash('result', $_SESSION['flash_message'],$_SESSION['color_flash']);                 
        $_SESSION['flash_message'] = '';
        $_SESSION['color_flash'] = '';
      }
      $this->view('products/index', $data);
    }
    
    public function registrar(){            
      $this->isLoggedIn();
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
          $data = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
          $data = ProductoValidations::validateDataRegister($data);    
          if ($data['result']) {            
            $result = $this->registrarProductosService->registrar($data['nombre'], $data['valor'], $data['estado']);      
            if($result['result']){                
                $_SESSION['flash_message'] = 'Producto agregado satisfactoriamente';
                $_SESSION['color_flash'] = 'alert alert-success';                
            } else {                              
                $_SESSION['flash_message'] = $result['err'];     
                $_SESSION['color_flash'] = 'alert alert-danger'; 
            }
            
          } else {            
            $_SESSION['flash_message'] = $data['err'];          
            $_SESSION['color_flash'] = 'alert alert-danger';   
          }          
      }      
    }
    
    public function editar(){    
      $this->isLoggedIn();        
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $data = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $data = ProductoValidations::validateDataEditar($data);    
        if ($data['result']) {
          $result = $this->editarProductoService->editar($data['id'], $data['nombre'], $data['valor'], $data['estado']);      
          if($result['result']){                
              $_SESSION['flash_message'] = 'Producto editado satisfactoriamente';
              $_SESSION['color_flash'] = 'alert alert-success';                
          } else {                              
              $_SESSION['flash_message'] = $result['err'];     
              $_SESSION['color_flash'] = 'alert alert-danger'; 
          }
        } else {            
          $_SESSION['flash_message'] = $data['err'];          
          $_SESSION['color_flash'] = 'alert alert-danger';   
        }          
      }
    }
    
    public function eliminar(){  
      $this->isLoggedIn();          
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $data = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $data = ProductoValidations::validateDataElimianr($data);    
        if ($data['result']) {
          $result = $this->eliminarProductoService->eliminar($data['id']);      
          if($result['result']){                
              $_SESSION['flash_message'] = 'Producto eliminado satisfactoriamente';
              $_SESSION['color_flash'] = 'alert alert-success';                
          } else {                              
              $_SESSION['flash_message'] = $result['err'];     
              $_SESSION['color_flash'] = 'alert alert-danger'; 
          }
        } else {            
          $_SESSION['flash_message'] = $data['err'];          
          $_SESSION['color_flash'] = 'alert alert-danger';   
        }          
      }    
    }   
        
  }
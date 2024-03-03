<?php
  class Products extends Controller {
    protected $listarProductosService;
    //protected $registrarClienteService;
    //protected $editarClienteService;
    //protected $eliminarClienteService;
    

    public function __construct(){
      $this->listarProductosService = new ListarProductosService();
      //$this->registrarClienteService = new RegistrarClienteService();      
      //$this->editarClienteService = new EditarClienteService();      
      //$this->eliminarClienteService = new EliminarClienteService();
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
    /*
    public function registrar(){            
      $this->isLoggedIn();
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
          $data = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
          $data = ClienteValidations::validateDataRegister($data);    
          if ($data['result']) {
            $result = $this->registrarClienteService->registrar($data['cedula'], $data['nombres'], $data['apellidos'], $data['estado']);      
            if($result['result']){                
                $_SESSION['flash_message'] = 'Client successfully added';
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
        $data = ClienteValidations::validateDataEditar($data);    
        if ($data['result']) {
          $result = $this->editarClienteService->editar($data['id'], $data['cedula'], $data['nombres'], $data['apellidos'], $data['estado']);      
          if($result['result']){                
              $_SESSION['flash_message'] = 'Client successfully edit';
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
        $data = ClienteValidations::validateDataElimianr($data);    
        if ($data['result']) {
          $result = $this->eliminarClienteService->eliminar($data['id']);      
          if($result['result']){                
              $_SESSION['flash_message'] = 'Client successfully delete';
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
        */  
  }
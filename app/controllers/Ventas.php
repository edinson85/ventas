<?php
  class Ventas extends Controller {
    protected $listarVentasService;
    protected $listarClientesService;
    protected $listarProductosService;    
    protected $registrarVentaService;
    //protected $editarProductoService;
    //protected $eliminarProductoService;    

    public function __construct(){      
      $this->listarVentasService = new ListarVentasService();
      $this->listarClientesService = new ListarClientesService();
      $this->listarProductosService = new ListarProductosService();      
      $this->registrarVentaService = new RegistrarVentaService();      
      //$this->editarProductoService = new EditarProductoService();      
      //$this->eliminarProductoService = new EliminarProductoService();
    }  
    
    public function index(){
      $this->isLoggedIn();
      $ventas = $this->listarVentasService->listar();      
      $data = [];
      foreach ($ventas as $venta) {
        $data [] = [
          'id' => $venta->getId(),                  
          'cliente' => $venta->getCliente()->getNombres()." ".$venta->getCliente()->getApellidos(),                  
          'valor' => $venta->getValor(),        
        ];
      }
      if ($_SESSION['flash_message'] != '') {
        flash('result', $_SESSION['flash_message'],$_SESSION['color_flash']);                 
        $_SESSION['flash_message'] = '';
        $_SESSION['color_flash'] = '';
      }
      $this->view('ventas/index', $data);
    }

    public function nueva(){
      $this->isLoggedIn();    
      $customers = $this->listarClientesService->listar(true);      
      $data ['clientes'] = [];      
      foreach ($customers as $customer) {
        $data ['clientes'][] = [
          'id' => $customer->getId(),
          'cedula' => $customer->getCedula(), 
          'nombres' => $customer->getNombres(),
          'apellidos' => $customer->getApellidos(),
          'estado' => $customer->getEstado() 
        ];
      }
      $data ['productos'] = [];      
      $products = $this->listarProductosService->listar(true);
      foreach ($products as $product) {
        $data ['productos'][] = [
          'id' => $product->getId(),          
          'nombre' => $product->getNombre(),
          'valor' => $product->getValor(),
          'estado' => $product->getEstado() 
        ];
      }         
      $this->view('ventas/nueva',$data);
    }    
    
    public function registrar(){            
      $this->isLoggedIn();
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
          $data = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);                    
          $result = $this->registrarVentaService->registrar($data['idCliente'], $data['total'], $data['productos']);      
          if($result['result']){                
              $_SESSION['flash_message'] = 'Venta creada satisfactoriamente';
              $_SESSION['color_flash'] = 'alert alert-success';                
          } else {                              
              $_SESSION['flash_message'] = $result['err'];     
              $_SESSION['color_flash'] = 'alert alert-danger'; 
          }                           
      }      
    }
    /*
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
     */   
  }
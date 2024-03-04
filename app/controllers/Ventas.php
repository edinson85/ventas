<?php
  class Ventas extends Controller {
    protected $listarVentasService;
    protected $listarClientesService;
    protected $listarProductosService;    
    protected $registrarVentaService;
    protected $eliminarVentaService;
    
    
      /**     
     * @param ListarVentasService $listarVentasService       // Servicio que permite listar todas las ventas activas
     * @param ListarClientesService $listarClientesService   // Servicio que permite listar todos las clientes activos
     * @param ListarProductosService $listarProductosService // Servicio que permite listar todos las productos activos
     * @param RegistrarVentaService $registrarVentaService   // Servicio que permite registrar ventas
     * @param EliminarVentaService $eliminarVentaService     // Servicio que permite eliminar una venta
     */
    public function __construct(){      
      $this->listarVentasService = new ListarVentasService();
      $this->listarClientesService = new ListarClientesService();
      $this->listarProductosService = new ListarProductosService();      
      $this->registrarVentaService = new RegistrarVentaService();  
      $this->eliminarVentaService = new EliminarVentaService();      
    
    }  
    
    // Obtiene la información necesaria para la vista que contiene la gestión del CRUD Ventas
    public function index(){
      // Si no esta logueado lo lleva a la vista de login   
      $this->isLoggedIn();
      $ventas = $this->listarVentasService->listar(true);      
      $data = [];
      foreach ($ventas as $venta) {
        $data [] = [
          'id' => $venta->getId(),                  
          'cliente' => $venta->getCliente()->getNombres()." ".$venta->getCliente()->getApellidos(),                  
          'valor' => $venta->getValor(),        
        ];
      }
      /**
       * Como la vista index es el punto de retorno de diferentes acciones se gestionan en este punto la visualización de las
       * variables flash creadas en el proyecto
       *  
       * */       
      if ($_SESSION['flash_message'] != '') {
        flash('result', $_SESSION['flash_message'],$_SESSION['color_flash']);                 
        $_SESSION['flash_message'] = '';
        $_SESSION['color_flash'] = '';
      }
      $this->view('ventas/index', $data);
    }
    // Obtiene la infomación necesaria para la vista donde se gestiona el cliente y productos de una venta
    public function nueva(){
      // Si no esta logueado lo lleva a la vista de login   
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
    
    // Permite registrar nuevas ventas
    public function registrar(){      
      // Si no esta logueado lo lleva a la vista de login         
      $this->isLoggedIn();
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
          $data = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);                    
          // Se registra la venta y la relación entre productos y la venta
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
    */

    // Permite eliminado logico de una venta
    public function eliminar(){  
      // Si no esta logueado lo lleva a la vista de login         
      $this->isLoggedIn();          
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $data = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);              
        $result = $this->eliminarVentaService->eliminar($data['id']);      
        if($result['result']){                
            $_SESSION['flash_message'] = 'Venta eliminada satisfactoriamente';
            $_SESSION['color_flash'] = 'alert alert-success';                
        } else {                              
            $_SESSION['flash_message'] = $result['err'];     
            $_SESSION['color_flash'] = 'alert alert-danger'; 
        }
                  
      }    
    }        
  }
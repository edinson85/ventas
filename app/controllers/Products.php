<?php
  class Products extends Controller {

    protected $listarProductosService;
    protected $registrarProductosService;
    protected $editarProductoService;
    protected $eliminarProductoService;
    
    /**     
     * @param ListarProductosService $listarProductosService       // Servicio que permite listar todos los productos
     * @param RegistrarProductosService $registrarProductosService   // Servicio que permite crear productos
     * @param EditarProductoService $editarProductoService         // Servicio que permite editar productos
     * @param EliminarProductoService $eliminarProductoService     // Servicio que permite eliminar productos
     */
    public function __construct(){
      $this->listarProductosService = new ListarProductosService();
      $this->registrarProductosService = new RegistrarProductosService();      
      $this->editarProductoService = new EditarProductoService();      
      $this->eliminarProductoService = new EliminarProductoService();
    }
    // Obtiene la información necesaria para la vista que contiene la gestión del CRUD Productos
    public function index(){
      // Si no esta logueado lo lleva a la vista de login   
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
      /**
       * Como la vista index es el punto de retorno de diferentes acciones se gestionan en este punto la visualización de las
       * variables flash creadas en el proyecto
       *  
       * */    
      if (isset($_SESSION['flash_message'])){  
        if ($_SESSION['flash_message'] != '') {
          flash('result', $_SESSION['flash_message'],$_SESSION['color_flash']);                 
          $_SESSION['flash_message'] = '';
          $_SESSION['color_flash'] = '';
        }
      }
      $this->view('products/index', $data);
    }
    // Permite registrar nuevos clientes 
    public function registrar(){         
      // Si no esta logueado lo lleva a la vista de login   
      $this->isLoggedIn();
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
          // Se obtienen los datos enviados
          $data = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
          // Se validan los datos enviados estan completos y con los tipos adecuados
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
    // Permite editar un productos
    public function editar(){    
      // Si no esta logueado lo lleva a la vista de login  
      $this->isLoggedIn();        
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Se obtienen los datos enviados
        $data = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        // Se validan los datos enviados estan completos y con los tipos adecuados
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
    // Permite eliminar un producto
    public function eliminar(){  
      // Si no esta logueado lo lleva a la vista de login  
      $this->isLoggedIn();          
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Se obtienen los datos enviados
        $data = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        // Se validan los datos enviados estan completos y con los tipos adecuados
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
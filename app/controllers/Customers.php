<?php
  class Customers extends Controller {

    protected $listarClientesService;
    protected $registrarClienteService;
    protected $editarClienteService;
    protected $eliminarClienteService;
    
    /**     
     * @param ListarClientesService $listarClientesService       // Servicio que permite listar todos los clientes
     * @param RegistrarClienteService $registrarClienteService   // Servicio que permite crear clientes
     * @param EditarClienteService $editarClienteService         // Servicio que permite editar clientes
     * @param EliminarClienteService $eliminarClienteService     // Servicio que permite eliminar clientes
     */
    public function __construct(){
      $this->listarClientesService = new ListarClientesService();
      $this->registrarClienteService = new RegistrarClienteService();      
      $this->editarClienteService = new EditarClienteService();      
      $this->eliminarClienteService = new EliminarClienteService();
    }
    // Obtiene la información necesaria para la vista que contiene la gestión del CRUD Cliente
    public function index(){
      // Si no esta logueado lo lleva a la vista de login
      $this->isLoggedIn();
      // Se obtienen todos los clientes independiente de su estado
      $customers = $this->listarClientesService->listar();
      $data = [];
      foreach ($customers as $customer) {
        $data [] = [
          'id' => $customer->getId(),
          'cedula' => $customer->getCedula(),
          'nombres' => $customer->getNombres(),
          'apellidos' => $customer->getApellidos(),
          'estado' => $customer->getEstado() 
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
      $this->view('customers/index', $data);
    }
    // Permite registrar nuevos clientes 
    public function registrar(){            
      // Si no esta logueado lo lleva a la vista de login
      $this->isLoggedIn();
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Se obtienen los datos enviados
          $data = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
          // Se validan los datos enviados estan completos y con los tipos adecuados
          $data = ClienteValidations::validateDataRegister($data);    
          if ($data['result']) {
            $result = $this->registrarClienteService->registrar($data['cedula'], $data['nombres'], $data['apellidos'], $data['estado']);      
            if($result['result']){                
                $_SESSION['flash_message'] = 'Cliente agregado satisfactoriamente';
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
    // Permite editar un cliente
    public function editar(){  
      // Si no esta logueado lo lleva a la vista de login  
      $this->isLoggedIn();        
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Se obtienen los datos enviados
        $data = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        // Se validan los datos enviados estan completos y con los tipos adecuados
        $data = ClienteValidations::validateDataEditar($data);    
        if ($data['result']) {
          $result = $this->editarClienteService->editar($data['id'], $data['cedula'], $data['nombres'], $data['apellidos'], $data['estado']);      
          if($result['result']){                
              $_SESSION['flash_message'] = 'Cliente editado satisfactoriamente';
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
    // Permite eliminar un cliente
    public function eliminar(){  
      // Si no esta logueado lo lleva a la vista de login  
      $this->isLoggedIn();          
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Se obtienen los datos enviados
        $data = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        // Se validan los datos enviados estan completos y con los tipos adecuados
        $data = ClienteValidations::validateDataElimianr($data);    
        if ($data['result']) {
          $result = $this->eliminarClienteService->eliminar($data['id']);      
          if($result['result']){                
              $_SESSION['flash_message'] = 'Cliente eliminado satisfactoriamente';
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
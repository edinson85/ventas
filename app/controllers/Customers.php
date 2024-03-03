<?php
  class Customers extends Controller {
    protected $listarClientesService;
    protected $registrarClienteService;

    public function __construct(){
      $this->listarClientesService = new ListarClientesService();
      $this->registrarClienteService = new RegistrarClienteService();      
    }
    
    public function index(){            
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
      if ($_SESSION['flash_message'] != '') {
        flash('result', $_SESSION['flash_message'],$_SESSION['color_flash']);                 
        $_SESSION['flash_message'] = '';
        $_SESSION['color_flash'] = '';
      }
      $this->view('customers/index', $data);
    }

    public function registrar(){            
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
      //redirect('customers/index');
    }

    public function editar(){            
      $_POST =  $this->getDataPost();                 
      redirect('customers/index');
    }
    
    public function eliminar(){            
      $_POST =  $this->getDataPost();                 
      redirect('customers/index');
    }   
    
    private function getDataPost() {
      return filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    }
  }
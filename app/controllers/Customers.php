<?php
  class Customers extends Controller {
    protected $listarClientesService;

    public function __construct(){
      $this->listarClientesService = new ListarClientesService();
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
      $this->view('customers/index', $data);
    }
  }
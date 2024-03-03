<?php


class EditarClienteService 
{
    protected $clienteRespository;
    

    /**
     * @param ClienteRepository $clienteRespository     // permite editar clietnes en la base de datos     
     */
    public function __construct() {
        $this->clienteRespository = new ClienteRepository();        
    }

    public function editar(string $id, string $cedula, string $nombres, string $apellidos, string $estado): array {        
        try {
            $result['result'] = false;            
            $cliente = $this->clienteRespository->findCustomerById($id);            
            if($cliente){       
                $cliente->setCedula($cedula);
                $cliente->setNombres($nombres);
                $cliente->setApellidos($apellidos);
                $cliente->setEstado($estado);
                $result['result'] = $this->clienteRespository->editar($cliente);
            }                        
        } catch (\Throwable $e) {            
            // TO DO ADD LOG
        }
        return $result;
    }   
}
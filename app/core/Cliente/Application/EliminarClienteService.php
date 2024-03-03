<?php


class EliminarClienteService 
{
    protected $clienteRespository;
    

    /**
     * @param ClienteRepository $clienteRespository     // permite eliminar clietnes en la base de datos     
     */
    public function __construct() {
        $this->clienteRespository = new ClienteRepository();        
    }

    public function eliminar(string $id): array {        
        try {
            $result['result'] = false;            
            $cliente = $this->clienteRespository->findCustomerById($id);            
            if($cliente){                       
                $result['result'] = $this->clienteRespository->eliminar($id);
            } 
            if(!$result['result']) {
                $result['err'] = 'It was not possible to delete the customer';            
            }                       
        } catch (\Throwable $e) {            
            // TO DO ADD LOG
        }
        return $result;
    }   
}
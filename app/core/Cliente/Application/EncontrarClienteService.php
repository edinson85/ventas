<?php


class EncontrarClienteService 
{
    protected $clienteRespository;    

    /**
     * @param ClienteRepository $clienteRespository     // permite obtener datos de clietnes de la base de datos     
     */
    public function __construct() {
        $this->clienteRespository = new ClienteRepository();        
    }

    public function encontrar(int $idCliente, bool $activos = false) {        
        try {            
            $result = $this->clienteRespository->findCustomerById($idCliente,$activos);                
        } catch (\Exception $e) {            
            // TO DO ADD LOG
        }
        return $result;
    }

}
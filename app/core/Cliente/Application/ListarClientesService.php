<?php


class ListarClientesService 
{
    protected $clienteRespository;    

    /**
     * @param ClienteRepository $clienteRespository     // permite obtener datos de clietnes de la base de datos     
     */
    public function __construct() {
        $this->clienteRespository = new ClienteRepository();        
    }

    public function listar(): array {        
        try {            
            $result = $this->clienteRespository->list();                
        } catch (\Exception $e) {            
            // TO DO ADD LOG
        }
        return $result;
    }

}
<?php


class RegistrarClienteService 
{
    protected $clienteRespository;    

    /**
     * @param ClienteRepository $clienteRespository     // permite crear clietnes en la base de datos     
     */
    public function __construct() {
        $this->clienteRespository = new ClienteRepository();        
    }

    public function registrar(string $cedula, string $nombres, string $apellidos, bool $estado): array {        
        try {
            $result['result'] = false;
            if($this->clienteRespository->findCustomerByCedula($cedula)){
                $result['err'] = 'Customer already exist';
            } else {
                $cliente = new Cliente($cedula, $nombres, $apellidos, $estado);                        
                if (!$this->clienteRespository->register($cliente)) {
                    $result['err'] = 'it was not possible to create the client';
                } else {
                    $result['result'] = true;
                }
            }
        } catch (\Exception $e) {            
            // TO DO ADD LOG
            $r = $e;
        }
        return $result;
    }

}
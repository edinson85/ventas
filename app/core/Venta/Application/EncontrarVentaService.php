<?php


class EncontrarVentaService 
{
    protected $ventaRepository;    

    /**
     * @param VentaRepository $ventasRepository     // permite obtener datos de ventas de la base de datos     
     */
    public function __construct() {
        $this->ventaRepository = new VentaRepository();        
    }

    public function encontrar(int $idVenta, bool $activos = false) {
        try {            
            $result = $this->ventaRepository->findVentaById($idVenta,$activos);                
        } catch (\Exception $e) {            
            // TO DO ADD LOG
        }
        return $result;
    }

}
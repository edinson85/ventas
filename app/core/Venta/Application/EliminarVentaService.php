<?php


class EliminarVentaService 
{
    protected $ventaRepository;   
    protected $ventaProductoRepository;    
    

    /**
     * @param VentaRepository $ventasRepository     // permite elimianar datos de ventas de la base de datos  
     * @param VentaProductoRepository $ventaProductoRepository     // permite eliminar venta productos en la base de datos        
     */
    public function __construct() {
        $this->ventaRepository = new VentaRepository();       
        $this->ventaProductoRepository = new VentaProductoRepository();
    }

    public function eliminar(string $id): array {        
        try {
            $result['result'] = false;            
            $venta = $this->ventaRepository->findVentaById($id);            
            if($venta){                                       
                $valid = true;                
                if(!$this->ventaRepository->eliminadoLogico($id)) {
                    $result['err'] = 'No fue posible eliminar la venta';            
                    $valid = false;
                }                
                $result['result'] = $valid;            
            } 
            if(!$result['result']) {
                $result['err'] = 'No fue posible encontrar la venta';            
            }                       
        } catch (\Throwable $e) {            
            $result['err'] = 'Ups, algo salio mal';            
        }
        return $result;
    }   
}
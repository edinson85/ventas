<?php


class EliminarProductoService 
{
    protected $productoRepository;    
    

    /**
     * @param ProductoRepository $productoRepository     // permite eliminar productos en la base de datos     
     */
    public function __construct() {
        $this->productoRepository = new ProductoRepository();        
    }

    public function eliminar(string $id): array {        
        try {
            $result['result'] = false;            
            $cliente = $this->productoRepository->findProductById($id);            
            if($cliente){                       
                $result['result'] = $this->productoRepository->eliminar($id);
            } 
            if(!$result['result']) {
                $result['err'] = 'No fue posible eliminar el producto';            
            }                       
        } catch (\Throwable $e) {            
            $result['err'] = 'Ups, algo salio mal';            
        }
        return $result;
    }   
}
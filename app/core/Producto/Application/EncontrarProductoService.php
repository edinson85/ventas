<?php


class EncontrarProductoService 
{
    protected $productoRepository;    

    /**
     * @param ProductoRepository $productoRepository     // permite obtener datos de productos de la base de datos     
     */
    public function __construct() {
        $this->productoRepository = new ProductoRepository();        
    }

    public function encontrar(int $idProducto, bool $activo = false) {        
        try {            
            $result = $this->productoRepository->findProductById($idProducto, $activo);                
        } catch (\Exception $e) {            
            // TO DO ADD LOG
        }
        return $result;
    }

}
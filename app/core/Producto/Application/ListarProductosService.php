<?php


class ListarProductosService 
{
    protected $productoRepository;    

    /**
     * @param ProductoRepository $productoRepository     // permite obtener datos de productos de la base de datos     
     */
    public function __construct() {
        $this->productoRepository = new ProductoRepository();        
    }

    public function listar(): array {        
        try {            
            $result = $this->productoRepository->list();                
        } catch (\Exception $e) {            
            // TO DO ADD LOG
        }
        return $result;
    }

}
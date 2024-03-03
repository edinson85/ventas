<?php


class EditarProductoService 
{
    protected $productoRepository;    
    

    /**
     * @param ProductoRepository $productoRepository     // permite editar productos en la base de datos     
     */
    public function __construct() {
        $this->productoRepository = new ProductoRepository();        
    }

    public function editar(string $id, int $nombre, int $valor, bool $estado): array {        
        try {
            $result['result'] = false;            
            $producto = $this->productoRepository->findProductById($id);            
            if($producto){                       
                $producto->setNombre($nombre);
                $producto->setValor($valor);
                $producto->setEstado($estado);
                $result['result'] = $this->productoRepository->editar($producto);
            } else {
                $result['err'] = 'Producto no encontrado';
            }                        
        } catch (\Throwable $e) {            
            $result['err'] = 'Ups algo ha salido mal';
        }
        return $result;
    }   
}
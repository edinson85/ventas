<?php


class RegistrarProductosService 
{
    protected $productoRepository;    

    /**
     * @param ProductoRepository $productoRepository     // permite crear productos en la base de datos     
     */
    public function __construct() {
        $this->productoRepository = new ProductoRepository();        
    }

    public function registrar(int $nombre, int $valor, bool $estado): array {        
        try {
            $result['result'] = false;
            if($this->productoRepository->findProductByNombre($nombre)){
                $result['err'] = 'Product already exist';
            } else {
                $cliente = new Producto($nombre, $valor, $estado);                        
                if (!$this->productoRepository->register($cliente)) {
                    $result['err'] = 'it was not possible to create the product';
                } else {
                    $result['result'] = true;
                }
            }
        } catch (\Exception $e) {            
            $result['err'] = 'Ups algo ha salido mal';
        }
        return $result;
    }

}
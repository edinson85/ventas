<?php


class RegistrarVentaProductoService 
{
    protected $ventaProductoRepository;   
    protected $encontrarVentaService;
    protected $encontrarProductoService;
    

    /**
     * @param VentaProductoRepository $ventaProductoRepository     // permite crear venta productos en la base de datos     
     * @param EncontrarVentaService $encontrarVentaService     // permite obtener una venta por su id
     * @param EncontrarProductoService $encontrarProductoService     // permite obtener un producto por su id
     * 
     */
    public function __construct() {
        $this->ventaProductoRepository = new VentaProductoRepository();        
        $this->encontrarVentaService = new EncontrarVentaService();
        $this->encontrarProductoService = new EncontrarProductoService();
        
    }

    public function registrar(int $idVenta, int $idProducto): array {        
        try {
            $result['result'] = false;
            $venta = $this->encontrarVentaService->encontrar($idVenta,true);
            if ($venta) {
                $producto = $this->encontrarProductoService->encontrar($idProducto,true);
                if ($producto) {
                    $ventaProducto = new VentaProducto($venta, $producto);                        
                    if (!$this->ventaProductoRepository->register($ventaProducto)) {
                        $result['err'] = "No fue posible crear la venta producto $idVenta, $idProducto ";
                    } else {
                        $result['result'] = true;
                    }
                } else {
                    $result['err'] = "No fue posible enconrtar el producto con id $idProducto";      
                }
            } else {
                $result['err'] = 'No fue posible enconrtar la venta';  
            }           
        } catch (\Exception $e) {            
            $result['err'] = 'Ups algo ha salido mal';
        }
        return $result;
    }

}
<?php


class RegistrarVentaService 
{
    protected $ventaRepository;    
    protected $encontrarClienteService;
    protected $registrarVentaProductoService;

    /**
     * @param VentaRepository $ventaRepository     // permite crear ventas en la base de datos     
     * 
     * @param EncontrarClienteService $encontrarClienteService     // permite obtener un cliente por id
     * 
     * @param RegistrarVentaProductoService $registrarVentaProductoService     // permite crear ventas producto
     */
    public function __construct() {
        $this->ventaRepository = new VentaRepository();        
        $this->encontrarClienteService = new EncontrarClienteService();
        $this->registrarVentaProductoService = new RegistrarVentaProductoService();        
    }

    public function registrar(int $idCliente, int $valor, array $productos): array {        
        try {
            $result['result'] = false;
            $cliente = $this->encontrarClienteService->encontrar($idCliente,true);
            if ($cliente) {
                $venta = new Venta($cliente, $valor, true);                            
                $idVenta = $this->ventaRepository->register($venta);
                if (!$idVenta) {
                    $result['err'] = 'No fue posible crear la venta';
                } else {          
                    $valid = true;          
                    foreach ($productos as $producto) {
                        $resultAddVentaProducto = $this->registrarVentaProductoService->registrar($idVenta, $producto);
                        if (!$resultAddVentaProducto['result']) {
                            $result['err'] = $resultAddVentaProducto['err'];  
                            $valid = false;          
                            break;
                        }
                    }
                    if ($valid) {
                        $result['result'] = true;
                    }
                }
            } else {
                $result['err'] = 'No fue posible enconrtar el cliente';  
            }            
        } catch (\Exception $e) {            
            $result['err'] = 'Ups algo ha salido mal';
        }
        return $result;
    }

}
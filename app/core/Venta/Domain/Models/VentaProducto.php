<?php

class VentaProducto
{
    private string $id;
    private Venta $venta;
    private Producto $producto;    

    public function __construct(Venta $venta, Producto $producto)
    {        
        $this->venta = $venta;
        $this->producto = $producto;                        
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getVenta(): Venta
    {
        return $this->venta;
    }

    public function setVenta(Venta $venta): void
    {
        $this->venta = $venta;
    }

    public function getProducto(): Producto
    {
        return $this->producto;
    }

    public function setProducto(Producto $producto): void
    {
        $this->producto = $producto;
    }         

}

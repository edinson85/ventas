<?php

class Producto 
{
    private string $id;    
    private int $nombre;
    private int $valor;    
    private bool $estado;    

    public function __construct(int $nombre, int $valor, bool $estado)
    {                
        $this->nombre = $nombre;
        $this->valor = $valor;        
        $this->estado = $estado;        
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getNombre(): int
    {
        return $this->nombre;
    }

    public function setNombre(int $nombre): void
    {
        $this->nombre = $nombre;
    }

    public function getValor(): int
    {
        return $this->valor;
    }

    public function setValor(string $valor): void
    {
        $this->valor = $valor;
    }
   
    public function getEstado(): bool
    {
        return $this->estado;
    }

    public function setEstado(bool $estado): void
    {
        $this->estado = $estado;
    }  

}

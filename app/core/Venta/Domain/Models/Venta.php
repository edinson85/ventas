<?php

class Venta
{
    private string $id;
    private Cliente $cliente;    
    private int $valor;
    private bool $estado;    

    public function __construct(Cliente $cliente, int $valor, bool $estado)
    {        
        $this->cliente = $cliente;        
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

    public function getCliente(): Cliente
    {
        return $this->cliente;
    }

    public function setCliente(Cliente $cliente): void
    {
        $this->cliente = $cliente;
    }    

    public function getValor(): int
    {
        return $this->valor;
    }

    public function setValor(int $valor): void
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

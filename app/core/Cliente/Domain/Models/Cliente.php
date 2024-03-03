<?php

class Cliente 
{
    private string $id;
    private string $cedula;
    private string $nombres;
    private string $apellidos;    
    private bool $estado;    

    public function __construct(string $cedula, string $nombres, string $apellidos, bool $estado)
    {        
        $this->cedula = $cedula;
        $this->nombres = $nombres;
        $this->apellidos = $apellidos;        
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

    public function getCedula(): string
    {
        return $this->cedula;
    }

    public function setCedula(string $cedula): void
    {
        $this->cedula = $cedula;
    }

    public function getNombres(): string
    {
        return $this->nombres;
    }

    public function setNombres(string $nombres): void
    {
        $this->nombres = $nombres;
    }

    public function getApellidos(): string
    {
        return $this->apellidos;
    }

    public function setApellidos(string $apellidos): void
    {
        $this->apellidos = $apellidos;
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

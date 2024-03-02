<?php

class Usuario 
{
    private string $id;
    private string $correo;
    private string $nombre;
    private string $password;
    private bool $estado;    

    public function __construct(string $nombre, string $correo)
    {        
        $this->nombre = $nombre;
        $this->setCorreo($correo);
        $this->password = '';        
        $this->estado = false;        
    }

    private function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }

    public function getCorreo(): string
    {
        return $this->correo;
    }

    public function setCorreo(string $correo): void
    {
        if (!\filter_var($correo, \FILTER_VALIDATE_EMAIL)) {
            throw new \LogicException('Invalid email');
        }

        $this->correo = $correo;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }

    public function getEstado(): bool
    {
        return $this->estado;
    }

    public function setEstado(bool $estado): void
    {
        $this->estado = $estado;
    }

    public static function getUsuario(array $data): self {
        $usuario = new self($data['nombre'],$data['correo']);
        $usuario->setId($data['id']);
        $usuario->setEstado($data['estado']);
        return $usuario;
    }

}

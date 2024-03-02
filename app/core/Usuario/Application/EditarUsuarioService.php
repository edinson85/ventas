<?php


class EditarUsuarioService 
{
    protected $userRespository;
    protected $encoderService;

    /**
     * @param UserRepository $userRespository     // Contiene los metodos asociados a un usuario para interactura 
     *                                            // con la base de datos
     *                                                               // permite crear un usuario
     * @param EncoderService $encoderService      // Permite validar y generar un nuevo password
     */
    public function __construct() {
        $this->userRespository = new UserRepository();
        $this->encoderService = new EncoderService();
    }

    public function editar(string $id, string $nombre, string $correo, string $current_password, string $password, bool $estado): array {        
        try {
            $result['result'] = false;            
            $user = $this->userRespository->findUserById($id);
            $isValidPassword = false;
            if($user){       
                $isValidPassword = $this->encoderService->isValidPassword($current_password, $user->getPassword());
                if (!$isValidPassword) {
                    $result['current_password_err'] = 'The current password does not match';
                }                
            }
            if ($isValidPassword) {
                $user->setNombre($nombre);
                $user->setCorreo($correo);
                $user->setPassword($this->encoderService->encode($password));
                $user->setEstado($estado);
                $result['result'] = $this->userRespository->editar($user);
            }
            
        } catch (\Throwable $e) {            
            // TO DO ADD LOG
        }
        return $result;
    }

    public function obtenerUsuario(string $id): ?Usuario {        
        try {
            $usuario = null;
            $user = $this->userRespository->findUserById($id);
            if($user){               
                $usuario = $user;                        
            }
        } catch (\Throwable $e) {            
            // TO DO ADD LOG
        }
        return $usuario;
    }    

}
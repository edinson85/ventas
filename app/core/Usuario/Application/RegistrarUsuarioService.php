<?php


class RegistrarUsuarioService 
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

    public function registrar(string $nombre, string $correo, string $password): array {        
        try {
            $result['result'] = false;
            if($this->userRespository->findUserByEmail($correo)){
                $result['email_err'] = 'Email already exist';
            } else {
                $user = new Usuario($nombre, $correo);        
                $user->setPassword($this->encoderService->encode($password));
                $result['result'] = $this->userRespository->register($user);
            }
        } catch (\Exception $e) {            
            // TO DO ADD LOG
        }
        return $result;
    }

}
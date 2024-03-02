<?php


class LoginUsuarioService 
{
    protected $userRespository;    

    /**
     * @param UserRepository $userRespository     // Contiene los metodos asociados a un usuario para interactura 
     *                                            // con la base de datos     
     */
    public function __construct() {
        $this->userRespository = new UserRepository();        
    }

    public function login(string $correo, string $password): array {        
        try {
            $result['result'] = false;
            if(!$this->userRespository->findUserByEmail($correo, $password)){
                $result['email_err'] = 'User not found';
            } else {
                $loggedInUser = $this->userRespository->login($correo, $password);
                if($loggedInUser){
                    if (!$loggedInUser->estado) {
                        $result['email_err'] = 'User not active';
                    } else {
                        $result['result'] = true;                    
                        $_SESSION['user_id'] = $loggedInUser->id;
                        $_SESSION['name'] = $loggedInUser->name;
                        $_SESSION['email'] = $loggedInUser->email;
                    }
                } else {
                    $result['password_err'] = 'Password incorrect';
                }                
            }
        } catch (\Exception $e) {            
            // TO DO ADD LOG
        }
        return $result;
    }

}
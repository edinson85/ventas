<?php


class Users extends Controller{
        
    protected $registrarUsuarioService;
    protected $loginUsuarioService;    
    public function __construct()
    {        
        $this->registrarUsuarioService = new RegistrarUsuarioService();
        $this->loginUsuarioService = new LoginUsuarioService();
    }

    public function register(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            // process form
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);           
            $data = UsuarioValidations::validateDataRegister($_POST);    
            if ($data['result']) {
                $result = $this->registrarUsuarioService->registrar($data['name'], $data['email'], $data['password']);      
                if($result['result']){
                    flash('register_success', 'you are registerd you can login now');
                    redirect('users/login');
                } else {
                    $data['email_err'] = $result['email_err'];
                    unset($data['result']);
                }
            }
            $this->view('users/register', $data);                       
        }else{
            //init data
            $data = [
                'name' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => '' 
            ];
            //load view
            $this->view('users/register', $data);          
        }
    }

    public function login(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            // process form
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING); 
            $data = UsuarioValidations::validateLogin($_POST);                                                               
            if ($data['result']) {
                $resultLoggedInUser = $this->loginUsuarioService->login($data['email'], $data['password']);
                if($resultLoggedInUser['result']){                    
                    redirect('posts/index');
                }else{
                    if (isset($resultLoggedInUser['email_err'])) {
                        $data['email_err'] = $resultLoggedInUser['email_err'];
                    }
                    if (isset($resultLoggedInUser['password_err'])) {
                        $data['password_err'] = $resultLoggedInUser['password_err'];
                    }                    
                    $this->view('users/login', $data);
                }
            }else{
                $this->view('users/login', $data);
            }

        }else{
            //init data f f
            $data = [
                'email' => '',
                'password' => '',
                'email_err' => '',
                'password_err' => ''
            ];
            //load view
            $this->view('users/login', $data);          
        }
    }

    //logout and destroy user session
    public function logout(){
        unset($_SESSION['user_id']);
        unset($_SESSION['name']);
        unset($_SESSION['email']);
        session_destroy();
        redirect('users/login');
    }
}
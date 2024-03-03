<?php


class UsuarioValidations {

    public static function validateDataRegister(array $data):array {
        $error = true;
        $data = [
            'name' => trim($_POST['name']),
            'email' => trim($_POST['email']),
            'password' => trim($_POST['password']),
            'confirm_password' => trim($_POST['confirm_password']),
            'name_err' => '',
            'email_err' => '',
            'password_err' => '',
            'confirm_password_err' => '',
            'result' => true

        ];

        //valide name
        if(empty($data['name'])){
            $data['name_err'] = 'Por favor ingrese un nombre';            
            $error = false;
        }    

        //validate password 
        if(empty($data['password'])){
            $data['password_err'] = 'Por favor ingrese su password';
            $error = false;
        }elseif(strlen($data['password']) < 6){
            $data['password_err'] = 'El password debe de tener minimo 6 caracteres';
            $error = false;
        }

        //validate confirm password
        if(empty($data['confirm_password'])){
            $data['confirm_password_err'] = 'Por favor confirme su password';
            $error = false;
        }else{
            if($data['password'] != $data['confirm_password'])
            {
                $data['confirm_password_err'] = 'Los password no coinciden';
                $error = false;
            }
        }
        if(empty($data['email'])){
            $data['email_err'] = 'Por favor ingrese un correo';
            $error = false;
        }
        if(!$error) {
            $data['result'] = false;
        }

        return $data;
    }

    public static function validateLogin(array $data):array { 
        $error = true;
        $data = [
            'email' => trim($_POST['email']),
            'password' => trim($_POST['password']),
            'email_err' => '',
            'password_err' => '',
            'result' => true
        ];        
        if(empty($data['email'])){
            $data['email_err'] = 'Por favor ingrese un correo';
            $error = false;
        }
        if(empty($data['password'])){
            $data['password_err'] = 'Por favor ingrese su password';
            $error = false;
        }elseif(strlen($data['password']) < 6){
            $data['password_err'] = 'El password debe de tener minimo 6 caracteres';
            $error = false;
        }
        if(!$error) {
            $data['result'] = $error;
        }
         return $data;
    }

    public static function validateDataEditar(array $data):array {
        $error = true;
        $data = [
            'name' => trim($_POST['name']),
            'email' => trim($_POST['email']),
            'current_password' => trim($_POST['current_password']),
            'password' => trim($_POST['password']),
            'confirm_password' => trim($_POST['confirm_password']),
            'estado' => isset($_POST['estado']) ? true : false,
            'name_err' => '',
            'email_err' => '',
            'password_err' => '',
            'current_password_err' => '',
            'confirm_password_err' => '',
            'estado_err' => '',
            'result_validation' => true
        ];

        //valide name
        if(empty($data['name'])){
            $data['name_err'] = 'Por favor ingrese un nombre';            
            $error = false;
        }    

        //validate current password 
        if(empty($data['current_password'])){
            $data['current_password_err'] = 'Por favor ingrese su password actual';
            $error = false;
        }elseif(strlen($data['current_password']) < 6){
            $data['current_password_err'] = 'El password actual debe de tener minimo 6 caracteres';
            $error = false;
        }

        //validate password 
        if(empty($data['password'])){
            $data['password_err'] = 'Por favor ingrese su nuevo password';
            $error = false;
        }elseif(strlen($data['password']) < 6){
            $data['password_err'] = 'El nuevo password debe de tener minimo 6 caracteres';
            $error = false;
        }

        //validate confirm password
        if(empty($data['confirm_password'])){
            $data['confirm_password_err'] = 'Por favor confirme el password';
            $error = false;
        }else{
            if($data['password'] !== $data['confirm_password'])
            {
                $data['confirm_password_err'] = 'El password no coincide';
                $error = false;
            }
        }
        if(empty($data['email'])){
            $data['email_err'] = 'Por favor ingrese un correo';
            $error = false;
        }
        if(!$error) {
            $data['result_validation'] = false;
        }

        return $data;
    }    
}
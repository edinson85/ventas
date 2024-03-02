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
            $data['name_err'] = 'Please enter name';            
            $error = false;
        }    

        //validate password 
        if(empty($data['password'])){
            $data['password_err'] = 'Please enter your password';
            $error = false;
        }elseif(strlen($data['password']) < 6){
            $data['password_err'] = 'Password must be atleast six characters';
            $error = false;
        }

        //validate confirm password
        if(empty($data['confirm_password'])){
            $data['confirm_password_err'] = 'Please confirm password';
            $error = false;
        }else{
            if($data['password'] != $data['confirm_password'])
            {
                $data['confirm_password_err'] = 'Password does not match';
                $error = false;
            }
        }
        if(empty($data['email'])){
            $data['email_err'] = 'Please enter email';
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
            $data['email_err'] = 'Please enter email';
            $error = false;
        }
        if(empty($data['password'])){
            $data['password_err'] = 'Please enter your password';
            $error = false;
        }elseif(strlen($data['password']) < 6){
            $data['password_err'] = 'Password must be atleast six characters';
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
            $data['name_err'] = 'Please enter name';            
            $error = false;
        }    

        //validate current password 
        if(empty($data['current_password'])){
            $data['current_password_err'] = 'Please enter your current password';
            $error = false;
        }elseif(strlen($data['current_password']) < 6){
            $data['current_password_err'] = 'Current password must be atleast six characters';
            $error = false;
        }

        //validate password 
        if(empty($data['password'])){
            $data['password_err'] = 'Please enter your new password';
            $error = false;
        }elseif(strlen($data['password']) < 6){
            $data['password_err'] = 'New password must be atleast six characters';
            $error = false;
        }

        //validate confirm password
        if(empty($data['confirm_password'])){
            $data['confirm_password_err'] = 'Please confirm password';
            $error = false;
        }else{
            if($data['password'] !== $data['confirm_password'])
            {
                $data['confirm_password_err'] = 'Password does not match';
                $error = false;
            }
        }
        if(empty($data['email'])){
            $data['email_err'] = 'Please enter email';
            $error = false;
        }
        if(!$error) {
            $data['result_validation'] = false;
        }

        return $data;
    }    
}
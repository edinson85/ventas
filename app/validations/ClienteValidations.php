<?php


class ClienteValidations {

    private static function generalValidate(array $data) {
        $error = true;                
        //valide cedula
        if(empty($data['cedula'])){
            $data['err'] = 'Please enter cedula';            
            $error = false;
        }    
        //valide nombres
        if(empty($data['nombres'])){
            $data['err'] = 'Please enter nombres';            
            $error = false;
        }    
        //valide apellidos
        if(empty($data['apellidos'])){
            $data['err'] = 'Please enter apellidos';            
            $error = false;
        }    
        //valide estado
        if(!isset($data['estado'])){
            $data['err'] = 'Please enter estado';            
            $error = false;
        }    
        if(!$error) {
            $data['result'] = false;
        }
        return $data;        
    }
    public static function validateDataRegister(array $dataPost):array {                
        $data = [
            'cedula' => trim($dataPost['cedula']),
            'nombres' => trim($dataPost['nombres']),
            'apellidos' => trim($dataPost['apellidos']),
            'estado' => filter_var(trim($dataPost['estado']), FILTER_VALIDATE_BOOLEAN),              
            'result' => true,              
        ];
        $data = self::generalValidate($data);
        return $data;
    }

    public static function validateDataEditar(array $dataPost):array {
        $error = true;          
        $data = [
            'cedula' => trim($dataPost['cedula']),
            'nombres' => trim($dataPost['nombres']),
            'apellidos' => trim($dataPost['apellidos']),
            'estado' => filter_var(trim($dataPost['estado']), FILTER_VALIDATE_BOOLEAN),              
            'result' => true,              
        ];
        $data = self::generalValidate($data);
        if($data['result']) {
            $data['id'] = trim($dataPost['id']);
            //valide id
            if(empty($data['id'])){
                $data['err'] = 'Please enter id';            
                $error = false;
            }
            if(!$error) {
                $data['result'] = false;
            }
        }        
        return $data;
    }

    public static function validateDataElimianr(array $dataPost):array {
        $error = true;          
        $data['id'] = trim($dataPost['id']);
        $data['result'] = true;
        //valide id
        if(empty($data['id'])){
            $data['err'] = 'Please enter id';            
            $error = false;
        }
        if(!$error) {
            $data['result'] = false;
        }              
        return $data;
    }    

 
}
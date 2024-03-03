<?php


class ClienteValidations {

    public static function validateDataRegister(array $dataPost):array {
        $error = true;        
        $data = [
            'cedula' => trim($dataPost['cedula']),
            'nombres' => trim($dataPost['nombres']),
            'apellidos' => trim($dataPost['apellidos']),
            'estado' => filter_var(trim($dataPost['estado']), FILTER_VALIDATE_BOOLEAN),              
            'result' => true,              
        ];

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
        if(empty($data['estado'])){
            $data['err'] = 'Please enter estado';            
            $error = false;
        }    
        if(!$error) {
            $data['result'] = false;
        }

        return $data;
    }

 
}
<?php


class ProductoValidations {

    private static function generalValidate(array $data) {
        $error = true;                        
        //valide nombre
        if(empty($data['nombre'])){
            $data['err'] = 'Por favor ingrese un nombre valido';            
            $error = false;
        }    
        //valide valor
        if(empty($data['valor'])){
            $data['err'] = 'Por favor ingrese un valor valido';            
            $error = false;
        }    
        //valide estado
        if(!isset($data['estado'])){
            $data['err'] = 'Por favor ingrese un estado';            
            $error = false;
        }   
        // validate numeric fields 
        if($error) {
            if(!is_int($data['nombre']) || !is_int($data['valor'])){
                $data['err'] = 'El nombre o valor deben ser numericos';            
                $error = false;
            }   
        }
        if(!$error) {
            $data['result'] = false;
        }
        return $data;        
    }
    public static function validateDataRegister(array $dataPost):array {                        
        $data = [            
            'nombre' => intval(trim($dataPost['nombre'])),
            'valor' => intval(trim($dataPost['valor'])),
            'estado' => filter_var(trim($dataPost['estado']), FILTER_VALIDATE_BOOLEAN),              
            'result' => true,              
        ];
        $data = self::generalValidate($data);
        return $data;
    }

    public static function validateDataEditar(array $dataPost):array {
        $error = true;          
        $data = [            
            'nombre' => intval(trim($dataPost['nombre'])),
            'valor' => intval(trim($dataPost['valor'])),
            'estado' => filter_var(trim($dataPost['estado']), FILTER_VALIDATE_BOOLEAN),              
            'result' => true,              
        ];
        $data = self::generalValidate($data);
        if($data['result']) {
            $data['id'] = trim($dataPost['id']);
            //valide id
            if(empty($data['id'])){
                $data['err'] = 'Id no encontrado';            
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
            $data['err'] = 'Id no encontrado';            
            $error = false;
        }
        if(!$error) {
            $data['result'] = false;
        }              
        return $data;
    }    

 
}
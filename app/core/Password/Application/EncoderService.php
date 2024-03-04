<?php


/**
 * Permite validar y generar un nuevo password
 */
class EncoderService 
{   
    public function isValidPassword(string $password, string $hash_password): bool {        
        $result = false;
        if(password_verify($password, $hash_password)){
            $result = true;
        }
        return $result;
    }

    public function encode(string $value): string {
        return password_hash($value, PASSWORD_DEFAULT);
    }
}
<?php


/**
 * Permite validar y generar un nuevo password
 */
class EncoderService 
{
    /*
    public function generateEncodedPassword(string $password): string {
        $this->isValidPassword($password);
        return $this->encrypt($password);
    }

    public function encrypt(string $password): string {
        return Hash::make($password);
    }
    */
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
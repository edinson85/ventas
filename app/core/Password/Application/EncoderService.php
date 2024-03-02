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

    public function isValidPassword(string $password): void {
        $expresion = env('REGULAR_PHRASE');
        if ($expresion != '' && preg_match_all($expresion, $password) == 0) {
            throw PasswordException::invalidFormat();
        }
        if (env('MINIMUM_LENGTH') > \strlen($password)) {
            throw PasswordException::invalidLength();
        }
    }*/

    public function encode(string $value): string {
        return password_hash($value, PASSWORD_DEFAULT);
    }
}
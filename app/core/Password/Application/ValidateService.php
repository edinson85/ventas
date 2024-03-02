<?php
/*
class ValidateService implements ValidateServiceInterface
{
    public function validatePassword(string $passwordRequest, string $passwordUser): void {
        if (!Hash::check($passwordRequest, $passwordUser)) {
            throw PasswordException::credentialsIncorrect();
        }
    }

    public function needsRehash(string $passwordRequest, string $passwordUser): string {
        if (Hash::needsRehash($passwordUser)) {
            $passwordUser = Hash::make($passwordRequest);
        }
        return $passwordUser;
    }
}*/
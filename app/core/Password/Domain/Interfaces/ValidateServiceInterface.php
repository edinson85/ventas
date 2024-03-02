<?php


interface ValidateServiceInterface
{
    public function validatePassword(string $email, string $password): void;
    public function needsRehash(string $passwordRequest, string $passwordUser): string;

}

<?php

interface EncoderServiceInterface
{
    public function generateEncodedPassword(string $password): string;
    public function encrypt(string $password): string;
    public function isValidPassword(string $password): void;
    public function encodeBcrypt(string $value): string;
}

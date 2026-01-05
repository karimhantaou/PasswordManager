<?php

namespace Helpers;
require_once dirname(__DIR__, 2) . '/vendor/autoload.php';

Class DatabaseHelpers{

    // Déchiffrement d'une chaine de charactères
    function decipher($data) {
        // Conversion de la clé de chiffrement en base64
        $key = base64_decode($_ENV['KEY']);

        // Conversion du chiffrage en base64
        $data = base64_decode($data);

        // Extraction de l'iv
        $iv = substr($data, strlen($data) - 16);

        // Extraction du chiffrage
        $decryptedData = substr($data, 0, strlen($data) - 16);

        // Déchiffrement
        $decryptedData = openssl_decrypt($decryptedData, "aes-256-cbc", $key, 0, $iv);

        return $decryptedData;
    }

    // Encrypt
    public function cipher($data) {

        // Conversion de la clé de chiffrement en base64
        $key = base64_decode($_ENV['KEY']);

        // Création de l'iv
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length("aes-256-cbc"));

        // Chiffrement de la chaine de caractères
        $encryptedData = openssl_encrypt($data, "aes-256-cbc", $key, 0, $iv);

        // Concatenation de l'iv et du chiffrage et mise en base64
        $encryptedData = base64_encode($encryptedData . $iv);

        return $encryptedData;
    }
}
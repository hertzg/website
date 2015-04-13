<?php

namespace Email;

function isValid ($email) {

    include_once __DIR__.'/maxLength.php';
    if (strlen($email) > maxLength()) return false;

    $parts = explode('@', $email);
    if (count($parts) !== 2) return false;

    $domainName = $parts[1];
    if (strpos($domainName, '.') === false) return false;

    include_once __DIR__.'/../DomainName/isValid.php';
    if (!\DomainName\isValid($domainName)) return false;

    $username = $parts[0];
    return preg_match('/^[a-z0-9._-]+$/', $username) &&
        !preg_match('/(^[._-]|\.\.|-\.|\.-|[._-]$)/', $username);

}

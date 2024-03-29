<?php

namespace SendForm\NewItem;

function submitAddPage ($mysqli, $user,
    $errorsKey, $messagesKey, $valuesKey, $checkFunction) {

    include_once __DIR__.'/../requestUsernameAddress.php';
    \SendForm\requestUsernameAddress($username, $parsed_username, $address);

    $fnsDir = __DIR__.'/../..';

    include_once "$fnsDir/ItemList/pageQuery.php";
    $url = './'.\ItemList\pageQuery();

    if (!array_key_exists($valuesKey, $_SESSION)) {
        $_SESSION[$valuesKey] = [
            'recipients' => [],
            'username' => '',
            'usernameError' => false,
        ];
    }

    include_once "$fnsDir/redirect.php";

    if (array_key_exists($username, $_SESSION[$valuesKey]['recipients'])) {
        unset($_SESSION[$errorsKey]);
        $_SESSION[$messagesKey] = ['The recipient is already added.'];
        $_SESSION[$valuesKey]['username'] = '';
        $_SESSION[$valuesKey]['usernameError'] = false;
        redirect($url);
    }

    include_once __DIR__.'/../checkUsernameAddress.php';
    \SendForm\checkUsernameAddress($mysqli, $username,
        $parsed_username, $address, $checkFunction, $errors);

    if ($errors) {
        unset($_SESSION[$messagesKey]);
        $_SESSION[$errorsKey] = $errors;
        $_SESSION[$valuesKey]['username'] = $username;
        $_SESSION[$valuesKey]['usernameError'] = true;
        redirect($url);
    }

    unset($_SESSION[$errorsKey]);
    $_SESSION[$valuesKey]['recipients'][$username] = $username;
    ksort($_SESSION[$valuesKey]['recipients']);
    $_SESSION[$valuesKey]['username'] = '';
    $_SESSION[$valuesKey]['usernameError'] = false;
    $_SESSION[$messagesKey] = ['The recipient has been added.'];
    redirect($url);

}

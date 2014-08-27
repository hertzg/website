<?php

namespace SendForm\NewItem;

function submitAddPage ($user, $errorsKey,
    $messagesKey, $valuesKey, $checkFunction) {

    include_once __DIR__.'/../../request_strings.php';
    list($username) = request_strings('username');
    $username = preg_replace('/\s+/', '', $username);

    include_once __DIR__.'/../../ItemList/pageQuery.php';
    $url = './'.\ItemList\pageQuery();

    if (!array_key_exists($valuesKey, $_SESSION)) {
        $_SESSION[$valuesKey] = [
            'recipients' => [],
            'username' => '',
            'usernameError' => false,
        ];
    }

    include_once __DIR__.'/../../redirect.php';

    if (array_key_exists($username, $_SESSION[$valuesKey]['recipients'])) {
        unset($_SESSION[$errorsKey]);
        $_SESSION[$messagesKey] = ['The recipient is already added.'];
        $_SESSION[$valuesKey]['username'] = '';
        $_SESSION[$valuesKey]['usernameError'] = false;
        redirect($url);
    }

    $checkFunction($username, $errors);

    if ($errors) {
        unset($_SESSION[$messagesKey]);
        $_SESSION[$errorsKey] = $errors;
        $_SESSION[$valuesKey]['username'] = $username;
        $_SESSION[$valuesKey]['usernameError'] = true;
        redirect($url);
    }

    unset($_SESSION[$errorsKey]);
    $_SESSION[$valuesKey]['recipients'][$username] = $username;
    $_SESSION[$valuesKey]['username'] = '';
    $_SESSION[$valuesKey]['usernameError'] = false;
    $_SESSION[$messagesKey] = ['The recipient has been added.'];
    redirect($url);

}

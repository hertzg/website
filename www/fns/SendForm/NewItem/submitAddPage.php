<?php

namespace SendForm\NewItem;

function submitAddPage ($mysqli, $user,
    $errorsKey, $messagesKey, $valuesKey, $checkFunction) {

    $fnsDir = __DIR__.'/../..';

    include_once "$fnsDir/request_strings.php";
    list($username) = request_strings('username');
    $username = preg_replace('/\s+/', '', $username);

    include_once "$fnsDir/parse_username_address.php";
    parse_username_address($username, $parsed_username, $address);

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

    if ($address === null) $checkFunction($username, $errors);
    else {
        include_once "$fnsDir/AdminConnections/getByAddress.php";
        $adminConnection = \AdminConnections\getByAddress($mysqli, $address);
        if ($adminConnection) $errors = [];
        else {
            $errors[] = 'Sending to anyone at "'
                .htmlspecialchars($address).'" is unavailable.';
        }
    }

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

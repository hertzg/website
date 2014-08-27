<?php

namespace SendForm;

function submitSendPage ($user, $id, $errorsKey, $messagesKey,
    $valuesKey, $viewMessagesKey, $checkFunction, $sendFunction) {

    include_once __DIR__.'/../redirect.php';

    if (!array_key_exists($valuesKey, $_SESSION)) {
        include_once __DIR__.'/../ItemList/itemQuery.php';
        redirect('./'.\ItemList\itemQuery($id));
    }

    $recipients = $_SESSION[$valuesKey]['recipients'];
    if (!$recipients) {
        include_once __DIR__.'/../ItemList/itemQuery.php';
        redirect('./'.\ItemList\itemQuery($id));
    }

    $checkFunction($recipients, $receiver_id_userss, $errors);

    if ($errors) {
        $_SESSION[$errorsKey] = $errors;
        unset($_SESSION[$messagesKey]);
        include_once __DIR__.'/../ItemList/itemQuery.php';
        redirect('./'.\ItemList\itemQuery($id));
    }

    $sendFunction($receiver_id_userss);

    unset(
        $_SESSION[$errorsKey],
        $_SESSION[$valuesKey]
    );

    $_SESSION[$viewMessagesKey] = ['Sent.'];

    redirect("../view/$itemQuery");

}

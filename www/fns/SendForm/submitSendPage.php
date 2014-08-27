<?php

namespace SendForm;

function submitSendPage ($user, $id, $errorsKey, $messagesKey,
    $valuesKey, $viewMessagesKey, $checkFunction, $sendFunction) {

    include_once __DIR__.'/../ItemList/itemQuery.php';
    $itemQuery = \ItemList\itemQuery($id);

    $url = "./$itemQuery";
    include_once __DIR__.'/../redirect.php';

    if (!array_key_exists($valuesKey, $_SESSION)) redirect($url);

    $recipients = $_SESSION[$valuesKey]['recipients'];
    if (!$recipients) redirect($url);

    $checkFunction($recipients, $receiver_id_userss, $errors);

    if ($errors) {
        $_SESSION[$errorsKey] = $errors;
        unset($_SESSION[$messagesKey]);
        redirect($url);
    }

    $sendFunction($receiver_id_userss);

    unset(
        $_SESSION[$errorsKey],
        $_SESSION[$valuesKey]
    );

    $_SESSION[$viewMessagesKey] = ['Sent.'];

    redirect("../view/$itemQuery");

}

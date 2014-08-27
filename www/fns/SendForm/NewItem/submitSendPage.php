<?php

namespace SendForm\NewItem;

function submitSendPage ($user, $errorsKey, $messagesKey,
    $valuesKey, $viewMessagesKey, $checkFunction, $sendFunction) {

    include_once __DIR__.'/../../redirect.php';

    if (!array_key_exists($valuesKey, $_SESSION)) {
        include_once __DIR__.'/../../ItemList/pageQuery.php';
        redirect('./'.\ItemList\pageQuery());
    }

    $recipients = $_SESSION[$valuesKey]['recipients'];
    if (!$recipients) {
        include_once __DIR__.'/../../ItemList/pageQuery.php';
        redirect('./'.\ItemList\pageQuery());
    }

    $checkFunction($recipients, $receiver_id_userss, $errors);

    if ($errors) {
        $_SESSION[$errorsKey] = $errors;
        unset($_SESSION[$messagesKey]);
        include_once __DIR__.'/../../ItemList/pageQuery.php';
        redirect('./'.\ItemList\pageQuery());
    }

    $sendFunction($receiver_id_userss);

    unset(
        $_SESSION[$errorsKey],
        $_SESSION[$valuesKey]
    );

    $_SESSION[$viewMessagesKey] = ['Sent.'];

    include_once __DIR__.'/../../ItemList/listHref.php';
    redirect('../'.\ItemList\listHref());

}

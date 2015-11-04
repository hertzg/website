<?php

namespace SendForm\NewItem;

function submitSendPage ($user, $errorsKey, $messagesKey,
    $valuesKey, $viewMessagesKey, $checkFunction, $sendFunction) {

    $fnsDir = __DIR__.'/../..';

    include_once "$fnsDir/redirect.php";

    if (!array_key_exists($valuesKey, $_SESSION)) {
        include_once "$fnsDir/ItemList/pageQuery.php";
        redirect('./'.\ItemList\pageQuery());
    }

    $recipients = $_SESSION[$valuesKey]['recipients'];
    if (!$recipients) {
        include_once "$fnsDir/ItemList/pageQuery.php";
        redirect('./'.\ItemList\pageQuery());
    }

    $local_recipients = [];
    $external_recipients = [];
    include_once "$fnsDir/parse_username_address.php";
    foreach ($recipients as $recipient) {
        parse_username_address($recipient, $username, $address);
        if ($address === null) {
            $local_recipients[] = $recipient;
        } else {
            $external_recipients[] = [
                'username' => $username,
                'address' => $address,
            ];
        }
    }

    $checkFunction($local_recipients, $receiver_id_userss, $errors);

    if ($errors) {
        $_SESSION[$errorsKey] = $errors;
        unset($_SESSION[$messagesKey]);
        include_once "$fnsDir/ItemList/pageQuery.php";
        redirect('./'.\ItemList\pageQuery());
    }

    $sendFunction($receiver_id_userss);

    unset(
        $_SESSION[$errorsKey],
        $_SESSION[$valuesKey]
    );

    $_SESSION[$viewMessagesKey] = ['Sent.'];

    include_once "$fnsDir/ItemList/listHref.php";
    redirect('../'.\ItemList\listHref());

}

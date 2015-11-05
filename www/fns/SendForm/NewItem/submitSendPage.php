<?php

namespace SendForm\NewItem;

function submitSendPage ($mysqli, $user, $errorsKey, $messagesKey, $valuesKey,
    $viewMessagesKey, $checkFunction, $sendFunction, $sendExternalFunction) {

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
        if ($address === null) $local_recipients[] = $recipient;
        else {
            $external_recipients[] = [
                'username' => $username,
                'address' => $address,
            ];
        }
    }

    $checkFunction($local_recipients, $receiver_id_userss, $errors);

    include_once __DIR__.'/../checkExternalRecipients.php';
    \SendForm\checkExternalRecipients($mysqli, $external_recipients, $errors);

    if ($errors) {
        $_SESSION[$errorsKey] = $errors;
        unset($_SESSION[$messagesKey]);
        include_once "$fnsDir/ItemList/pageQuery.php";
        redirect('./'.\ItemList\pageQuery());
    }

    if ($local_recipients) $sendFunction($receiver_id_userss);
    if ($external_recipients) $sendExternalFunction($external_recipients);

    unset($_SESSION[$errorsKey], $_SESSION[$valuesKey]);

    $_SESSION[$viewMessagesKey] = ['Sent.'];

    include_once "$fnsDir/ItemList/listHref.php";
    redirect('../'.\ItemList\listHref());

}

<?php

namespace SendForm\EditItem;

function submitSendPage ($mysqli, $user, $id, $errorsKey,
    $messagesKey, $valuesKey, $viewMessagesKey, $checkFunction,
    $sendFunction, $sendExternalFunction, $viewErrorsKey = null) {

    $fnsDir = __DIR__.'/../..';

    include_once "$fnsDir/ItemList/itemQuery.php";
    $itemQuery = \ItemList\itemQuery($id);

    include_once "$fnsDir/redirect.php";

    if (!array_key_exists($valuesKey, $_SESSION)) redirect("./$itemQuery");

    $recipients = $_SESSION[$valuesKey]['recipients'];
    if (!$recipients) redirect("./$itemQuery");

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
        redirect("./$itemQuery");
    }

    if ($local_recipients) $sendFunction($receiver_id_userss);
    if ($external_recipients) $sendExternalFunction($external_recipients);

    unset($_SESSION[$errorsKey], $_SESSION[$valuesKey]);
    if ($viewErrorsKey !== null) unset($_SESSION[$viewErrorsKey]);

    $_SESSION[$viewMessagesKey] = ['Sent.'];

    redirect("../../view/$itemQuery");

}

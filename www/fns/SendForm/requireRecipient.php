<?php

namespace SendForm;

function requireRecipient ($id, $valuesKey) {

    $fnsDir = __DIR__.'/..';

    if (!array_key_exists($valuesKey, $_SESSION)) {
        include_once "$fnsDir/redirect.php";
        include_once "$fnsDir/ItemList/itemQuery.php";
        redirect('../'.\ItemList\itemQuery($id));
    }

    $recipients = $_SESSION[$valuesKey]['recipients'];

    include_once "$fnsDir/request_strings.php";
    list($username) = request_strings('username');
    if (!array_key_exists($username, $recipients)) {
        include_once "$fnsDir/redirect.php";
        include_once "$fnsDir/ItemList/itemQuery.php";
        redirect('../'.\ItemList\itemQuery($id));
    }

    return [$username, $recipients];

}

<?php

namespace SendForm\NewItem;

function requireRecipient ($valuesKey) {

    $fnsDir = __DIR__.'/../..';

    if (!array_key_exists($valuesKey, $_SESSION)) {
        include_once "$fnsDir/redirect.php";
        include_once "$fnsDir/ItemList/pageQuery.php";
        redirect('../'.\ItemList\pageQuery());
    }

    $recipients = $_SESSION[$valuesKey]['recipients'];

    include_once "$fnsDir/request_strings.php";
    list($username) = request_strings('username');
    if (!array_key_exists($username, $recipients)) {
        include_once "$fnsDir/redirect.php";
        include_once "$fnsDir/ItemList/pageQuery.php";
        redirect('../'.\ItemList\pageQuery());
    }

    return $username;

}

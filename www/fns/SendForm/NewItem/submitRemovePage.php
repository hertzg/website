<?php

namespace SendForm\NewItem;

function submitRemovePage ($username, $messagesKey, $valuesKey) {

    if (array_key_exists($valuesKey, $_SESSION)) {
        unset($_SESSION[$valuesKey]['recipients'][$username]);
    }

    $_SESSION[$messagesKey] = ['The recipient has been removed.'];

    include_once __DIR__.'/../../redirect.php';
    include_once __DIR__.'/../../ItemList/pageQuery.php';
    redirect('../'.\ItemList\pageQuery());

}

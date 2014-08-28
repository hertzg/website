<?php

namespace SendForm\EditItem;

function submitCancelPage ($id, $valuesKey) {

    if (array_key_exists($valuesKey, $_SESSION)) {
        $_SESSION[$valuesKey]['usernameError'] = false;
    }

    include_once __DIR__.'/../../redirect.php';
    include_once __DIR__.'/../../ItemList/itemQuery.php';
    redirect('./'.\ItemList\itemQuery($id));

}

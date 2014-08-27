<?php

namespace SendForm\NewItem;

function submitCancelPage ($valuesKey) {

    if (array_key_exists($valuesKey, $_SESSION)) {
        $_SESSION[$valuesKey]['usernameError'] = false;
    }

    include_once __DIR__.'/../../redirect.php';
    include_once __DIR__.'/../../ItemList/pageQuery.php';
    redirect('./'.\ItemList\pageQuery());

}

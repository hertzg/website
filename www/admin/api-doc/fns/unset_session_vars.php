<?php

function unset_session_vars () {

    include_once __DIR__.'/../../../fns/session_start_custom.php';
    session_start_custom($new);

    unset(
        $_SESSION['admin/messages'],
        $_SESSION['admin/api-keys/new/errors'],
        $_SESSION['admin/api-keys/new/values'],
        $_SESSION['admin/api-keys/view/messages']
    );

}

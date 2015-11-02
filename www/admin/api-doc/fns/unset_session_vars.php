<?php

function unset_session_vars () {

    include_once __DIR__.'/../../../fns/session_start_custom.php';
    session_start_custom($new);

    unset($_SESSION['admin/messages']);

}

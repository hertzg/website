<?php

include_once '../../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once 'fns/require_stage.php';
require_stage();

unset(
    $_SESSION['tasks/new/send/errors'],
    $_SESSION['tasks/new/send/messages']
);

include_once '../../../fns/SendForm/NewItem/submitCancelPage.php';
SendForm\NewItem\submitCancelPage('tasks/new/send/values');

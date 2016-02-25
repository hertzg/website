<?php

include_once '../../../../lib/defaults.php';

include_once '../../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once 'fns/require_stage.php';
require_stage();

unset(
    $_SESSION['contacts/new/send/errors'],
    $_SESSION['contacts/new/send/messages']
);

include_once '../../../fns/SendForm/NewItem/submitCancelPage.php';
SendForm\NewItem\submitCancelPage('contacts/new/send/values');

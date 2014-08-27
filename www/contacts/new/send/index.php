<?php

include_once 'fns/require_stage.php';
list($user) = require_stage();

include_once '../../../fns/SendForm/NewItem/recipientsPage.php';
include_once '../../../lib/mysqli.php';
SendForm\NewItem\recipientsPage($mysqli, $user,
    'Send New Contact', 'contact', 'contacts/new/send/errors',
    'contacts/new/send/messages', 'contacts/new/send/values');

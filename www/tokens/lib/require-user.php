<?php

include_once __DIR__.'/../../lib/user.php';
if (!$user) {
    include_once __DIR__.'/../../fns/redirect.php';
    redirect('../sign-in/');
}

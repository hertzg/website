<?php

include_once 'fns/redirect.php';
include_once 'lib/session-start.php';
unset($_SESSION['user']);
redirect();

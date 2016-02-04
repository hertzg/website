<?php

include_once 'fns/unset_session_vars.php';
unset_session_vars();

header('Content-Type: application/json');
echo 'true';

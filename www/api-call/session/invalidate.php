<?php

include_once '../../fns/session_start_custom.php';
session_start_custom();

session_destroy();
session_start_custom();

header('Content-Type: application/json');
echo 'true';

<?php

include_once 'fns/require_api_key.php';
require_api_key(null, $apiKey, $user, $mysqli);

header('Content-Type: application/json');
echo 'true';

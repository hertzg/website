<?php

include_once 'fns/require_admin_api_key.php';
require_admin_api_key(null, $apiKey, $mysqli);

header('Content-Type: application/json');
echo 'true';
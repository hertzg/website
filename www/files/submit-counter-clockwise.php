<?php

include_once '../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once 'fns/require_file.php';
include_once '../lib/mysqli.php';
list($file, $id, $user) = require_file($mysqli);

include_once '../fns/redirect.php';
redirect("view-file/?id=$id");

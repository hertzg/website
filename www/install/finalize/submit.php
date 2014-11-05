<?php

include_once 'fns/require_values.php';
list($values, $mysqli) = require_values();

include_once '../../fns/redirect.php';
redirect('../done/');

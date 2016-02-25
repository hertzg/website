<?php

include_once '../../../lib/defaults.php';

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once 'fns/require_image_file.php';
include_once '../../lib/mysqli.php';
list($file, $id, $user) = require_image_file($mysqli);

include_once 'fns/rotate_image.php';
rotate_image($mysqli, $file, 90);

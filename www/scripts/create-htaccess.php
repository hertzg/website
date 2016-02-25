#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../lib/cli.php';
include_once '../../lib/defaults.php';

include_once '../fns/write_current_htaccess.php';
write_current_htaccess();

#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../lib/cli.php';

include_once '../fns/write_htaccess.php';
write_htaccess();

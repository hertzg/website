#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../lib/cli.php';

chdir('..');
system("for i in `find | grep php`; do php -l \$i > /dev/null; done");

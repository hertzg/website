#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../../../lib/cli.php';
include_once '../../../lib/mysqli.php';

include_once '../../../fns/AdminApiKeys/ensure.php';
echo AdminApiKeys\ensure($mysqli);

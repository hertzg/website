#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../lib/cli.php';

include_once '../fns/Theme/Color/getDefault.php';
$theme_color = Theme\Color\getDefault();

chdir('..');
system("convert theme/color/$theme_color/images/icon16.png favicon.ico");

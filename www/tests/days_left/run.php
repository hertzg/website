#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../../lib/defaults.php';
include_once 'fns/check.php';

check(2, 0, 0, 0);
check(2, 0, 1, 1);
check(2, 0, 2, 0);
check(2, 0, 3, 1);

check(3, 0, 0, 0);
check(3, 0, 1, 2);
check(3, 0, 2, 1);
check(3, 0, 3, 0);
check(3, 0, 4, 2);
check(3, 0, 5, 1);

check(4, 0, 0, 0);
check(4, 0, 1, 3);
check(4, 0, 2, 2);
check(4, 0, 3, 1);
check(4, 0, 4, 0);
check(4, 0, 5, 3);

check(5, 0, 0, 0);
check(5, 0, 1, 4);
check(5, 0, 2, 3);
check(5, 0, 3, 2);
check(5, 0, 4, 1);
check(5, 0, 5, 0);

check(2, 1, 0, 1);
check(2, 1, 1, 0);
check(2, 1, 2, 1);
check(2, 1, 3, 0);

check(3, 1, 0, 1);
check(3, 1, 1, 0);
check(3, 1, 2, 2);
check(3, 1, 3, 1);
check(3, 1, 4, 0);
check(3, 1, 5, 2);

check(5, 2, 0, 2);
check(5, 2, 1, 1);
check(5, 2, 2, 0);
check(5, 2, 3, 4);
check(5, 2, 4, 3);
check(5, 2, 5, 2);

check(5, 3, 0, 3);
check(5, 3, 1, 2);
check(5, 3, 2, 1);
check(5, 3, 3, 0);
check(5, 3, 4, 4);
check(5, 3, 5, 3);

check(7, 0, 0, 0);
check(7, 0, 1, 6);
check(7, 0, 2, 5);
check(7, 0, 3, 4);
check(7, 0, 4, 3);
check(7, 0, 5, 2);
check(7, 0, 6, 1);
check(7, 0, 7, 0);
check(7, 0, 8, 6);

check(7, 1, 0, 1);
check(7, 1, 1, 0);
check(7, 1, 2, 6);
check(7, 1, 3, 5);
check(7, 1, 4, 4);
check(7, 1, 5, 3);
check(7, 1, 6, 2);
check(7, 1, 7, 1);
check(7, 1, 8, 0);

check(7, 2, 0, 2);
check(7, 2, 1, 1);
check(7, 2, 2, 0);
check(7, 2, 3, 6);
check(7, 2, 4, 5);
check(7, 2, 5, 4);
check(7, 2, 6, 3);
check(7, 2, 7, 2);
check(7, 2, 8, 1);

echo 'Done '.__FILE__."\n";

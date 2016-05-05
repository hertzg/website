#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../lib/defaults.php';
include_once '../fns/n_times.php';
assert(n_times(-1) === '-1 times');
assert(n_times(0) === 'never');
assert(n_times(1) === 'once');
assert(n_times(2) === 'twice');
assert(n_times(3) === '3 times');
assert(n_times(123) === '123 times');

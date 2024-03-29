#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../lib/defaults.php';
include_once '../fns/str_split_lines.php';
assert(str_split_lines("") === []);
assert(str_split_lines("\n") === ['', '']);
assert(str_split_lines("\n", 1) === ["\n"]);
assert(str_split_lines("\n", 2) === ['', '']);
assert(str_split_lines("\n\n") === ['', '', '']);
assert(str_split_lines("\n\n", 1) === ["\n\n"]);
assert(str_split_lines("\n\n", 2) === ['', "\n"]);
assert(str_split_lines(" \n ") === [' ', ' ']);

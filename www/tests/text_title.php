#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../lib/defaults.php';
include_once '../fns/text_title.php';
assert(text_title('', 10) === '');
assert(text_title('1234567890', 5) === '12345');
assert(text_title('1234567890', 12) === '1234567890');
assert(text_title("1234567890\nabcdefgh", 5) === '12345');
assert(text_title("1234567890\nabcdefgh", 12) === '1234567890');

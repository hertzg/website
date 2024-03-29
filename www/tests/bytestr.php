#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../lib/defaults.php';
include_once '../fns/bytestr.php';
assert(bytestr(0) === '0 B');
assert(bytestr(64) === '64 B');
assert(bytestr(512) === '512 B');
assert(bytestr(1023) === '1,023 B');
assert(bytestr(1024) === '1 KB');
assert(bytestr(1024 * 2.5) === '2.5 KB');
assert(bytestr(1024 * 1024) === '1 MB');
assert(bytestr(1024 * 1024 * 2.5) === '2.5 MB');
assert(bytestr(1024 * 1024 * 1024) === '1 GB');
assert(bytestr(1024 * 1024 * 1024 * 2.5) === '2.5 GB');
assert(bytestr(1024 * 1024 * 1024 * 1024) === '1 TB');
assert(bytestr(1024 * 1024 * 1024 * 1024 * 2.5) === '2.5 TB');

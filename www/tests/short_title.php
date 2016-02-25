#!/usr/bin/php
<?php

include_once '../../lib/defaults.php';

include_once __DIR__.'/../fns/short_number.php';

assert(short_number(0) === '0');

assert(short_number(1) === '1');
assert(short_number(-1) === '-1');
assert(short_number(1.01) === '>1');
assert(short_number(-1.01) === '<-1');

assert(short_number(1.5) === '1.5');
assert(short_number(-1.5) === '-1.5');
assert(short_number(1.501) === '>1.5');
assert(short_number(-1.501) === '<-1.5');

assert(short_number(1000) === '1k');
assert(short_number(-1000) === '-1k');
assert(short_number(1010) === '>1k');
assert(short_number(-1010) === '<-1k');

assert(short_number(1500) === '1.5k');
assert(short_number(-1500) === '-1.5k');
assert(short_number(1510) === '>1.5k');
assert(short_number(-1510) === '<-1.5k');

assert(short_number(1000000) === '1m');
assert(short_number(-1000000) === '-1m');
assert(short_number(1010000) === '>1m');
assert(short_number(-1010000) === '<-1m');

assert(short_number(1500000) === '1.5m');
assert(short_number(-1500000) === '-1.5m');
assert(short_number(1510000) === '>1.5m');
assert(short_number(-1510000) === '<-1.5m');

assert(short_number(1000000000) === '1b');
assert(short_number(-1000000000) === '-1b');
assert(short_number(1010000000) === '>1b');
assert(short_number(-1010000000) === '<-1b');

assert(short_number(1500000000) === '1.5b');
assert(short_number(-1500000000) === '-1.5b');
assert(short_number(1510000000) === '>1.5b');
assert(short_number(-1510000000) === '<-1.5b');

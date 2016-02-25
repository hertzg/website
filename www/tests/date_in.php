#!/usr/bin/php
<?php

include_once '../../lib/defaults.php';

include_once __DIR__.'/../fns/date_in.php';
assert(date_in(time()) === 'right now');
assert(date_in(time() + 60) === 'in a minute');
assert(date_in(time() + 60 * 2) === 'in 2 minutes');
assert(date_in(time() + 60 * 30) === 'in half an hour');
assert(date_in(time() + 60 * 59) === 'in 59 minutes');
assert(date_in(time() + 60 * 60) === 'in an hour');
assert(date_in(time() + 60 * 60 * 2) === 'in 2 hours');
assert(date_in(time() + 60 * 60 * 23) === 'in 23 hours');
assert(date_in(time() + 60 * 60 * 24) === 'tomorrow');
assert(date_in(time() + 60 * 60 * 24 * 2) === 'in 2 days');
assert(date_in(time() + 60 * 60 * 24 * 7) === 'in a week');
assert(date_in(time() + 60 * 60 * 24 * 14) === 'in 2 weeks');
assert(date_in(time() + 60 * 60 * 24 * 29) === 'in 4 weeks');
assert(date_in(time() + 60 * 60 * 24 * 30) === 'in a month');
assert(date_in(time() + 60 * 60 * 24 * 30 * 2) === 'in 2 months');
assert(date_in(time() + 60 * 60 * 24 * 30 * 11) === 'in 11 months');
assert(date_in(time() + 60 * 60 * 24 * 30 * 12) === 'in a year');
assert(date_in(time() + 60 * 60 * 24 * 30 * 12 * 2) === 'in 2 years');

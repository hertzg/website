#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../lib/defaults.php';
include_once '../fns/date_ago.php';
assert(date_ago(time()) === 'just now');
assert(date_ago(time() - 60) === 'a minute ago');
assert(date_ago(time() - 60 * 2) === '2 minutes ago');
assert(date_ago(time() - 60 * 30) === 'half an hour ago');
assert(date_ago(time() - 60 * 59) === '59 minutes ago');
assert(date_ago(time() - 60 * 60) === 'an hour ago');
assert(date_ago(time() - 60 * 60 * 2) === '2 hours ago');
assert(date_ago(time() - 60 * 60 * 23) === '23 hours ago');
assert(date_ago(time() - 60 * 60 * 24) === 'yesterday');
assert(date_ago(time() - 60 * 60 * 24 * 2) === '2 days ago');
assert(date_ago(time() - 60 * 60 * 24 * 7) === 'a week ago');
assert(date_ago(time() - 60 * 60 * 24 * 7 * 2) === '2 weeks ago');
assert(date_ago(time() - 60 * 60 * 24 * 29) === '4 weeks ago');
assert(date_ago(time() - 60 * 60 * 24 * 30) === 'a month ago');
assert(date_ago(time() - 60 * 60 * 24 * 30 * 2) === '2 months ago');
assert(date_ago(time() - 60 * 60 * 24 * 30 * 11) === '11 months ago');
assert(date_ago(time() - 60 * 60 * 24 * 30 * 12) === 'a year ago');
assert(date_ago(time() - 60 * 60 * 24 * 30 * 12 * 2) === '2 years ago');

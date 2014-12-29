#!/usr/bin/php
<?php

include_once __DIR__.'/../fns/date_ago.php';
assert(date_ago(time()) == 'just now');
assert(date_ago(time() - 60) == 'a minute ago');
assert(date_ago(time() - 60 * 2) == '2 minutes ago');
assert(date_ago(time() - 60 * 30) == 'half an hour ago');
assert(date_ago(time() - 60 * 59) == '59 minutes ago');
assert(date_ago(time() - 60 * 60) == 'an hour ago');
assert(date_ago(time() - 60 * 60 * 2) == '2 hours ago');
assert(date_ago(time() - 60 * 60 * 23) == '23 hours ago');
assert(date_ago(time() - 60 * 60 * 24) == 'yesterday');
assert(date_ago(time() - 60 * 60 * 24 * 2) == '2 days ago');
assert(date_ago(time() - 60 * 60 * 24 * 29) == '29 days ago');
assert(date_ago(time() - 60 * 60 * 24 * 30) == 'a month ago');
assert(date_ago(time() - 60 * 60 * 24 * 30 * 2) == '2 months ago');
assert(date_ago(time() - 60 * 60 * 24 * 30 * 11) == '11 months ago');
assert(date_ago(time() - 60 * 60 * 24 * 30 * 12) == 'a year ago');
assert(date_ago(time() - 60 * 60 * 24 * 30 * 12 * 2) == '2 years ago');

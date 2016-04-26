#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../lib/defaults.php';
include_once '../fns/ConnectionAddress/isValid.php';
assert(ConnectionAddress\isValid('http://localhost/') === true);
assert(ConnectionAddress\isValid('http://example.com/') === true);
assert(ConnectionAddress\isValid('http://example.com/sub/') === true);
assert(ConnectionAddress\isValid('http://subd.example.com/') === true);
assert(ConnectionAddress\isValid('https://sub.example.com/') === true);
assert(ConnectionAddress\isValid('https://example.com/') === true);
assert(ConnectionAddress\isValid('https://example.com/sub/') === true);
assert(ConnectionAddress\isValid('https://subd.example.com/') === true);
assert(ConnectionAddress\isValid('example.com') === false);
assert(ConnectionAddress\isValid('http://.localhost/') === false);
assert(ConnectionAddress\isValid('http://localhost./') === false);
assert(ConnectionAddress\isValid('http://localh..ost/') === false);
assert(ConnectionAddress\isValid('ftp://example.com/') === false);
assert(ConnectionAddress\isValid('http://example.com/?key=value') === false);
assert(ConnectionAddress\isValid('http://example.com/#fragment') === false);
assert(ConnectionAddress\isValid('http://example.com/sub') === false);

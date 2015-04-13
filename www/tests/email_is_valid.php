#!/usr/bin/php
<?php

include_once __DIR__.'/../fns/Email/isValid.php';
assert(Email\isValid('user@example.com'));
assert(Email\isValid('123@example.com'));
assert(Email\isValid('user.123@example.com'));
assert(Email\isValid('user-123@example.com'));
assert(Email\isValid('user_123@example.com'));
assert(!Email\isValid('user@localhost'));
assert(!Email\isValid('-user@example.com'));
assert(!Email\isValid('.user@example.com'));
assert(!Email\isValid('user-@example.com'));
assert(!Email\isValid('user.@example.com'));
assert(!Email\isValid('user..123@example.com'));

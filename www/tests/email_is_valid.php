#!/usr/bin/php
<?php

include_once '../../lib/defaults.php';

include_once __DIR__.'/../fns/Email/isValid.php';
assert(Email\isValid('user@example.com') === true);
assert(Email\isValid('123@example.com') === true);
assert(Email\isValid('user.123@example.com') === true);
assert(Email\isValid('user-123@example.com') === true);
assert(Email\isValid('user_123@example.com') === true);
assert(Email\isValid('user@localhost') === false);
assert(Email\isValid('-user@example.com') === false);
assert(Email\isValid('.user@example.com') === false);
assert(Email\isValid('user-@example.com') === false);
assert(Email\isValid('user.@example.com') === false);
assert(Email\isValid('user..123@example.com') === false);

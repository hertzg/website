#!/usr/bin/php
<?php

include_once '../../lib/defaults.php';

include_once __DIR__.'/../fns/DomainName/isValid.php';
assert(DomainName\isValid('localhost') === true);
assert(DomainName\isValid('example.com') === true);
assert(DomainName\isValid('sub.example.com') === true);
assert(DomainName\isValid('123.example.com') === true);
assert(DomainName\isValid('a-b.example.com') === true);
assert(DomainName\isValid('a--b.example.com') === true);
assert(DomainName\isValid('-b.example.com') === false);
assert(DomainName\isValid('b-.example.com') === false);
assert(DomainName\isValid('example..com') === false);
assert(DomainName\isValid('-example.com') === false);
assert(DomainName\isValid('.example.com') === false);
assert(DomainName\isValid('example.com-') === false);
assert(DomainName\isValid('example.com.') === false);

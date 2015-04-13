#!/usr/bin/php
<?php

include_once __DIR__.'/../fns/DomainName/isValid.php';
assert(DomainName\isValid('localhost'));
assert(DomainName\isValid('example.com'));
assert(DomainName\isValid('sub.example.com'));
assert(DomainName\isValid('123.example.com'));
assert(DomainName\isValid('a-b.example.com'));
assert(DomainName\isValid('a--b.example.com'));
assert(!DomainName\isValid('-b.example.com'));
assert(!DomainName\isValid('b-.example.com'));
assert(!DomainName\isValid('example..com'));
assert(!DomainName\isValid('-example.com'));
assert(!DomainName\isValid('.example.com'));
assert(!DomainName\isValid('example.com-'));
assert(!DomainName\isValid('example.com.'));

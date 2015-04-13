<?php

namespace DomainName;

function isValid ($domainName) {
    return preg_match('/^[a-z0-9.-]+$/', $domainName) &&
        !preg_match('/(^[.-]|\.\.|-\.|\.-|[.-]$)/', $domainName);
}

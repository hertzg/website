<?php

namespace UsernameAddress;

function maxLength () {
    include_once __DIR__.'/../ConnectionAddress/maxLength.php';
    include_once __DIR__.'/../Username/maxLength.php';
    return \Username\maxLength() + 1 + \ConnectionAddress\maxLength();
}

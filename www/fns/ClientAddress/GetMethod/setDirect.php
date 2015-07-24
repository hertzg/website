<?php

namespace ClientAddress\GetMethod;

function setDirect () {
    include_once __DIR__.'/set.php';
    set('direct', "    return \$_SERVER['REMOTE_ADDR'];\n");
}

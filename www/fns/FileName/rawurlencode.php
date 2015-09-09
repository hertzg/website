<?php

namespace FileName;

function rawurlencode ($name) {
    if ($name === '..') $name = '_.';
    else $name = str_replace('/', '_', $name);
    return \rawurlencode($name);
}

<?php

function base62_encode ($data) {
    $outstring = '';
    $len = strlen($data);
    for ($i = 0; $i < $len; $i += 8) {
        $chunk = substr($data, $i, 8);
        $outlen = ceil((strlen($chunk) * 8) / 6);
        $x = bin2hex($chunk);
        $w = gmp_strval(gmp_init(ltrim($x, '0'), 16), 62);
        $pad = str_pad($w, $outlen, '0', STR_PAD_LEFT);
        $outstring .= $pad;
    }
    return $outstring;
}

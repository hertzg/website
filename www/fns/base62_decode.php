<?php

function base62_decode ($data) {
    $outstring = '';
    $len = strlen($data);
    for ($i = 0; $i < $len; $i += 11) {
        $chunk = substr($data, $i, 11);
        $outlen = floor((strlen($chunk) * 6) / 8);
        $y = gmp_strval(gmp_init(ltrim($chunk, '0'), 62), 16);
        $pad = str_pad($y, $outlen * 2, '0', STR_PAD_LEFT);
        $outstring .= pack('H*', $pad);
    }
    return $outstring;
}

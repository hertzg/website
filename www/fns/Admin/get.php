<?php

namespace Admin;

function get (&$username, &$hash, &$salt, &$sha512_hash, &$sha512_key) {
    $username = 'adminadmin';
    $sha512_hash =
        "\xc7\xaf\x13\x1a\x79\x11\xe8\xba\x30\x0c\x80\x28\x17\x1c\x60\x6c"
        ."\x72\x85\x30\x14\x0f\x17\xa8\x06\xa3\x9c\x60\x60\x6b\x7d\x77\x81"
        ."\x89\xe8\xac\x07\xe9\x98\xc5\x2f\x8c\xb1\x7e\xf6\x2c\x92\x8c\x4f"
        ."\xe7\xc1\x40\xf7\xff\xd9\x07\xce\x3d\x4b\xe8\x15\xd2\xfb\xdf\xb1";
    $sha512_key =
        "\xc2\x77\x60\xd4\xe7\x27\x89\xb2\xa5\x3d\xdc\x2a\xed\xad\x12\x71"
        ."\x2b\x23\x95\x39\x05\xde\x68\xf5\xe4\x2d\x16\x85\x1c\x91\x08\xe3"
        ."\x9b\x5a\x78\x6e\x3b\x6c\x72\x59\x71\xc5\x35\x90\x3a\x55\xe0\x43"
        ."\xeb\x7e\x60\x60\x04\xb0\x4d\x69\xb0\xd3\x0e\x0b\x36\x70\xaa\xa7";
}

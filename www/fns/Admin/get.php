<?php

namespace Admin;

function get (&$username, &$hash, &$salt, &$sha512_hash, &$sha512_key) {
    $username = 'admin';
    $sha512_hash =
        "\x29\x8a\x60\xc0\xf5\x26\xa1\xae\xb1\xa3\x7b\x0f\x52\x05\xa8\xe3"
        ."\xb5\x61\x2e\x00\x86\x16\x55\x69\x9e\x97\xe7\x18\xbe\x98\xdb\xf7"
        ."\xc1\x5a\x32\xf0\xb1\xe9\x03\xcf\xe0\x14\xee\xe8\x17\x84\xc9\xa2"
        ."\xe3\xb6\x53\x05\xde\xcb\xd4\xe1\xf2\xf9\x07\x4e\xfb\x60\x8a\xb4";
    $sha512_key =
        "\xd3\xa8\x36\x43\xb0\xd4\x6b\x26\xf6\x79\x04\x94\x4a\x22\xa9\x19"
        ."\xe4\x05\xe9\x87\x71\x10\xf2\x3c\xe9\xfb\x29\xf2\xb6\x55\x16\xcf"
        ."\x4a\x31\xf6\xbb\x73\x9e\x84\xde\x3b\x64\x0b\xa7\xb3\x5d\x4c\xa7"
        ."\xf0\x13\x3d\x22\x58\x26\xc2\x56\xeb\x1e\x60\x9f\x18\x12\x69\x57";
}

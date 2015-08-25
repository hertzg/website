<?php

namespace Crypto;

function encryptedLength ($length) {
    return ceil(($length + 1) / 8) * 8;
}

<?php

function uniqmd5 ($raw_output = false) {
    return md5(uniqid(mt_rand(), true), $raw_output);
}

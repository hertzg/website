<?php

namespace Username;

function containsIllegalChars ($username) {
    return preg_match('/[^a-z0-9._-]/ui', $username);
}

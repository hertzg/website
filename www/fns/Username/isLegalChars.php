<?php

namespace Username;

function isLegalChars ($username) {
    return preg_match('/^[a-z0-9._-]+$/ui', $username);
}

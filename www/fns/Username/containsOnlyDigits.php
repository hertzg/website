<?php

namespace Username;

function containsOnlyDigits ($username) {
    return preg_match('/^\d+$/', $username);
}

<?php

namespace Password;

function hash ($password) {
    return md5($password, true);
}

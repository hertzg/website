<?php

namespace ErrorPage;

function internalServerError () {
    http_response_code(500);
    die('500 Internal Server Error');
}

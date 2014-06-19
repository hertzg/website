<?php

namespace Page;

function error404 () {
    http_response_code(404);
    die('404 Not Found');
}

<?php

include_once '../fns/require_not_installed.php';
require_not_installed();

include_once '../../lib/mysqli.php';

include_once '../fns/echo_html.php';
echo_html(
    'Installation Finished',
    '<h1>The installation has finished. Zvini is ready to use.</h1>'
);

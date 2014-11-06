<?php

include_once '../../fns/require_installed.php';
require_installed('../../');

include_once '../../lib/mysqli.php';

include_once '../fns/echo_html.php';
echo_html(
    'Installation Finished',
    '<h2 style="text-align: center">'
        .'The installation has finished. Zvini is ready to use.'
    .'</h2>'
    .'<div style="text-align: center; margin-top: 32px">'
        .'<a class="button" href="../..">Go to Zvini</a>'
    .'</div>'
);

<?php

include_once '../../fns/require_installed.php';
require_installed('../../');

include_once '../../lib/mysqli.php';

include_once '../fns/echo_html.php';
echo_html(
    'Installation Finished',
    '<h2 class="doneTitle">'
        .'The installation has finished. Zvini is ready to use.'
    .'</h2>'
    .'<div style="text-align: center; margin-top: 32px">'
        .'<a class="button" href="../.." style="margin: 0">Go to Zvini</a>'
    .'</div>'
);

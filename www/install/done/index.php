<?php

include_once '../../../lib/defaults.php';

include_once '../../fns/require_installed.php';
require_installed('../../');

include_once '../../lib/mysqli.php';

include_once '../../fns/get_absolute_base.php';
$absolute_base = htmlspecialchars(get_absolute_base().'admin/');

include_once '../fns/echo_html.php';
echo_html(
    'Installation Finished',
    '<h2 style="text-align: center">'
        .'The installation has finished.<br />Zvini is ready to be used.'
    .'</h2>'
    .'<div style="text-align: center; margin-top: 32px">'
        .'<a class="button" href="../.." style="width: 120px">Go to Zvini</a>'
    .'</div>'
    .'<div style="text-align: center; margin-top: 32px">'
        .'You can administrate this instance at:<br />'
        ."<a class=\"link\" href=\"$absolute_base\">$absolute_base</a>"
    .'</div>'
);

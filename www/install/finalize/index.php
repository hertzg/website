<?php

include_once '../fns/require_mysql_config.php';
list($generalInfoValues, $mysqlConfigValues, $mysqli) = require_mysql_config();

include_once '../fns/create_assert.php';

if ($mysqlConfigValues['create']) {
    $assertsHtml = create_assert(true, 'MySQL database has been created.');
} else {
    $assertsHtml = create_assert(true, 'MySQL database exists.');
}

include_once '../../fns/Table/ensureAll.php';
Table\ensureAll($mysqli);

$assertsHtml .=
    create_assert(true, 'Tables have been created.')
    .create_assert(true, 'Ready to finish the installation.');

include_once '../fns/echo_page.php';
include_once '../fns/wizard_layout.php';
echo_page(
    'Finalize Installation',
    wizard_layout(
        '<ul class="steps">'
            .'<li class="steps-done">'
                .'<code>&#x2713;</code> Requirements'
            .'</li>'
            .'<li class="steps-done">'
                .'<code>&#x2713;</code> General Information'
            .'</li>'
            .'<li class="steps-done">'
                .'<code>&#x2713;</code> MySQL Configuration'
            .'</li>'
            .'<li class="steps-active">'
                .'<code>&bull;</code> Finalize Installation'
            .'</li>'
        .'</ul>',
        '<h2>Finalize Installation</h2>'
        .$assertsHtml,
        '<a href="../mysql-config/" class="button" />Back</a>'
        .'<a href="submit.php" class="button" />Finish</a>'
    )
);

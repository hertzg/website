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

$doneSteps = ['Requirements', 'General Information', 'MySQL Configuration'];

include_once '../fns/echo_page.php';
include_once '../fns/steps.php';
include_once '../fns/wizard_layout.php';
echo_page(
    'Finalize Installation',
    wizard_layout(
        steps($doneSteps, 'Finalize Installation', []),
        '<span class="title-step">Final step</span>'
        .'<h2>Finalize Installation</h2>'
        .$assertsHtml,
        '<a href="../mysql-config/" class="button" />Back</a>'
        .'<a href="submit.php" class="button nextButton" />Finish</a>'
    )
);

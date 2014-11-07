<?php

include_once '../fns/require_admin.php';
$values = require_admin();
list($generalInfoValues, $mysqlConfigValues, $adminValues, $mysqli) = $values;

include_once '../fns/assert_success.php';
if ($mysqlConfigValues['create']) {
    $assertsHtml = assert_success('MySQL database has been created.');
} else {
    $assertsHtml = assert_success('MySQL database exists.');
}

include_once '../../fns/Table/ensureAll.php';
Table\ensureAll($mysqli);

$assertsHtml .=
    assert_success('Tables have been created.')
    .assert_success('Ready to finish the installation.');

$doneSteps = ['Agreement', 'Requirements',
    'General Information', 'MySQL Configuration', 'Administrator'];

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
        '<a href="../admin/" class="button" />Back</a>'
        .'<a href="submit.php" class="button nextButton" />Finish</a>'
    )
);

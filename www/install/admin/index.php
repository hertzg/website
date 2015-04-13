<?php

include_once '../fns/require_mysql_config.php';
require_mysql_config();

$key = 'install/admin/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else {
    $values = [
        'username' => 'adminadmin',
        'password1' => '',
        'password2' => '',
    ];
}

$key = 'install/admin/error';
if (array_key_exists($key, $_SESSION)) {
    $errorHtml =
        '<div class="error formError">'
            ."&times; {$_SESSION[$key]}"
        .'</div>';
} else {
    $errorHtml = '';
}

$doneSteps = [
    [
        'title' => 'Agreement',
        'href' => '../agreement/',
    ],
    [
        'title' => 'Requirements',
        'href' => '../requirements/',
    ],
    [
        'title' => 'General Information',
        'href' => '../general-info/',
    ],
    [
        'title' => 'MySQL Configuration',
        'href' => '../mysql-config/',
    ],
];

include_once '../fns/echo_page.php';
include_once '../fns/field_columns.php';
include_once '../fns/steps.php';
include_once '../fns/wizard_layout.php';
include_once '../../fns/example_password.php';
include_once '../../fns/Password/minLength.php';
include_once '../../fns/Username/minLength.php';
echo_page(
    'Step 5 - Administrator',
    '<form action="submit.php" method="post">'
        .wizard_layout(
            steps($doneSteps, 'Administrator', ['Finalize Installation']),
            '<span class="title-step">Step 5</span>'
            .'<h2>Administrator</h2>'
            .'<div style="margin-bottom: 8px">'
                .'<label for="usernameInput">Username:</label>'
                .'<br />'
                .'<input class="textfield" type="text" required="required"'
                .' name="username" id="usernameInput" autofocus="autofocus"'
                .' value="'.htmlspecialchars($values['username']).'" />'
                .'<div class="notes">'
                    .'<div class="notes-note">'
                        .'&bull; Characters a-z,'
                        .' A-Z, 0-9, dash, dot and underscore only.'
                    .'</div>'
                    .'<div class="notes-note">'
                        .'&bull; Minimum '.Username\minLength().' charactes.'
                    .'</div>'
                .'</div>'
            .'</div>'
            .field_columns(
                '<label for="password1Input">Password:</label>'
                .'<br />'
                .'<input class="textfield" type="password"'
                .' name="password1" id="password1Input" required="required"'
                .' value="'.htmlspecialchars($values['password1']).'" />'
                .'<br />'
                .'<div class="notes">'
                    .'<div class="notes-note">'
                        .'&bull; Minimum '.Password\minLength().' charactes.'
                    .'</div>'
                    .'<div class="notes-note">'
                        .'&bull; Example: '
                        .htmlspecialchars(example_password(15))
                    .'</div>'
                .'</div>',
                '<label for="password2Input">Repeat password:</label>'
                .'<br />'
                .'<input class="textfield" type="password"'
                .' name="password2" id="password2Input" required="required"'
                .' value="'.htmlspecialchars($values['password2']).'" />'
            )
            .$errorHtml,
            '<input type="submit" class="button nextButton" value="Next" />'
            .'<a href="../mysql-config/" class="button">Back</a>'
        )
    .'</form>'
);

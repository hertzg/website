<?php

include_once '../../../lib/defaults.php';

include_once '../fns/require_mysql_config.php';
require_mysql_config();

include_once 'fns/get_values.php';
$values = get_values();

$username = $values['username'];
$password = $values['password'];
$repeatPassword = $values['repeatPassword'];

if ($values['check']) {

    include_once '../fns/check_admin.php';
    $error = check_admin($username, $password, $repeatPassword, $focus);
    if ($focus === null) $focus = 'username';

    if ($error === null) $errorHtml = '';
    else $errorHtml = "<div class=\"error formError\">&times; $error</div>";

} else {
    $focus = 'username';
    $errorHtml = '';
}

include_once 'fns/create_steps.php';
include_once '../fns/echo_page.php';
include_once '../fns/field_columns.php';
include_once '../fns/steps.php';
include_once '../fns/wizard_layout.php';
include_once '../../fns/example_password.php';
include_once '../../fns/Password/minLength.php';
include_once '../../fns/Username/maxLength.php';
include_once '../../fns/Username/minLength.php';
echo_page(
    'Step 5 - Emergency User',
    '<form action="submit.php" method="post">'
        .wizard_layout(
            create_steps(),
            '<span class="title-step">Step 5</span>'
            .'<h2>Emergency User</h2>'
            .'<div style="margin-bottom: 12px">'
                .'The emergency user will let you administer'
                .' this Zvini instance even when it\'s experiencing a'
                .' misconfiguration or its MySQL server is down.'
            .'</div>'
            .'<div style="margin-bottom: 8px">'
                .'<label for="usernameInput">Username:</label>'
                .'<br />'
                .'<input class="textfield" type="text" required="required"'
                .' name="username" id="usernameInput"'
                .' maxlength="'.Username\maxLength().'"'
                .' value="'.htmlspecialchars($username).'"'
                .($focus == 'username' ? ' autofocus="autofocus"' : '').' />'
                .'<div class="notes">'
                    .'<div class="notes-note">'
                        .'&bull; Case-sensitive.'
                    .'</div>'
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
                '<label for="passwordInput">Password:</label>'
                .'<br />'
                .'<input class="textfield" type="password"'
                .' name="password" id="passwordInput" required="required"'
                .' value="'.htmlspecialchars($password).'"'
                .($focus == 'password' ? ' autofocus="autofocus"' : '').' />'
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
                '<label for="repeatPasswordInput">Repeat password:</label>'
                .'<br />'
                .'<input class="textfield"'
                .($focus == 'repeatPassword' ? ' autofocus="autofocus"' : '')
                .' type="password" name="repeatPassword"'
                .' id="repeatPasswordInput" required="required"'
                .' value="'.htmlspecialchars($repeatPassword).'" />'
            )
            .$errorHtml,
            '<input type="submit" class="button nextButton" value="Next" />'
            .'<a href="../mysql-settings/" class="button">Back</a>'
        )
    .'</form>'
);

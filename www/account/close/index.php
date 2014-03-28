<?php

$base = '../../';

include_once '../../fns/require_user.php';
$user = require_user($base);

unset($_SESSION['account/messages']);

include_once '../../fns/create_tabs.php';
include_once '../../fns/Form/button.php';
include_once '../../fns/Form/password.php';
include_once '../../fns/Page/sessionErrors.php';
include_once '../../fns/Page/warnings.php';
$content = create_tabs(
        array(
            array(
                'title' => '&middot;&middot;&middot;',
                'href' => '../../home/',
            ),
            array(
                'title' => 'Account',
                'href' => '..',
            ),
        ),
        'Close',
        Page\sessionErrors('account/close/errors')
        .Page\warnings(array(
            'Are you sure you want to close your account?',
            ' You will lose all your data.',
        ))
        .'<form action="submit.php" method="post">'
            .Form\password('password', 'Password', array(
                'autofocus' => true,
                'required' => true,
            ))
            .'<div class="hr"></div>'
            .Form\button('Close Account')
        .'</form>'
    );

include_once '../../fns/echo_page.php';
echo_page($user, 'Close Account', $content, $base);

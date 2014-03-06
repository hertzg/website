<?php

include_once '../../fns/require_user.php';
require_user('../../');

include_once '../../lib/page.php';

include_once '../../fns/Page/sessionErrors.php';
$pageErrors = Page\sessionErrors('account/verify-email/index_errors');

unset($_SESSION['account/index_messages']);

include_once '../../fns/create_tabs.php';
include_once '../../classes/Form.php';

$page->base = '../../';
$page->title = 'Verify Email';
$page->finish(
    create_tabs(
        array(
            array(
                'title' => ' &middot;&middot;&middot; ',
                'href' => '../../',
            ),
            array(
                'title' => 'Account',
                'href' => '../',
            ),
        ),
        'Verify Email',
        $pageErrors
        .Form::create(
            'submit.php',
            Form::captcha('../../', true)
            .Form::button('Send Verification Email')
        )
    )
);

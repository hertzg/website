<?php

include_once '../../fns/require_admin.php';
$admin_user = require_admin();

include_once 'fns/get_values.php';
$values = get_values();

$fnsDir = '../../../fns';
$focus = $values['focus'];

unset(
    $_SESSION['admin/users/errors'],
    $_SESSION['admin/users/messages'],
    $_SESSION['admin/users/view/messages']
);

include_once '../fns/create_profile_form_items.php';
include_once "$fnsDir/example_password.php";
include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/Form/notes.php";
include_once "$fnsDir/Form/password.php";
include_once "$fnsDir/Form/textfield.php";
include_once "$fnsDir/ItemList/listHref.php";
include_once "$fnsDir/ItemList/pageHiddenInputs.php";
include_once "$fnsDir/Page/create.php";
include_once "$fnsDir/Page/sessionErrors.php";
include_once "$fnsDir/Password/minLength.php";
include_once "$fnsDir/Username/maxLength.php";
include_once "$fnsDir/Username/minLength.php";
$content = Page\create(
    [
        'title' => 'Users',
        'href' => ItemList\listHref(),
    ],
    'New User',
    Page\sessionErrors('admin/users/new/errors')
    .'<form action="submit.php" method="post">'
        .Form\textfield('username', 'Username', [
            'value' => $values['username'],
            'maxlength' => Username\maxLength(),
            'required' => true,
            'autofocus' => $focus === 'username',
        ])
        .Form\notes([
            'Case-sensitive.',
            'Characters a-z, A-Z, 0-9, dash, dot and underscore only.',
            'Minimum '.Username\minLength().' characters.',
        ])
        .'<div class="hr"></div>'
        .Form\password('password', 'Password', [
            'value' => $values['password'],
            'required' => true,
            'autofocus' => $focus === 'password',
        ])
        .Form\notes([
            'Minimum '.Password\minLength().' characters.',
            'Example: '.htmlspecialchars(example_password(9)),
        ])
        .'<div class="hr"></div>'
        .Form\password('repeatPassword', 'Repeat password', [
            'value' => $values['repeatPassword'],
            'required' => true,
            'autofocus' => $focus === 'repeatPassword',
        ])
        .'<div class="hr"></div>'
        .create_profile_form_items($values, $scripts)
        .'<div class="hr"></div>'
        .Form\button('Save User')
        .ItemList\pageHiddenInputs()
    .'</form>'
);

include_once '../../fns/echo_admin_page.php';
echo_admin_page($admin_user, 'New User',
    $content, '../../', ['scripts' => $scripts]);

<?php

include_once '../../fns/require_admin.php';
require_admin();

$fnsDir = '../../../fns';

unset($_SESSION['admin/invitations/messages']);

include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/Form/notes.php";
include_once "$fnsDir/Form/textfield.php";
include_once "$fnsDir/Invitations/maxLengths.php";
include_once "$fnsDir/Page/tabs.php";
$content = Page\tabs(
    [
        [
            'title' => 'Invitations',
            'href' => '..',
        ],
    ],
    'New Invitation',
    '<form action="submit.php" method="post">'
        .Form\textfield('note', 'Note', [
            'maxlength' => Invitations\maxLengths()['note'],
            'autofocus' => true,
        ])
        .Form\notes(['Optional.'])
        .'<div class="hr"></div>'
        .Form\button('Save Invitation')
    .'</form>'
);

include_once "$fnsDir/echo_guest_page.php";
echo_guest_page('New Invitation', $content, '../../../');

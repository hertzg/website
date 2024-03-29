<?php

function create_view_page ($invitation, &$scripts) {

    $id = $invitation->id;
    $key = $invitation->key;
    $base = '../../../';
    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/compressed_js_script.php";
    $scripts = compressed_js_script('dateAgo', $base)
        .compressed_js_script('flexTextarea', $base);

    unset(
        $_SESSION['admin/invitations/errors'],
        $_SESSION['admin/invitations/messages']
    );

    include_once "$fnsDir/get_absolute_base.php";
    $signUpLink = get_absolute_base()."accept-invitation/?key=$key";

    include_once "$fnsDir/Form/label.php";
    include_once "$fnsDir/Form/notes.php";
    include_once "$fnsDir/Form/textarea.php";
    $items = [
        Form\label('Identifier', $key),
        Form\textarea('link', 'Sign up link', [
            'value' => $signUpLink,
            'readonly' => true,
        ])
        .Form\notes([
            'Send the link to the person you want to create an account.',
        ])
    ];

    $note = $invitation->note;
    if ($note !== '') {
        $items[] = Form\label('Note', htmlspecialchars($invitation->note));
    }

    include_once __DIR__.'/../../fns/format_author.php';
    $author = format_author($invitation->insert_time,
        $invitation->insert_api_key_name);
    $infoText = "Invitation created $author.";
    if ($invitation->revision) {
        $author = format_author($invitation->update_time,
            $invitation->update_api_key_name);
        $infoText .= "<br />Last modified $author.";
    }

    include_once "$fnsDir/Page/panel.php";
    include_once "$fnsDir/Page/create.php";
    include_once "$fnsDir/Page/imageArrowLink.php";
    include_once "$fnsDir/Page/imageLink.php";
    include_once "$fnsDir/Page/infoText.php";
    include_once "$fnsDir/Page/newItemButton.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    include_once "$fnsDir/Page/staticTwoColumns.php";
    return
        Page\create(
            [
                'title' => 'Invitations',
                'href' => "../#$id",
            ],
            "Invitation #$id",
            Page\sessionMessages('admin/invitations/view/messages')
            .join('<div class="hr"></div>', $items)
            .Page\infoText($infoText),
            Page\newItemButton('../new/', 'Invitation')
        )
        .Page\panel(
            'Invitation Options',
            Page\staticTwoColumns(
                Page\imageArrowLink('Edit', "../edit/?id=$id",
                    'edit-invitation', ['id' => 'edit']),
                Page\imageLink('Delete', "../delete/?id=$id",
                    'trash-bin', ['id' => 'delete'])
            )
        );

}

<?php

function create_view_page ($invitation, &$scripts) {

    $id = $invitation->id;
    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/compressed_js_script.php";
    $scripts = compressed_js_script('dateAgo', '../../../');

    unset(
        $_SESSION['admin/invitations/errors'],
        $_SESSION['admin/invitations/messages']
    );

    include_once "$fnsDir/DomainName/get.php";
    include_once "$fnsDir/SiteBase/get.php";
    include_once "$fnsDir/SiteProtocol/get.php";
    $signUpLink = SiteProtocol\get().'://'.DomainName\get().SiteBase\get()
        ."accept-invitation/?id=$id&key=".bin2hex($invitation->key);

    include_once "$fnsDir/Form/notes.php";
    include_once "$fnsDir/Form/textfield.php";
    $items = [
        Form\textfield('link', 'Link to sign up', [
            'value' => $signUpLink,
            'readonly' => true,
        ])
        .Form\notes(['Send the link to the person you want to sign up.'])
    ];

    $note = $invitation->note;
    if ($note !== '') {
        include_once "$fnsDir/Form/label.php";
        $items[] = Form\label('Note', htmlspecialchars($invitation->note));
    }

    include_once "$fnsDir/export_date_ago.php";
    $infoText = 'Invitation created '
        .export_date_ago($invitation->insert_time).'.';
    if ($invitation->revision) {
        $infoText .= '<br />Last modified '
            .export_date_ago($invitation->update_time).'.';
    }

    include_once "$fnsDir/create_panel.php";
    include_once "$fnsDir/Page/imageLink.php";
    include_once "$fnsDir/Page/infoText.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    include_once "$fnsDir/Page/staticTwoColumns.php";
    include_once "$fnsDir/Page/tabs.php";
    return
        Page\tabs(
            [
                [
                    'title' => 'Invitations',
                    'href' => "../#$id",
                ],
            ],
            "Invitation #$id",
            Page\sessionMessages('admin/invitations/view/messages')
            .join('<div class="hr"></div>', $items)
            .Page\infoText($infoText)
        )
        .create_panel(
            'Invitation Options',
            Page\staticTwoColumns(
                Page\imageLink('Edit',
                    "../edit/?id=$id", 'TODO', ['id' => 'edit']),
                '<div id="deleteLink">'
                    .Page\imageLink('Delete', "../delete/?id=$id", 'trash-bin')
                .'</div>'
            )
        );

}

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

    include_once "$fnsDir/Form/textfield.php";
    $items = [
        Form\textfield('link', 'Link to sign up', [
            'value' => $signUpLink,
            'readonly' => true,
        ])
    ];

    $note = $invitation->note;
    if ($note !== '') {
        include_once "$fnsDir/Form/label.php";
        $items[] = Form\label('Note', htmlspecialchars($invitation->note));
    }

    include_once "$fnsDir/create_panel.php";
    include_once "$fnsDir/export_date_ago.php";
    include_once "$fnsDir/Page/imageLink.php";
    include_once "$fnsDir/Page/infoText.php";
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
            join('<div class="hr"></div>', $items)
            .Page\infoText('Invitation created '
                .export_date_ago($invitation->insert_time).'.')
        )
        .create_panel(
            'Invitation Options',
            '<div id="deleteLink">'
                .Page\imageLink('Delete', "../delete/?id=$id", 'trash-bin')
            .'</div>'
        );

}

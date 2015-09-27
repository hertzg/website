<?php

function create_view_page ($connection, &$scripts) {

    $id = $connection->id;
    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/compressed_js_script.php";
    $scripts = compressed_js_script('dateAgo', '../../../');

    include_once "$fnsDir/export_date_ago.php";
    $infoText = 'Connection created '
        .export_date_ago($connection->insert_time).'.';
    if ($connection->revision) {
        $infoText .= '<br />Last modified '
            .export_date_ago($connection->update_time).'.';
    }

    include_once "$fnsDir/Page/imageArrowLink.php";
    $editLink = Page\imageArrowLink('Edit',
        "../edit/?id=$id", 'edit-connection', ['id' => 'edit']);

    include_once "$fnsDir/Page/imageLink.php";
    $deleteLink =
        '<div id="deleteLink">'
            .Page\imageLink('Delete', "../delete/?id=$id", 'trash-bin')
        .'</div>';

    include_once __DIR__.'/../fns/format_permissions.php';
    $permissions = format_permissions($connection->can_send_bookmark,
        $connection->can_send_channel, $connection->can_send_contact,
        $connection->can_send_file, $connection->can_send_note,
        $connection->can_send_place, $connection->can_send_task);

    include_once "$fnsDir/Page/staticTwoColumns.php";
    $optionsContent = Page\staticTwoColumns($editLink, $deleteLink);

    include_once __DIR__.'/../../fns/create_expires_label.php';
    $expiresLabel = create_expires_label(
        $connection->expire_time, $dateAgoScript);

    unset(
        $_SESSION['account/connections/edit/errors'],
        $_SESSION['account/connections/edit/values'],
        $_SESSION['account/connections/errors'],
        $_SESSION['account/connections/messages'],
        $_SESSION['account/connections/new/errors'],
        $_SESSION['account/connections/new/values']
    );

    include_once "$fnsDir/create_panel.php";
    include_once "$fnsDir/Form/label.php";
    include_once "$fnsDir/Page/infoText.php";
    include_once "$fnsDir/Page/newItemButton.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    include_once "$fnsDir/Page/tabs.php";
    return Page\tabs(
        [
            [
                'title' => 'Connections',
                'href' => "../#$id",
            ],
        ],
        "Connection #$id",
        Page\sessionMessages('account/connections/view/messages')
        .Form\label('Username', htmlspecialchars($connection->username))
        .'<div class="hr"></div>'
        .$expiresLabel
        .'<div class="hr"></div>'
        .Form\label('This user', $permissions)
        .Page\infoText($infoText)
        .create_panel('Conneciton Options', $optionsContent),
        Page\newItemButton('../new/', 'Connection')
    );

}

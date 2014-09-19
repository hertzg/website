<?php

function create_view_page ($connection) {

    $id = $connection->id;
    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/Page/imageArrowLink.php";
    $href = "../edit/?id=$id";
    $editLink = Page\imageArrowLink('Edit', $href, 'edit-connection');

    $href = "../delete/?id=$id";
    $deleteLink = Page\imageArrowLink('Delete', $href, 'trash-bin');
    $deleteLink = "<div id=\"deleteLink\">$deleteLink</div>";

    include_once '../fns/format_permissions.php';
    $permissions = format_permissions($connection->can_send_bookmark,
        $connection->can_send_channel, $connection->can_send_contact,
        $connection->can_send_file, $connection->can_send_note,
        $connection->can_send_task);

    include_once "$fnsDir/Page/staticTwoColumns.php";
    $optionsContent = Page\staticTwoColumns($editLink, $deleteLink);

    include_once "$fnsDir/create_panel.php";
    include_once "$fnsDir/Form/label.php";
    include_once "$fnsDir/Page/newItemButton.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    include_once "$fnsDir/Page/tabs.php";
    return Page\tabs(
        [
            [
                'title' => 'Connections',
                'href' => '..',
            ],
        ],
        "Connection #$id",
        Page\sessionMessages('account/connections/view/messages')
        .Form\label('Username', htmlspecialchars($connection->username))
        .'<div class="hr"></div>'
        .Form\label('This user', $permissions)
        .create_panel('Conneciton Options', $optionsContent),
        Page\newItemButton('../new/', 'Connection')
    );

}

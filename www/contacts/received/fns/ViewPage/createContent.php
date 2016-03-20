<?php

namespace ViewPage;

function createContent ($receivedContact, $infoText, $items, &$scripts) {

    $id = $receivedContact->id;
    $fnsDir = __DIR__.'/../../../../fns';

    $photo_id = $receivedContact->photo_id;
    if ($photo_id) $photoSrc = "../download-photo/?id=$id";
    else $photoSrc = '../../../images/empty-photo.svg';

    $contactContent = join('<div class="hr"></div>', $items);

    include_once "$fnsDir/create_contact_panel.php";
    $contactPanel = create_contact_panel($photoSrc,
        $contactContent, '../../../', $scripts);

    include_once __DIR__.'/optionsPanel.php';
    include_once "$fnsDir/Page/panel.php";
    include_once "$fnsDir/create_received_from_item.php";
    include_once "$fnsDir/ItemList/Received/listHref.php";
    include_once "$fnsDir/Page/create.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    return
        \Page\create(
            [
                'title' => 'Contacts',
                'href' => \ItemList\Received\listHref('../')."#$id",
            ],
            "Received Contact #$id",
            \Page\sessionMessages('contacts/received/view/messages')
            .create_received_from_item($receivedContact)
        )
        .\Page\panel('The Contact', $contactPanel.$infoText)
        .optionsPanel($receivedContact);

}

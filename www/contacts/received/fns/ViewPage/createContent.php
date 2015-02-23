<?php

namespace ViewPage;

function createContent ($receivedContact, $infoText, $items) {

    $id = $receivedContact->id;
    $fnsDir = __DIR__.'/../../../../fns';

    $photo_id = $receivedContact->photo_id;
    if ($photo_id) $photoSrc = "../download-photo/?id=$id";
    else $photoSrc = '../../../images/empty-photo.svg';

    $contactContent = join('<div class="hr"></div>', $items);

    include_once "$fnsDir/create_contact_panel.php";
    $contactPanel = create_contact_panel(
        $photoSrc, $contactContent, '../../../');

    include_once __DIR__.'/optionsPanel.php';
    include_once "$fnsDir/create_panel.php";
    include_once "$fnsDir/ItemList/Received/listHref.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    include_once "$fnsDir/Page/tabs.php";
    return \Page\tabs(
        [
            [
                'title' => 'Received',
                'href' => '../'.\ItemList\Received\listHref()."#$id",
            ],
        ],
        "Received Contact #$id",
        \Page\sessionMessages('contacts/received/view/messages')
        .\Form\label('Received from',
            htmlspecialchars($receivedContact->sender_username))
        .create_panel('The Contact', $contactPanel)
        .$infoText
        .optionsPanel($receivedContact)
    );

}

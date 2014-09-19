<?php

namespace ViewPage;

function createContent ($contact, $infoText, $items) {

    $photo_id = $contact->photo_id;
    if ($photo_id) {
        $query = "?id=$contact->id_contacts&photo_id=$photo_id";
        $photoSrc = "../photo/download/$query";
    } else {
        $photoSrc = '../../images/empty-photo.svg';
    }

    $fnsDir = __DIR__.'/../../../fns';

    $content = join('<div class="hr"></div>', $items);

    include_once __DIR__.'/optionsPanel.php';
    include_once __DIR__.'/photoOptionsPanel.php';
    include_once "$fnsDir/create_contact_panel.php";
    include_once "$fnsDir/create_new_item_button.php";
    include_once "$fnsDir/ItemList/listHref.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    include_once "$fnsDir/Page/tabs.php";
    return
        \Page\tabs(
            [
                [
                    'title' => 'Contacts',
                    'href' => \ItemList\listHref(),
                ],
            ],
            "Contact #$contact->id_contacts",
            \Page\sessionMessages('contacts/view/messages')
            .create_contact_panel($photoSrc, $content)
            .$infoText,
            create_new_item_button('Contact', '../')
        )
        .optionsPanel($contact)
        .photoOptionsPanel($contact);

}

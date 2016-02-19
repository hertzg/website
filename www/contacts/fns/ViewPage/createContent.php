<?php

namespace ViewPage;

function createContent ($contact, $infoText, $items, $base, &$scripts) {

    $id = $contact->id;
    $fnsDir = __DIR__.'/../../../fns';

    $photo_id = $contact->photo_id;
    if ($photo_id) {
        $query = "?id=$id&photo_id=$photo_id";
        $photoSrc = "$base../photo/download/$query";
    } else {
        $photoSrc = "$base../../images/empty-photo.svg";
    }

    $content = join('<div class="hr"></div>', $items);

    include_once __DIR__.'/optionsPanel.php';
    include_once __DIR__.'/photoOptionsPanel.php';
    include_once "$fnsDir/create_contact_panel.php";
    include_once "$fnsDir/create_new_item_button.php";
    include_once "$fnsDir/ItemList/listHref.php";
    include_once "$fnsDir/Page/create.php";
    include_once "$fnsDir/Page/infoText.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    return
        \Page\create(
            [
                'title' => 'Contacts',
                'href' => $base.\ItemList\listHref()."#$id",
            ],
            "Contact #$id",
            \Page\sessionMessages('contacts/view/messages')
            .create_contact_panel($photoSrc, $content, "$base../../", $scripts)
            .\Page\infoText($infoText),
            create_new_item_button('Contact', "$base../")
        )
        .photoOptionsPanel($contact, $base)
        .optionsPanel($contact, $base);

}

<?php

function create_content ($contact, $infoText, $items) {
    include_once __DIR__.'/../fns/create_options_panel.php';
    include_once __DIR__.'/../fns/create_photo_options_panel.php';
    include_once __DIR__.'/../../../fns/create_contact_panel.php';
    include_once __DIR__.'/../../../fns/ItemList/listHref.php';
    include_once __DIR__.'/../../../fns/Page/tabs.php';
    include_once __DIR__.'/../../../fns/Page/sessionMessages.php';
    return
        Page\tabs(
            [
                [
                    'title' => '&middot;&middot;&middot;',
                    'href' => '../../home/',
                ],
                [
                    'title' => 'Contacts',
                    'href' => ItemList\listHref(),
                ],
            ],
            "Contact #$contact->id_contacts",
            Page\sessionMessages('contacts/view/messages')
            .create_contact_panel('', join('<div class="hr"></div>', $items))
            .$infoText
        )
        .create_options_panel($contact)
        .create_photo_options_panel($contact);
}

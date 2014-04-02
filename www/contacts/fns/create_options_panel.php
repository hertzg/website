<?php

function create_options_panel ($user, $base = '') {

    include_once __DIR__.'/../../fns/Page/imageArrowLink.php';

    $title = 'New Contact';
    $href = "{$base}new/";
    $options = [Page\imageArrowLink($title, $href, 'create-contact')];

    $num_received_contacts = $user->num_received_contacts;
    if ($num_received_contacts) {
        include_once __DIR__.'/../../fns/Page/imageArrowLinkWithDescription.php';
        $title = 'Received Contacts';
        $description = "$num_received_contacts total.";
        $href = "{$base}received/";
        $options[] = Page\imageArrowLinkWithDescription($title,
            $description, $href, 'receive');
    }

    if ($user->num_contacts) {
        $title = 'Delete All Contacts';
        $href = "{$base}delete-all/";
        $options[] = Page\imageArrowLink($title, $href, 'trash-bin');
    }

    include_once __DIR__.'/../../fns/create_panel.php';
    return create_panel('Options', join('<div class="hr"></div>', $options));

}

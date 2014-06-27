<?php

function create_options_panel ($user, $base = '') {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/ItemList/escapedPageQuery.php";
    $escapedPageQuery = ItemList\escapedPageQuery();

    include_once "$fnsDir/Page/imageArrowLink.php";
    $title = 'New Contact';
    $href = "{$base}new/$escapedPageQuery";
    $options = [Page\imageArrowLink($title, $href, 'create-contact')];

    $num_received_contacts = $user->num_received_contacts;
    if ($num_received_contacts) {
        include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
        $title = 'Received Contacts';
        $description = "$num_received_contacts total.";
        $href = "{$base}received/";
        $options[] = Page\imageArrowLinkWithDescription($title,
            $description, $href, 'receive');
    }

    if ($user->num_contacts) {
        $title = 'Delete All Contacts';
        $href = "{$base}delete-all/$escapedPageQuery";
        $options[] = Page\imageArrowLink($title, $href, 'trash-bin');
    }

    include_once "$fnsDir/create_panel.php";
    return create_panel('Options', join('<div class="hr"></div>', $options));

}

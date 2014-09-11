<?php

function create_photo_options_panel ($contact) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/ItemList/escapedItemQuery.php";
    $escapedItemQuery = ItemList\escapedItemQuery($contact->id_contacts);

    include_once "$fnsDir/Page/imageArrowLink.php";
    $href = "../photo/edit/$escapedItemQuery";
    $editLink = Page\imageArrowLink('Edit', $href, 'TODO');

    if ($contact->photo_id) {

        $href = "../photo/delete/$escapedItemQuery";
        $deleteLink = Page\imageArrowLink('Delete', $href, 'TODO');

        include_once "$fnsDir/Page/staticTwoColumns.php";
        $content = Page\staticTwoColumns($editLink, $deleteLink);

    } else {
        $content = $editLink;
    }

    include_once "$fnsDir/create_panel.php";
    return create_panel('Photo Options', $content);

}

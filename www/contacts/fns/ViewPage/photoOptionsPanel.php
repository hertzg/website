<?php

namespace ViewPage;

function photoOptionsPanel ($contact, $base) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/ItemList/escapedItemQuery.php";
    $escapedItemQuery = \ItemList\escapedItemQuery($contact->id_contacts);

    include_once "$fnsDir/Page/imageArrowLink.php";
    $href = "$base../photo/edit/$escapedItemQuery";
    $editLink = \Page\imageArrowLink('Edit Photo', $href, 'edit-contact-photo');

    if ($contact->photo_id) {

        include_once "$fnsDir/Page/imageLink.php";
        $href = "$base../photo/delete/$escapedItemQuery";
        $deleteLink =
            '<div id="deletePhotoLink">'
                .\Page\imageLink('Delete Photo', $href, 'clear-contact-photo')
            .'</div>';

        include_once "$fnsDir/Page/staticTwoColumns.php";
        $content = \Page\staticTwoColumns($editLink, $deleteLink);

    } else {
        $content = $editLink;
    }

    include_once "$fnsDir/create_panel.php";
    return create_panel('Photo Options', $content);

}

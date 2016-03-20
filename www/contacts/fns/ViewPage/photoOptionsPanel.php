<?php

namespace ViewPage;

function photoOptionsPanel ($contact, $base) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/ItemList/escapedItemQuery.php";
    $escapedItemQuery = \ItemList\escapedItemQuery($contact->id);

    include_once "$fnsDir/Page/imageArrowLink.php";
    $editLink = \Page\imageArrowLink('Edit Photo',
        "$base../photo/edit/$escapedItemQuery", 'edit-contact-photo',
        ['id' => 'edit-photo']);

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

    include_once "$fnsDir/Page/panel.php";
    return \Page\panel('Photo Options', $content);

}

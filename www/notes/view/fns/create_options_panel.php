<?php

function create_options_panel ($id) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/ItemList/escapedItemQuery.php";
    $escapedItemQuery = ItemList\escapedItemQuery($id);

    include_once "$fnsDir/Page/imageArrowLink.php";

    $href = "../edit/$escapedItemQuery";
    $editLink = Page\imageArrowLink('Edit', $href, 'edit-note');

    $href = "../send/$escapedItemQuery";
    $sendLink = Page\imageArrowLink('Send', $href, 'send');

    $href = "../delete/$escapedItemQuery";
    $deleteLink = Page\imageArrowLink('Delete', $href, 'trash-bin');

    include_once "$fnsDir/Page/staticTwoColumns.php";
    $content =
        Page\staticTwoColumns($editLink, $sendLink)
        .'<div class="hr"></div>'
        .$deleteLink;

    include_once "$fnsDir/create_panel.php";
    return create_panel('Note Options', $content);

}

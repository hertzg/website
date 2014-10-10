<?php

namespace ViewPage;

function optionsPanel ($id) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/ItemList/escapedItemQuery.php";
    $escapedItemQuery = \ItemList\escapedItemQuery($id);

    include_once "$fnsDir/Page/imageArrowLink.php";
    $href = "../edit/$escapedItemQuery";
    $editLink = \Page\imageArrowLink('Edit', $href, 'edit-note');

    $href = "../send/$escapedItemQuery";
    $sendLink = \Page\imageArrowLink('Send', $href, 'send');

    include_once "$fnsDir/Page/imageLink.php";
    $href = "../delete/$escapedItemQuery";
    $deleteLink = \Page\imageLink('Delete', $href, 'trash-bin');

    include_once "$fnsDir/Page/staticTwoColumns.php";
    $content =
        \Page\staticTwoColumns($editLink, $sendLink)
        .'<div class="hr"></div>'
        ."<div id=\"deleteLink\">$deleteLink<div>";

    include_once "$fnsDir/create_panel.php";
    return create_panel('Note Options', $content);

}

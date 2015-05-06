<?php

namespace ViewPage;

function optionsPanel ($id, $user) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/Page/imageArrowLink.php";
    $editLink = \Page\imageArrowLink('Edit',
        "../edit/?id=$id", 'edit-bar-chart', ['id' => 'edit']);

    $deleteLink =
        '<div id="deleteLink">'
            .\Page\imageArrowLink('Delete', "../delete/?id=$id", 'trash-bin')
        .'</div>';

    include_once "$fnsDir/Page/staticTwoColumns.php";
    $content = \Page\staticTwoColumns($editLink, $deleteLink);

    include_once "$fnsDir/create_panel.php";
    return create_panel('Bar Chart Options', $content);

}

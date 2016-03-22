<?php

function create_mysql_link ($mysqli) {

    $fnsDir = __DIR__.'/../../fns';

    $title = 'MySQL Settings';
    $href = 'mysql-settings/';
    $icon = 'generic';
    $options = ['id' => 'mysql-settings'];
    if ($mysqli->connect_errno) {

        $description =
            '<span class="colorText red">'
                ."Doesn't work. ".htmlspecialchars($mysqli->connect_error)
            .'</span>';

        include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
        return Page\imageArrowLinkWithDescription(
            $title, $description, $href, $icon, $options);

    }

    include_once "$fnsDir/Page/imageArrowLink.php";
    return Page\imageArrowLink($title, $href, $icon, $options);

}

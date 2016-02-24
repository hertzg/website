<?php

function create_tokens_link ($user) {

    $fnsDir = __DIR__.'/../../fns';
    $title = 'Remembered Sessions';
    $href = 'tokens/';
    $icon = 'tokens';
    $options = ['id' => 'tokens'];

    $num_tokens = $user->num_tokens;
    if ($num_tokens) {
        include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
        return Page\imageArrowLinkWithDescription($title,
            "$num_tokens total.", $href, $icon, $options);
    }

    include_once "$fnsDir/Page/imageArrowLink.php";
    return Page\imageArrowLink($title, $href, $icon, $options);

}

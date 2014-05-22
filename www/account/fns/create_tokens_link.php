<?php

function create_tokens_link ($user) {

    $fnsPageDir = __DIR__.'/../../fns/Page';

    $title = 'Remembered Sessions';
    $href = '../tokens/';
    $icon = 'tokens';

    $num_tokens = $user->num_tokens;
    if ($num_tokens) {
        $description = "$num_tokens total.";
        include_once "$fnsPageDir/imageArrowLinkWithDescription.php";
        return Page\imageArrowLinkWithDescription($title,
            $description, $href, $icon);
    }

    include_once "$fnsPageDir/imageArrowLink.php";
    return Page\imageArrowLink($title, $href, $icon);

}

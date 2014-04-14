<?php

function create_tokens_link ($user) {
    $title = 'Remembered Sessions';
    $href = '../tokens/';
    $icon = 'tokens';
    $num_tokens = $user->num_tokens;
    if ($num_tokens) {
        $description = "$num_tokens total.";
        include_once __DIR__.'/../../fns/Page/imageArrowLinkWithDescription.php';
        return Page\imageArrowLinkWithDescription($title,
            $description, $href, $icon);
    }
    include_once __DIR__.'/../../fns/Page/imageArrowLink.php';
    return Page\imageArrowLink($title, $href, $icon);
}

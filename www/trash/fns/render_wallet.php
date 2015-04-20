<?php

function render_wallet ($wallet, $description, $href, $options, &$items) {
    $items[] = Page\imageArrowLinkWithDescription(
        htmlspecialchars($wallet->name), $description,
        $href, 'wallet', $options);
}

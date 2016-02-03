<?php

namespace Page;

function create ($backlink, $activeTabTitle, $content, $newItemButton = '') {

    $itemsHtml = '';
    if ($backlink !== null) {
        $class = 'clickable tab-normal';
        if (array_key_exists('localNavigation', $backlink)) {
            $class .= ' localNavigation-link';
        }
        $itemsHtml .=
            "<a href=\"$backlink[href]\" class=\"$class\">"
                ."&laquo; $backlink[title]"
            .'</a>';
    }
    $itemsHtml .=
        '<span class="tab-active limited">'
            ."<span class=\"zeroSize\"> &raquo; </span>$activeTabTitle"
        .'</span>';

    return
        '<br class="zeroHeight" />'
        .'<div class="tab">'
            ."<div class=\"tab-bar\">$itemsHtml</div>"
            .$newItemButton
        .'</div>'
        .'<br class="zeroHeight" />'
        ."<div class=\"tab-content\">$content</div>";

}

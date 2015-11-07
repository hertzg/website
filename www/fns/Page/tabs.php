<?php

namespace Page;

function tabs ($tabs, $activeTabTitle, $content, $newItemButton = '') {

    $itemsHtml = '';
    foreach ($tabs as $tab) {
        $itemsHtml .=
            "<a class=\"clickable tab-normal\" href=\"$tab[href]\">"
                ."&laquo; $tab[title]"
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

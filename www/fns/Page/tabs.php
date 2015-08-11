<?php

namespace Page;

function tabs ($tabs, $activeTabTitle, $content, $newItemButton = '') {

    $itemsHtml = '';
    foreach ($tabs as $tab) {
        $itemsHtml .=
            "<a class=\"tab-normal\" href=\"$tab[href]\">"
                ."&laquo;<span class=\"secondary\"> $tab[title]</span>"
            .'</a>';
    }
    $itemsHtml .=
        '<span class="tab-active">'
            ."<span class=\"zeroSize\"> &raquo; </span>$activeTabTitle"
        .'</span>';

    return
        '<br class="zeroHeight" />'
        .'<div class="tab-spacer"></div>'
        .'<div class="tab">'
            ."<div class=\"tab-bar\">$itemsHtml</div>"
            .$newItemButton
        .'</div>'
        .'<br class="zeroHeight" />'
        ."<div class=\"tab-content\">$content</div>";

}

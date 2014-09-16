<?php

namespace Page;

function tabs ($tabs, $activeTabTitle, $content, $newItemButton = '') {

    $itemsHtml = '';
    foreach ($tabs as $tab) {
        $itemsHtml .=
            "<a class=\"tab-normal\" href=\"$tab[href]\">"
                .$tab['title']
            .'</a>';
    }
    $itemsHtml .= "<span class=\"tab-active\">$activeTabTitle</span>";

    return
        '<div class="tab">'
            ."<div class=\"tab-bar\">$itemsHtml</div>"
            .$newItemButton
        .'</div>'
        .'<div class="tab-spacer"></div>'
        ."<div class=\"tab-content\">$content</div>";

}

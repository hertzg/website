<?php

function build_common_css ($r, $g, $b, $mark_r, $mark_g, $mark_b) {

    $hex = function ($n) {
        return str_pad(dechex($n), 2, '0', STR_PAD_LEFT);
    };

    $symmetric = function ($hex) {
        return $hex[0] === $hex[1];
    };

    $hex_r = $hex($r);
    $hex_g = $hex($g);
    $hex_b = $hex($b);
    if ($symmetric($hex_r) && $symmetric($hex_g) && $symmetric($hex_b)) {
        $rgb = $hex_r[0].$hex_g[0].$hex_b[0];
    } else {
        $rgb = $hex_r.$hex_g.$hex_b;
    }

    $content =
        '.clickable:focus,'
        .'.clickable.focus,'
        .'.form-select:focus,'
        .'.form-textfield:focus,'
        .'.form-textarea:focus,'
        .'.topLink:focus,'
        .'.newItemButton.not_green:focus {'
            ."border-color: #$rgb;"
            ."background-color: rgba($r, $g, $b, 0.2);"
        .'}'
        .'.form-select:active,'
        .'.form-textfield:active,'
        .'.form-textarea:active {'
            ."background-color: rgba($r, $g, $b, 0.4);"
        .'}'
        .'.a,'
        .'.tab-active,'
        .'.form-property,'
        .'.page_tabs-tab.selected {'
            ."color: #$rgb;"
        .'}'
        .'.a:focus,'
        .'.tag.active,'
        .'.clickable.target,'
        .'.clickable:target {'
            ."background-color: rgba($r, $g, $b, 0.2);"
        .'}'
        .'#tbar,'
        .'.tag.active,'
        .'.panel-title,'
        .'.page_tabs-tab.selected {'
            ."border-color: #$rgb;"
        .'}'
        .'.clickable.active,'
        .'.clickable:active,'
        .'.newItemButton.not_green:active,'
        .'.topLink:active {'
            ."background-color: #$rgb;"
            ."border-color: #$rgb;"
        .'}'
        .'.panel-title-text {'
            ."color: #$rgb;"
        .'}'
        .'mark {'
            ."background-color: rgba($mark_r, $mark_g, $mark_b, 0.5);"
        .'}'
        .'.tag:focus,'
        .'.tag:active {'
            ."outline: 2px solid #$rgb;"
        .'}'
        .'.progressBar {'
            ."background-color: #$rgb;"
        .'}';

    file_put_contents('common.css', $content);

}

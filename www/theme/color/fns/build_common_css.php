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
        ".clickable:focus,\n"
        .".clickable.focus,\n"
        .".form-select:focus,\n"
        .".form-textfield:focus,\n"
        .".form-textarea:focus,\n"
        .".topLink:focus,\n"
        .".newItemButton.not_green:focus {\n"
        ."    border-color: #$rgb;\n"
        ."    background-color: rgba($r, $g, $b, 0.2);\n"
        ."}\n\n"
        .".form-select:active,\n"
        .".form-textfield:active,\n"
        .".form-textarea:active {\n"
        ."    background-color: rgba($r, $g, $b, 0.4);\n"
        ."}\n\n"
        .".a,\n"
        .".tab-active,\n"
        .".form-property,\n"
        .".page_tabs-tab.selected {\n"
        ."    color: #$rgb;\n"
        ."}\n\n"
        .".a:focus,\n"
        .".tag.active,\n"
        .".clickable.target,\n"
        .".clickable:target {\n"
        ."    background-color: rgba($r, $g, $b, 0.2);\n"
        ."}\n\n"
        ."#tbar,\n"
        .".tag.active,\n"
        .".panel-title,\n"
        .".page_tabs-tab.selected {\n"
        ."    border-color: #$rgb;\n"
        ."}\n\n"
        .".clickable.active,\n"
        .".clickable:active,\n"
        .".newItemButton.not_green:active,\n"
        .".topLink:active {\n"
        ."    background-color: #$rgb;\n"
        ."    border-color: #$rgb;\n"
        ."}\n\n"
        .".panel-title-text {\n"
        ."    color: #$rgb;\n"
        ."}\n\n"
        ."mark {\n"
        ."    background-color: rgba($mark_r, $mark_g, $mark_b, 0.5);\n"
        ."}\n\n"
        .".tag:focus,\n"
        .".tag:active {\n"
        ."    outline: 2px solid #$rgb;\n"
        ."}\n\n"
        .".progressBar {\n"
        ."    background-color: #$rgb;\n"
        ."}\n";

    file_put_contents('common.css', $content);

}

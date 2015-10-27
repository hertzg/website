<?php

namespace Form;

function timefield ($hour, $minute, $text) {

    $emptyOption = '<option value="">--</option>';

    $hourName = $hour['name'];

    $hourSelect =
        '<select class="form-select hour"'
        ." name=\"$hourName\" id=\"$hourName\">$emptyOption";
    for ($i = 0; $i < 24; $i++) {
        if ($i === $hour['value']) {
            $selectedAttribute = ' selected="selected"';
        } else {
            $selectedAttribute = '';
        }
        $hourSelect .=
            "<option value=\"$i\"$selectedAttribute>"
                .str_pad($i, 2, '0', STR_PAD_LEFT)
            .'</option>';
    }
    $hourSelect .= '</select>';

    $minuteSelect =
        '<select class="form-select minute"'
        ." name=\"$minute[name]\">$emptyOption";
    for ($i = 0; $i < 60; $i += 5) {
        if ($i === $minute['value']) {
            $selectedAttribute = ' selected="selected"';
        } else {
            $selectedAttribute = '';
        }
        $minuteSelect .=
            "<option value=\"$i\"$selectedAttribute>"
                .str_pad($i, 2, '0', STR_PAD_LEFT)
            .'</option>';
    }
    $minuteSelect .= '</select>';

    $html =
        '<div class="timefield">'
            .$hourSelect.$minuteSelect
        .'</div>';

    include_once __DIR__.'/association.php';
    return association($html,
        "<label class=\"form-property-label\" for=\"$hourName\">$text:</label>");

}

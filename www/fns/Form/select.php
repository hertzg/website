<?php

namespace Form;

function select ($name, $text, $options, $value, $autofocus = false) {

    if ($autofocus) $autofocusAttribute = ' autofocus="autofocus"';
    else $autofocusAttribute = '';

    $selectHtml = '<select class="form-select"'
        ." name=\"$name\" id=\"$name\"$autofocusAttribute>";
    foreach ($options as $itemValue => $itemText) {
        if (strcmp($itemValue, $value) === 0) {
            $selectedAttribute = ' selected="selected"';
        } else {
            $selectedAttribute = '';
        }
        $selectHtml .=
            "<option value=\"$itemValue\"$selectedAttribute>$itemText</option>";
    }
    $selectHtml .= '</select>';

    include_once __DIR__.'/association.php';
    return association($selectHtml,
        "<label class=\"form-property-label\" for=\"$name\">$text:</label>");

}

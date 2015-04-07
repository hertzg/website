<?php

namespace Form;

function select ($name, $text, $options, $value) {
    $selectHtml = "<select class=\"form-select\" name=\"$name\" id=\"$name\">";
    foreach ($options as $itemValue => $itemText) {
        if (strcmp($itemValue, $value) === 0) {
            $selectHtml .=
                "<option selected=\"selected\" value=\"$itemValue\">"
                    .$itemText
                .'</option>';
        } else {
            $selectHtml .= "<option value=\"$itemValue\">$itemText</option>";
        }
    }
    $selectHtml .= '</select>';
    include_once __DIR__.'/association.php';
    return association($selectHtml, "<label for=\"$name\">$text:</label>");
}

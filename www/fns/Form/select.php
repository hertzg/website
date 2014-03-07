<?php

namespace Form;

function select ($name, $text, array $options, $value) {
    $selectHtml = "<select class=\"form-select\" name=\"$name\" id=\"$name\">";
    foreach ($options as $itemValue => $itemText) {
        if ($itemValue == $value) {
            $selectHtml .=
                "<option selected=\"selected\" value=\"$itemValue\">"
                    .$itemText
                .'</option>';
        } else {
            $selectHtml .= "<option value=\"$itemValue\">$itemText</option>";
        }
    }
    $selectHtml .= '</select>';
    include_once __DIR__.'/../../classes/Form.php';
    return \Form::association(
        $selectHtml,
        "<label for=\"$name\">$text</label>"
    );
}

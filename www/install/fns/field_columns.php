<?php

function field_columns ($field1, $field2) {
    return
        '<div class="field_columns">'
            ."<div class=\"field_columns-column column1\">$field1</div>"
            ."<div class=\"field_columns-column column2\">$field2</div>"
        .'</div>';
}

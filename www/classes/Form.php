<?php

class Form {

    static function association ($value, $property) {
        return
            '<div class="form-item">'
                ."<div class=\"form-property\">$property</div>"
                ."<div class=\"form-value\">$value</div>"
            .'</div>';
    }

    static function select ($name, $text, array $options, $value) {
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
        return self::association(
            $selectHtml,
            "<label for=\"$name\">$text</label>"
        );
    }

    private static function getBoolAttribute ($name, array $config) {
        if (array_key_exists($name, $config) && $config[$name]) {
            return " $name=\"$name\"";
        }
    }

    static function textarea ($name, $text, $config = array()) {

        if (array_key_exists('value', $config)) {
            $content = "\n".htmlspecialchars($config['value']);
        } else{
            $content = '';
        }

        return self::association(
            '<textarea class="form-textarea"'
            .self::getBoolAttribute('autofocus', $config)
            .self::getBoolAttribute('readonly', $config)
            .self::getBoolAttribute('required', $config)
            ." id=\"$name\" name=\"$name\">$content</textarea>",
            "<label for=\"$name\">$text:</label>"
        );

    }

    static function textfield ($name, $text, array $config = array()) {

        if (array_key_exists('type', $config)) {
            $type = $config['type'];
        } else {
            $type = 'text';
        }

        if (array_key_exists('value', $config)) {
            $valueAttribute = ' value="'.htmlspecialchars($config['value']).'"';
        } else {
            $valueAttribute = '';
        }

        if (array_key_exists('maxlength', $config)) {
            $maxlengthAttribute = " maxlength=\"$config[maxlength]\"";
        } else {
            $maxlengthAttribute = '';
        }

        return self::association(
            '<input class="form-textfield"'
            .$maxlengthAttribute
            .$valueAttribute
            .self::getBoolAttribute('autofocus', $config)
            .self::getBoolAttribute('readonly', $config)
            .self::getBoolAttribute('required', $config)
            ." id=\"$name\" name=\"$name\" type=\"$type\" />",
            "<label for=\"$name\">$text:</label>"
        );

    }

}

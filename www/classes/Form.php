<?php

class Form {

    static function association ($value, $property) {
        return
            '<div class="form-item">'
                ."<div class=\"form-property\">$property</div>"
                ."<div class=\"form-value\">$value</div>"
            .'</div>';
    }

    static function button ($text) {
        return '<input class="clickable form-button"'
            ." type=\"submit\" value=\"$text\" />";
    }

    static function captcha () {
        include_once 'Captcha.php';
        if (Captcha::required()) {
            include_once 'Page.php';
            return
                self::textfield('captcha', 'Verification', array(
                    'required' => true,
                ))
                .'<div class="form-captcha">'
                    .'<img src="captcha.php" style="vertical-align: top"'
                    .' alt="CAPTCHA" width="102" height="40" />'
                .'</div>'
                .Page::HR;
        }
    }

    static function checkbox ($name, $text, $checked) {
        return
            '<div class="form-checkbox">'
                .'<label>'
                    .'<span>'
                        ."<input type=\"checkbox\" id=\"$name\" name=\"$name\""
                        .($checked ? ' checked="checked"' : '').' />'
                    .'</span>'
                    .$text
                .'</label>'
            .'</div>';
        return self::association(
            '<div style="line-height: 48px">'
                .'<input type="checkbox" class="form-checkbox"'
                .($checked ? ' checked="checked"' : '')
                ." id=\"$name\" name=\"$name\" />"
            .'</div>',
            "<label for=\"$name\">$text:</label>"
        );
    }

    static function create ($action, $content) {
        return
            '<form class="form-form" method="post"'
            ." enctype=\"multipart/form-data\" action=\"$action\">"
                ."<div class=\"form-div\">$content</div>"
            .'</form>';
    }

    static function filefield ($name, $text) {
        return self::association(
            '<input class="form-filefield" type="file" multiple="multiple"'
            ." id=\"$name\" name=\"$name\" />",
            "<label for=\"$name\">$text</label>"
        );
    }

    static function hidden ($name, $value) {
        $value = htmlspecialchars($value);
        return "<input type=\"hidden\" name=\"$name\" value=\"$value\" />";
    }

    static function label ($text, $value) {
        return self::association(
            "<div class=\"form-label\">$value</div>",
            "<label>$text:</label>"
        );
    }

    static function notes (array $notes) {
        $ul = '<ul class="form-notes">';
        foreach ($notes as $note) {
            $ul .= "<li>$note</li>";
        }
        $ul .= '</ul>';
        return self::association($ul, '');
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
            .self::getBoolAttribute('required', $config)
            ." id=\"$name\" name=\"$name\" type=\"$type\" />",
            "<label for=\"$name\">$text:</label>"
        );

    }

    static function password ($name, $text, array $config = array()) {
        $config['type'] = 'password';
        return self::textfield($name, $text, $config);
    }

}

<?php

function format_result ($object) {

    $type = $object['type'];

    if ($type === 'boolean') {
        return "<code>&lt;boolean&gt;</code> - $object[description]";
    }

    if ($type === 'number') {
        return "<code>&lt;number&gt;</code> - $object[description]";
    }

    if ($type === 'string') {
        return "<code>&lt;string&gt;</code> - $object[description]";
    }

    if ($type === 'object') {
        $html =
            '<div>'
                .'<code>{</code>';
        foreach ($object['object'] as $key => $item) {
            $html .=
                '<div style="margin-left: 20px">'
                    ."<code>$key</code>: ".format_result($item)
                .'</div>';
        }
        $html .=
                '<code>}</code>'
            .'</div>';
        return $html;
    }

    if ($type === 'array') {
        $html =
            '<div>'
                .'<code>[</code>'
                .'<div style="margin-left: 20px">'
                    .format_result($object['item'])
                    .'...'
                .'</div>'
                .'<code>]</code>'
            .'</div>';
        return $html;
    }

}

<?php

function json_result ($object) {

    $type = $object['type'];

    if ($type === 'boolean' || $type === 'number' || $type === 'string') {
        return "&lt;$type&gt; - $object[description]";
    }

    if ($type === 'object') {
        $html =
            '<div>'
                .'<code>{</code>';
        foreach ($object['object'] as $key => $item) {
            $html .=
                '<div style="margin-left: 20px">'
                    ."<code>$key</code>: ".json_result($item)
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
                    .json_result($object['item'])
                    .'...'
                .'</div>'
                .'<code>]</code>'
            .'</div>';
        return $html;
    }

}

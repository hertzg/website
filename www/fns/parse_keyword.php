<?php

function parse_keyword ($keyword, &$includes, &$excludes) {

    $includes = $excludes = [];

    $index = 0;
    $length = mb_strlen($keyword, 'UTF-8');

    $read_term = function (&$target_array) use ($keyword, $length, &$index) {
        $char = mb_substr($keyword, $index, 1, 'UTF-8');
        if ($char === '"') {
            $term = '';
            while (true) {
                $index++;
                if ($index === $length) break;
                $char = mb_substr($keyword, $index, 1, 'UTF-8');
                if ($char === '"') {
                    $index++;
                    if ($index === $length) break;
                    $char = mb_substr($keyword, $index, 1, 'UTF-8');
                    if ($char !== '"') break;
                }
                $term .= $char;
            }
            if ($term === '') return;
        } else {
            $term = $char;
            while (true) {
                $index++;
                if ($index === $length) break;
                $char = mb_substr($keyword, $index, 1, 'UTF-8');
                if ($char === ' ') {
                    $index++;
                    break;
                }
                $term .= $char;
            }
        }
        $target_array[$term] = $term;
    };

    while ($index < $length) {
        $char = mb_substr($keyword, $index, 1, 'UTF-8');
        if ($char === ' ') {
            $index++;
        } elseif ($char === '"') {
            $read_term($includes);
        } elseif ($char === '-') {
            $index++;
            if ($index === $length) {
                $includes['-'] = '-';
                break;
            }
            $char = mb_substr($keyword, $index, 1, 'UTF-8');
            if ($char === ' ') {
                $includes['-'] = '-';
                $index++;
            } else {
                $read_term($excludes);
            }
        } else {
            $read_term($includes);
        }
    }

    $includes = array_values($includes);
    $excludes = array_values($excludes);

}

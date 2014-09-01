<?php

function build_definition ($column) {

    $definition = $column['type'];

    if (array_key_exists('characterSet', $column)) {
        $definition .= " character set $column[characterSet]"
            ." collate $column[collation]";
    }

    if (array_key_exists('primary', $column)) {
        $definition .= ' auto_increment primary key';
    } else {
        if (!array_key_exists('nullable', $column) || !$column['nullable']) {
            $definition .= ' not null';
        }
        if (array_key_exists('default', $column)) {
            $default = $column['default'];
            if ($default !== null && $default !== '') {
                $escapedDefault = $mysqli->real_escape_string($default);
                $definition .= " default '$escapedDefault'";
            }
        }
    }

    return $definition;

}

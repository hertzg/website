<?php

namespace Table;

function addColumns ($mysqli, $tableName, $columns) {

    $output = '';
    $escapedTableName = $mysqli->real_escape_string($tableName);

    include_once __DIR__.'/columnDefinition.php';
    foreach ($columns as $name => $column) {
        $escapedName = $mysqli->real_escape_string($name);
        $definition = columnDefinition($column);
        $sql = "alter table `$escapedTableName`"
            ." add `$escapedName` $definition";
        $output .= "SQL: $sql\n";
        $mysqli->query($sql) || trigger_error($mysqli->error);
    }

    return $output;

}

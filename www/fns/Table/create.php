<?php

namespace Table;

function create ($mysqli, $tableName, $columns) {

    $escapedTableName = $mysqli->real_escape_string($tableName);

    $sql = "create table `$escapedTableName` (";
    $first = true;
    foreach ($columns as $name => $column) {
        if ($first) $first = false;
        else $sql .= ', ';
        $escapedName = $mysqli->real_escape_string($name);
        $definition = columnDefinition($column);
        $sql .= "`$escapedName` $definition";
    }
    $sql .= ')';
    $mysqli->query($sql) || trigger_error($mysqli->error);

    return "SQL: $sql\n";

}

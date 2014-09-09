<?php

function ensure_table ($tableName, array $columns) {

    $fnsDir = __DIR__.'/../../../../fns';

    include_once "$fnsDir/get_mysqli_config.php";
    get_mysqli_config($host, $user, $password, $db);

    include_once "$fnsDir/get_mysqli.php";
    $mysqli = get_mysqli();

    $escapedDb = $mysqli->real_escape_string($db);
    $escapedTableName = $mysqli->real_escape_string($tableName);

    include_once __DIR__.'/build_definition.php';

    include_once "$fnsDir/mysqli_single_object.php";
    $sql = 'select * from information_schema.tables'
        ." where table_schema = '$escapedDb'"
        ." and table_name = '$escapedTableName'";
    $table = mysqli_single_object($mysqli, $sql);

    if ($table) {

        include_once "$fnsDir/mysqli_query_object.php";
        $sql = 'select * from information_schema.columns'
            ." where table_schema = '$escapedDb'"
            ." and table_name = '$escapedTableName'";
        $existingColumns = mysqli_query_object($mysqli, $sql);

        foreach ($existingColumns as $existingColumn) {

            $columnName = $existingColumn->COLUMN_NAME;
            if (!array_key_exists($columnName, $columns)) continue;

            $existingType = $existingColumn->COLUMN_TYPE;
            $existingNullable = $existingColumn->IS_NULLABLE === 'YES';
            $existingDefault = $existingColumn->COLUMN_DEFAULT;

            $column = $columns[$columnName];
            $type = $column['type'];
            unset($columns[$columnName]);

            if (array_key_exists('nullable', $column)) {
                $nullable = $column['nullable'];
            } else {
                $nullable = false;
            }

            if (array_key_exists('default', $column)) {
                $default = $column['default'];
            } else {
                $default = null;
            }

            if ($type === $existingType && $nullable === $existingNullable &&
                $default === $existingDefault) continue;

            echo "changing column $tableName.$columnName"
                ." from $existingType to $type...\n";

            $escapedColumnName = $mysqli->real_escape_string($columnName);
            $sql = "alter table `$escapedTableName` change `$escapedColumnName`"
                ." `$escapedColumnName` ".build_definition($column);

            $mysqli->query($sql) || trigger_error($mysqli->error);

        }

        foreach ($columns as $name => $column) {
            echo "adding column $tableName.$name...\n";
            $escapedName = $mysqli->real_escape_string($name);
            $definition = build_definition($column);
            $sql = "alter table `$escapedTableName`"
                ." add `$escapedName` $definition";
            $mysqli->query($sql) || trigger_error($mysqli->error);
        }

    } else {
        echo "creagin table $tableName...\n";
        $sql = "create table `$escapedTableName` (";
        $first = true;
        foreach ($columns as $name => $column) {
            if ($first) $first = false;
            else $sql .= ', ';
            $escapedName = $mysqli->real_escape_string($name);
            $definition = build_definition($column);
            $sql .= "`$escapedName` $definition";
        }
        $sql .= ')';
        $mysqli->query($sql) || trigger_error($mysqli->error);
    }

}

<?php

namespace CalculationDepends;

function add ($mysqli, $id_users, $id_calculations, $depends) {
    $sql = 'insert into calculation_depends'
        .' (id_users, id_calculations, depend_id_calculations) values ';
    foreach ($depends as $i => $depend_id_calculations) {
        if ($i) $sql .= ', ';
        $sql .= "($id_users, $id_calculations, $depend_id_calculations)";
    }
    $mysqli->query($sql) || trigger_error($mysqli->error);
}

<?php

namespace ReferencedCalculations;

function add ($mysqli, $id_calculations, $referenced_id_calculations) {
    $sql = 'insert into referenced_calculations'
        .' (id_calculations, referenced_id_calculations)'
        ." values ($id_calculations, $referenced_id_calculations)";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}

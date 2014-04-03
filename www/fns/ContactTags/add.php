<?php

namespace ContactTags;

function add ($mysqli, $id_users, $id_contacts, array $tag_names,
    $full_name, $alias, $favorite) {

    $full_name = $mysqli->real_escape_string($full_name);
    $alias = $mysqli->real_escape_string($alias);
    $favorite = $favorite ? '1' : '0';

    foreach ($tag_names as $tag_name) {
        $tag_name = $mysqli->real_escape_string($tag_name);
        $sql = 'insert into contact_tags'
            .' (id_users, id_contacts, tag_name,'
            .' full_name, alias, favorite)'
            ." values ($id_users, $id_contacts, '$tag_name',"
            ." '$full_name', '$alias', $favorite)";
        $mysqli->query($sql) || trigger_error($mysqli->error);
    }

}

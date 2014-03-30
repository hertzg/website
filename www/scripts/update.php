<?php

chdir(__DIR__);
include_once '../lib/mysqli.php';

function query ($sql) {
    global $mysqli;
    $mysqli->query($sql) || trigger_error("\n\nERROR: $sql\n$mysqli->error\n\n");
}

query('alter table bookmark_tags change idbookmarks id_boomarks bigint unsigned not null');
query('alter table bookmark_tags change tagname tag_name varchar(64) character set utf8 collate utf8_unicode_ci not null');
query('alter table bookmark_tags change idusers id_users bigint unsigned not null');
query('alter table bookmarks change idbookmarks id_bookmarks bigint unsigned auto_increment not null');
query('alter table bookmarks change idusers id_users bigint unsigned not null');
query('alter table channels change channelname channel_name varchar(32) character set ascii not null');
query('alter table channels change channelkey channel_key binary(16) not null');
query('alter table channels change idchannels id_channels bigint unsigned auto_increment not null');
query('alter table channels change idusers id_users bigint unsigned not null');
query('alter table contact_tags change idcontacts id_contacts bigint unsigned not null');
query('alter table contact_tags change idusers id_users bigint unsigned not null');
query('alter table contact_tags change tagname tag_name varchar(64) character set utf8 collate utf8_unicode_ci not null');
query('alter table contacts change idcontacts id_contacts bigint unsigned auto_increment not null');
query('alter table contacts change idusers id_users bigint unsigned not null');
query('alter table events change idevents id_events bigint unsigned auto_increment not null');
query('alter table events change idusers id_users bigint unsigned not null');
query('alter table events change eventtext event_text text character set utf8 collate utf8_unicode_ci not null');
query('alter table events change eventtime event_time bigint unsigned not null');
query('alter table feedbacks change idusers id_users bigint unsigned not null');
query('alter table files change idfiles id_files bigint unsigned not null auto_increment');
query('alter table files change idfolders id_folders bigint unsigned not null');
query('alter table files change idusers id_users bigint unsigned not null');
query('alter table files change file_name file_name varchar(255) character set utf8 collate utf8_unicode_ci not null');
query('alter table files change filesize file_size bigint unsigned not null');
query('alter table folders change foldername folder_name varchar(255) character set utf8 collate utf8_unicode_ci not null');
query('alter table folders change idfolders id_folders bigint unsigned not null auto_increment');
query('alter table folders change idusers id_users bigint unsigned not null');
query('alter table folders change parentidfolders parent_id_folders bigint unsigned not null');
query('alter table note_tags change idnotes id_notes bigint unsigned not null');
query('alter table note_tags change idusers id_users bigint unsigned not null');
query('alter table note_tags change notetext note_text varchar(1024) character set utf8 collate utf8_unicode_ci not null');
query('alter table note_tags change tagname tag_name varchar(64) character set utf8 collate utf8_unicode_ci not null');
query('alter table notes change idusers id_users bigint unsigned not null');
query('alter table notifications change channelname channel_name varchar(32) character set ascii not null');
query('alter table notifications change idchannels id_channels bigint unsigned not null');
query('alter table notifications change notificationtext notification_text text character set utf8 collate utf8_unicode_ci not null');
query('alter table notifications change idnotifications id bigint unsigned not null auto_increment');
query('alter table notifications change idusers id_users bigint unsigned not null');
query('alter table task_tags change idtasks id_tasks bigint unsigned not null');
query('alter table task_tags change idusers id_users bigint unsigned not null');
query('alter table task_tags change tagname tag_name varchar(64) character set utf8 collate utf8_unicode_ci not null');
query('alter table task_tags change tasktext task_text varchar(128) character set utf8 collate utf8_unicode_ci not null');
query('alter table tasks change idtasks id_tasks bigint unsigned not null auto_increment');
query('alter table tasks change idusers id_users bigint unsigned not null');
query('alter table tasks change tasktext task_text varchar(128) character set utf8 collate utf8_unicode_ci not null');
query('alter table tokens change idtokens id_tokens bigint unsigned not null auto_increment');
query('alter table tokens change idusers id_users bigint unsigned not null');
query('alter table tokens change tokentext token_text binary(16) not null');
query('alter table tokens change useragent user_agent varchar(1024) character set ascii collate ascii_bin default null');
query('alter table users change idusers id_users bigint unsigned not null');

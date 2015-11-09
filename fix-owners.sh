#!/bin/bash
cd `dirname $BASH_SOURCE`
owner=www-data:www-data
chown --recursive $owner www/data/contact-photos
chown --recursive $owner www/data/users
chown $owner www/.htaccess
chown $owner www/fns/Admin/get.php
chown $owner www/fns/AdminApiKeys/OrderBy/get.php
chown $owner www/fns/ClientAddress/get.php
chown $owner www/fns/ClientAddress/GetMethod/get.php
chown $owner www/fns/DomainName/get.php
chown $owner www/fns/InfoEmail/get.php
chown $owner www/fns/Installed/get.php
chown $owner www/fns/MysqlConfig/get.php
chown $owner www/fns/SignUpEnabled/get.php
chown $owner www/fns/SiteBase/get.php
chown $owner www/fns/SiteProtocol/get.php
chown $owner www/fns/SiteTitle/get.php
chown $owner www/fns/Users/OrderBy/get.php

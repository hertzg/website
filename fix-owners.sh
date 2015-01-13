#!/bin/bash
cd `dirname $BASH_SOURCE`
owner=www-data:www-data
chown -R $owner www/data/contact-photos
chown -R $owner www/data/users
chown $owner www/fns/Admin/get.php
chown $owner www/fns/DomainName/get.php
chown $owner www/fns/InfoEmail/get.php
chown $owner www/fns/Installed/get.php
chown $owner www/fns/MysqlConfig/get.php
chown $owner www/fns/SiteBase/get.php
chown $owner www/fns/SiteProtocol/get.php

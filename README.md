Zvini Website
=============

Zvini is a website script where users can store and exchange
personal information such as files, notes, contacts and more.
An instance of the script runs on https://zvini.com/.
The website comes with an installer which should work in most environments.
For other environments or for manual installation see the sections below:

Configuration Files
-------------------
In `www/fns` folder:

* `MysqlConfig/get.php` contains MySQL server address,
username, password and a schema name.
* `DomainName/get.php` contains the domain name of the server on which
the website is running. If the server is running on a port different
from 80 the port should be added to the value. Examples:
`'zvini.example.com'`, `'localhost:8080'`.
* `SiteBase/get.php` contains the path from the document
root to `www` folder. Examples: `'/'`, `'/www/'`, `'/zvini/'`.
* `SiteProtocol/get.php` contains the website
protocol either `'http'` or `'https'`.
* `ClientAddress/get.php` contains a way to detect a client IP address.

Installation Scripts
--------------------
In `www/scripts` folder:
* `./ensure/table/run-all.sh` will create all the tables in the database.
* `./create-data-dir.sh` will create a data folder
in which users' files will be stored.
* `./create-htaccess.sh` will create `.htaccess` file for the website.
* `./client-address-get-method/set-direct.php` will detect a client
IP address from `$_SERVER['REMOTE_ADDR']` variable. This is suitable
for HTTP servers that accept connections directly from the clients.
* `./client-address-get-method/set-behind-proxy.php` will detect a
client IP address from `$_SERVER['HTTP_X_FORWARDED_FOR']` variable. This
is suitable for HTTP servers that are behind a single reverse proxy server.

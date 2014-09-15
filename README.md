Zvini Website
=============

The website that runs on https://zvini.com/.

Configuration
-------------
In `www/fns` folder:

* `get_mysqli_config.php` contains MySQL server address,
username, password and a schema name.
* `get_domain_name.php` contains the domain name of the server on which
the website is running. If the server is running on a port different
from 80 the port should be added to the value. Examples:
`'zvini.example.com'`, `'localhost:8080'`.
* `get_site_base.php` contains the path from the document
root to `www` folder. Examples: `'/'`, `'/www/'`, `'/zvini/'`.
* `get_site_protocol.php` contains the website
protocol either `'http'` or `'https'`.

Installation
------------
In `www/scripts` folder:
* `./ensure/table/run-all.sh` will create all the tables in the database.
* `./create-data-dir.sh` will a data folder
in which users' files will be stored.
* `./create-htaccess.sh` will create `.htaccess` file for the website.

<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  | -------------------------------------------------------------------
  | DATABASE CONNECTIVITY SETTINGS
  | -------------------------------------------------------------------
  | This file will contain the settings needed to access your database.
  |
  | For complete instructions please consult the 'Database Connection'
  | page of the User Guide.
  |
  | -------------------------------------------------------------------
  | EXPLANATION OF VARIABLES
  | -------------------------------------------------------------------
  |
  |	['hostname'] The hostname of your database server.
  |	['username'] The username used to connect to the database
  |	['password'] The password used to connect to the database
  |	['database'] The name of the database you want to connect to
  |	['dbdriver'] The database type. ie: mysql.  Currently supported:
  mysql, mysqli, postgre, odbc, mssql, sqlite, oci8
  |	['dbprefix'] You can add an optional prefix, which will be added
  |				 to the table name when using the  Active Record class
  |	['pconnect'] TRUE/FALSE - Whether to use a persistent connection
  |	['db_debug'] TRUE/FALSE - Whether database errors should be displayed.
  |	['cache_on'] TRUE/FALSE - Enables/disables query caching
  |	['cachedir'] The path to the folder where cache files should be stored
  |	['char_set'] The character set used in communicating with the database
  |	['dbcollat'] The character collation used in communicating with the database
  |				 NOTE: For MySQL and MySQLi databases, this setting is only used
  | 				 as a backup if your server is running PHP < 5.2.3 or MySQL < 5.0.7
  |				 (and in table creation queries made with DB Forge).
  | 				 There is an incompatibility in PHP with mysql_real_escape_string() which
  | 				 can make your site vulnerable to SQL injection if you are using a
  | 				 multi-byte character set and are running versions lower than these.
  | 				 Sites using Latin-1 or UTF-8 database character set and collation are unaffected.
  |	['swap_pre'] A default table prefix that should be swapped with the dbprefix
  |	['autoinit'] Whether or not to automatically initialize the database.
  |	['stricton'] TRUE/FALSE - forces 'Strict Mode' connections
  |							- good for ensuring strict SQL while developing
  |
  | The $active_group variable lets you choose which connection group to
  | make active.  By default there is only one group (the 'default' group).
  |
  | The $active_record variables lets you determine whether or not to load
  | the active record class
 */

$active_group = 'default';
$active_record = TRUE;

$db['default']['hostname'] = 'localhost';
$db['default']['username'] = 'root';
$db['default']['password'] = '';
$db['default']['database'] = 'engage_client';
$db['default']['dbdriver'] = 'mysqli';
$db['default']['dbprefix'] = '';
$db['default']['pconnect'] = TRUE;
$db['default']['db_debug'] = TRUE;
$db['default']['cache_on'] = FALSE;
$db['default']['cachedir'] = '';
$db['default']['char_set'] = 'utf8';
$db['default']['dbcollat'] = 'utf8_general_ci';
$db['default']['swap_pre'] = '';
$db['default']['autoinit'] = TRUE;
$db['default']['stricton'] = FALSE;

//admin database settings

$db['admin_db']['hostname'] = 'localhost';
$db['admin_db']['username'] = 'root';
$db['admin_db']['password'] = '';
$db['admin_db']['database'] = 'engage_admin';
$db['admin_db']['dbdriver'] = 'mysqli';
$db['admin_db']['dbprefix'] = '';
$db['admin_db']['pconnect'] = TRUE;
$db['admin_db']['db_debug'] = TRUE;
$db['admin_db']['cache_on'] = FALSE;
$db['admin_db']['cachedir'] = '';
$db['admin_db']['char_set'] = 'utf8';
$db['admin_db']['dbcollat'] = 'utf8_general_ci';
$db['admin_db']['swap_pre'] = '';
$db['admin_db']['autoinit'] = TRUE;
$db['admin_db']['stricton'] = FALSE;

// supplier database settings

$db['supplier_db']['hostname'] = 'localhost';
$db['supplier_db']['username'] = 'root';
$db['supplier_db']['password'] = '';
$db['supplier_db']['database'] = 'engage_supplier';
$db['supplier_db']['dbdriver'] = 'mysqli';
$db['supplier_db']['dbprefix'] = '';
$db['supplier_db']['pconnect'] = TRUE;
$db['supplier_db']['db_debug'] = TRUE;
$db['supplier_db']['cache_on'] = FALSE;
$db['supplier_db']['cachedir'] = '';
$db['supplier_db']['char_set'] = 'utf8';
$db['supplier_db']['dbcollat'] = 'utf8_general_ci';
$db['supplier_db']['swap_pre'] = '';
$db['supplier_db']['autoinit'] = TRUE;
$db['supplier_db']['stricton'] = FALSE;

/* End of file database.php */
/* Location: ./application/config/database.php */
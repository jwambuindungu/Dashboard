<?php
$username = isset($_SESSION['user.username']) ? $_SESSION['user.username'] : null;
$password = isset($_SESSION['user.password']) ? $_SESSION['user.password'] : null;

return [
    'class' => 'neconix\yii2oci8\Oci8Connection',
    'dsn' => 'oci:dbname=proddb.uonbi.ac.ke/proddb', // Oracle
    'username' => $username,
    'password' => $password,
    //'schema'=>'dashboard',
    'charset' => 'utf8',
    //'tablePrefix' => 'DT_',
    'attributes' => [PDO::ATTR_PERSISTENT => true],
    'enableSchemaCache' => true, //Oracle dictionaries is too slow :(, enable caching
    'schemaCacheDuration' => 60 * 60, //1 hour
    'on afterOpen' => function ($event) {
        $q = <<<SQL
begin
  execute immediate 'alter session set NLS_COMP=LINGUISTIC';
  execute immediate 'alter session set NLS_SORT=BINARY_CI';
  execute immediate 'alter session set NLS_TERRITORY=AMERICA';
end;
SQL;
        $event->sender->createCommand($q)->execute();
    }
];
/*
return [
    'class' => 'yii\db\Connection',
    //'dsn' => 'mysql:host=localhost;dbname=ayes', // MySQL, MariaDB
    //'dsn' => 'sqlite:/path/to/database/file', // SQLite
    //'dsn' => 'pgsql:host=localhost;port=5432;dbname=mydatabase', // PostgreSQL
    //'dsn' => 'cubrid:dbname=demodb;host=localhost;port=33000', // CUBRID
    //'dsn' => 'sqlsrv:Server=localhost;Database=mydatabase', // MS SQL Server, sqlsrv driver
    //'dsn' => 'dblib:host=localhost;dbname=mydatabase', // MS SQL Server, dblib driver
    //'dsn' => 'mssql:host=localhost;dbname=mydatabase', // MS SQL Server, mssql driver
    'dsn' => 'oci:dbname=//localhost:1521/XE', // Oracle
    //'dsn' => 'oci:dbname=proddb2.uonbi.ac.ke/proddb2', // Oracle
    'username' => 'muthoni',
    'password' => 'muthoni_2015_schema',
    //'charset' => 'utf8',
    'tablePrefix' => 'DT_'
];*/

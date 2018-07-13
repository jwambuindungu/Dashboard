<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=application.uonbi.ac.ke;dbname=onlineapp', // MySQL, MariaDB
    'username' => null,
    'password' => null,
    'charset' => 'utf8',
    'attributes' => [PDO::ATTR_PERSISTENT => true],
    'enableSchemaCache' => true,
    'schemaCacheDuration' => 60 * 60, //1 hour
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
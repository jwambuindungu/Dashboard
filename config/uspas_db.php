<?php
// this section of code connects uspas reports to management dashboard
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

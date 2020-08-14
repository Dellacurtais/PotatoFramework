<?php
namespace System\Database;

use Illuminate\Database\Capsule\Manager as Capsule;

class EloquentDriver implements DriverImplements {

    public function createConnection($Config){
        $capsule = new Capsule();
        $capsule->addConnection([
            'driver'    => 'mysql',
            'host'      => $Config['db_hostname'],
            'database'  => $Config['db_database'],
            'username'  => $Config['db_username'],
            'password'  => $Config['db_password'],
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ]);
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }

}

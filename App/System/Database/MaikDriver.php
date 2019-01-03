<?php
namespace System\Database;

class MaikDriver implements DriverImplements {

    public function createConnection($Config){
        $database = new \stdClass();
        $database->hostname = $Config['db_hostname'];
        $database->database = $Config['db_database'];
        $database->username = $Config['db_username'];
        $database->password = $Config['db_password'];

        $database->generate = $Config['db_generate'];
        $database->generate_dir = BASE_PATH.'Models/'.$Config['db_generate_dir'];
        $database->generate_base = $Config['db_generate_base_only'];
        $database->generate_replace = $Config['db_generate_replace'];

        \MaikDatabase\Settings::getInstance()->createConnection($database, true, $Config['db_keyname']);
    }

}

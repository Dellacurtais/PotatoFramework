<?php
$Config = array();

$Config['name_project'] = "Potato";

$Config['base_dir'] = "/";
$Config['base_url'] = "http://potato.com.br/";
$Config['https_enable'] = false;
$Config['ssl_verify'] = false; //redir ssl

/**
 * Load Files Route
 * Put the name of file on folder App/Config/Routes
 */
$Config["files_route"] = [ "Default" ];

/**
 * Configs Rotas
 */
$Config['default_route'] = "Home";

/**
 *
 */
$Config['error_content_type'] = \System\ResponseType::CONTENT_HTML;
$Config['error_extra_headers'] = [];

$Config['enable_query_strings'] = true;
$Config['encrypt_key'] = "default";

/**
 * DATABASE CONFIG
 */
$Config['db_driver'] = [
    "isActive" => true,
    "class" => \System\Database\EloquentDriver::class, //Class Driver para setup de conexão com banco de dados
    "config" => [
        "db_hostname" => "localhost",
        "db_database" => "dbname",
        "db_username" => "dbuser",
        "db_password" => "dbpass",
    ]
];

/**
 * SESSÃO CONFIG
 */
$Config['session_id'] = "sphap"; //Nome da Sessão


/**
 * Default assets dir
 */
$Config['base_dir_assets'] = "public/";

/**
 * Diretorios de Uploads
 */
$Config['upload']['image'] = "/public/uploads/img/";
$Config['upload']['docs'] = "/public/uploads/docs/";
$Config['cache_image'] = "/public/cache/img/";

/**
 * Default Lang
 */
$Config['lang'] = "pt-br";

/**
 * Template Engine
 * TEMPLATE_ENGINE_SMARTY Use Smarty Template
 * TEMPLATE_WITHOUT_ENGINE Use direct PHP file
 *
 */
$Config['template'] = TEMPLATE_ENGINE_SMARTY;

/**
 * Timezone
 */
$Config['timezone'] = "America/Sao_Paulo";

/**
 * Autoloads Helpers
 * Verifica se existe o arquivo e o inclui antes de iniciar o controlador
 * Ex: Session, Pagination, Text, Upload
 */
$Config['helpersLoad'] = ["Session", "Pagination", "Text", "Upload"];

/**
 * Configurações extras
 */
$Config['auth_link'] = "";
$Config['auth_user'] = "";
$Config['auth_pass'] = "";

/**
 * Emails
 */
$Config['Email']["smtp_host"] = "";
$Config['Email']["smtp_user"] = "";
$Config['Email']["smtp_pass"] = "";
$Config['Email']["smtp_port"] = "";
$Config['Email']["smtp_name"] = "";

/**
 * Usar MailGun para envio de Emails
 */
$Config['Email']["use_api"] = false; //Habilitar envio true or false
$Config['Email']["mailgun_domain"] = ""; // Domínio mailgun
$Config['Email']["mailgun_token"] = ""; //Token mailgun

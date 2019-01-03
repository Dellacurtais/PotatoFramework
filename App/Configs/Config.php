<?php
$Config = array();

$Config['name_project'] = "API SigPolítico";

$Config['base_dir'] = "/Potato/";
$Config['base_url'] = "http://127.0.0.1/Potato/";

/**
 * Load Files Route
 * Put the name of file on folder App/Config/Routes
 */
$Config["files_route"] = ["Default"];

/**
 * Configs Rotas
 */
$Config['default_route'] = "Welcome";

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
    "class" => \System\Database\MaikDriver::class, //Class Driver para setup de conexão com banco de dados
    "config" => [
        "db_hostname" => "localhost",
        "db_database" => "Potato",
        "db_username" => "root",
        "db_password" => "mysql",
        "db_generate" => false, //Gerar Modelos
        "db_generate_base_only" => false, //Atualizar apenas arquivo base do modelo
        "db_generate_replace" => false, //Não substituir se existir
        "db_generate_dir" => "", //Pasta para Gerar (Por Padão gera na pasta Model)
        "db_keyname" => "frame_work"//Nome da conexão
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
 * Default Lang
 */
$Config['lang'] = "pt-br";

/**
 * Template Engine
 * TEMPLATE_ENGINE_SMARTY = Usar Smarty template (APENAS SMARTY NESTA VERSÃO)
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
$Config['helpersLoad'] = ["Session"];

/**
 * Diretorios de Uploads
 */
$Config['upload']['image'] = "/public/uploads/img/";
$Config['cache_image'] = "/public/cache/img/";

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
$Config['ssl_verify'] = false;
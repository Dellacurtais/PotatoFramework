# MicroFramework
Projeto em desenvolvimento.

Framework em PHP, levei como inspiração do Codeigniter.
Umas das dificuldade com CodeIgniter em relação a falta de uso de namespace entre outros fatores me fez criar algo da minha maneira.
Primeiro feito para fins didáticos.

Não foi utilizado nenhuma estrutura do Codeigniter só para constar, apenas a librarie de Lang que levou pequenas modíficações.

Configurações gerais em:
App/Configs/Config.php

Criação de Rotas:
App/Configs/Routes.php
Ex:
$Routes['NotFound'] = [
    'Controller' => "\\Controller\\Error",
    "Method" => "NotFound",
    'Type' => "GET",
    'Headers' => [
        "HTTP/1.0 404 Not Found"
    ],
    'RequireHeader' => []
];

Pequeno ORM também desenvolvido por mim foi utilizado no projeto:
https://github.com/Dellacurtais/PHPDatabase

Template Egine:
Smarty
Twig (Ainda será implantado)
* Possíbilidade de não usar nenhum, com view diretamente no PHP será possível.






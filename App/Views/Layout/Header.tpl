<head lang="{$FastApp->getConfig("lang")}">
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    {if $smarty.capture.title}
        <title>{$smarty.capture.title}</title>
    {else}
        <title>{$FastApp->getConfig("name_project")}</title>
    {/if}

    <meta name="description" content="">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <link rel="shortcut icon" type="image/x-icon" href="{assets("potato/potato.svg")}">

    {if $smarty.capture.header_block}
        {$smarty.capture.header_block}
    {/if}
</head>
<body>

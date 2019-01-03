{*Meta Title*}
{capture name="title"}Potato Framework{/capture}

{*Implementar Cabeçalhos*}
{capture name="header_block"}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="{assets("potato/demo.css")}">
{/capture}

{*Logo do Menu*}
{capture name="logo_menu"}
{/capture}

{*Titulo da Página*}
{capture name="header_title_top"}
{/capture}

{*Titulo da Página*}
{capture name="header_title"}
{/capture}

{*Conteúdo*}
{capture name="content"}
    <!-- CONTENT HERE -->
    <div class="cover-container d-flex h-100 p-3 mx-auto flex-column">
        <header class="masthead mb-auto">
            <div class="inner">
                <h3 class="masthead-brand"><img src="{assets("potato/potato.svg")}" height="50px"></h3>
                <nav class="nav nav-masthead justify-content-center">
                    <a class="nav-link active" href="https://github.com/Dellacurtais/MicroFramework" target="_blank">GitHub</a>
                </nav>
            </div>
        </header>
        <main role="main" class="inner cover text-center">
            <h1 class="cover-heading">Potato Framework</h1>
            <p class="lead">PF is a Simple Framework build with PHP 7.x</p>
            <p class="lead">
                <a href="https://github.com/Dellacurtais/MicroFramework" class="btn btn-secondary" target="_blank">Documentation</a>
            </p>
        </main>
        <footer class="mastfoot mt-auto text-center">
            <div class="inner">
                <p>Template by <a href="https://getbootstrap.com/">Bootstrap</a>.</p>
            </div>
        </footer>
    </div>
{/capture}

{*Implementar Rodapé*}
{capture name="footer_block"}
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
{/capture}
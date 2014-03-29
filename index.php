<?php
    spl_autoload_extensions('.php');
    spl_autoload_register();

    use Core\App\Application;

    $app=new Application();

    $app->run();
?>
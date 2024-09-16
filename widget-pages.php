<?php

if (!function_exists('add_action')) {
    die('Nothing to do. Bye.');
}

function vws_plugin_pages()
{
    add_options_page(__("Video Widget Simple", 'vws'), __("Video Widget Simple", 'vws'), 'manage_options', 'video-widget', 'vws_main_page');
}

function vws_main_page()
{
    require_once VWS_DIR . "templates/content-main.php";
}

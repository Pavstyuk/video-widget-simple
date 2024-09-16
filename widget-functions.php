<?php

if (!function_exists('add_action')) {
    die('Nothing to do. Bye.');
}

function vws_scripts_admin($hook_suffix)
{
    if ($hook_suffix == "settings_page_video-widget") {
        wp_enqueue_script("vws-front", plugins_url("assets/admin/vws-admin.js", __FILE__), array(), VWS_VER, true);
        wp_enqueue_style("vws-front", plugins_url("assets/admin/vws-admin.css", __FILE__), VWS_VER);
    } else {
        return;
    }
}

function vws_scripts_front()
{
    echo "<script defer id='vws-front-js' src='" . get_site_url() . "/wp-content/plugins/video-widget-simple/assets/public/vws-front.min.js?ver=" . VWS_VER . "'></script>";
}

function vws_load_text_domain()
{
    load_plugin_textdomain('vws', false, dirname(plugin_basename(__FILE__)) . "/languages/");
}

function vws_add_settings()
{
    register_setting("vws_option_group", "vws_option_input_video");
    register_setting("vws_option_group", "vws_option_input_page");
    register_setting("vws_option_group", "vws_option_input_width");
    register_setting("vws_option_group", "vws_option_input_delay");
    register_setting("vws_option_group", "vws_option_input_color");

    add_settings_section(
        "vws-main-section",
        __("Choose Video File", "vws"),
        function () {
            echo "<p>" . __("Paste URL of video from media gallery in the field. Best way to use portrait oriented 720x1280px .mp4 video.", "vws") . "</p>";
        },
        "video-widget"
    );

    add_settings_field(
        "vws_option_input_video",
        __("Input URL", "vws"),
        function () {
            echo "<input id='vws_option_input_video' class='regular-text code' name='vws_option_input_video' type='url' value='" . esc_attr(get_option('vws_option_input_video')) . "' />";
        },
        "video-widget",
        "vws-main-section",
        array(
            "label_for" => "vws_option_input_video",
        ),
    );

    add_settings_field(
        "vws_option_input_page",
        __("Output Page", "vws"),
        function () {
            echo "<input id='vws_option_input_page' class='regular-text code' name='vws_option_input_page' type='text' value='" . esc_attr(get_option('vws_option_input_page')) . "' />";
            echo "<p>" . __("1. Leave blank to show on any page", "vws") . "<br>";
            echo __("2. Specify url of your home page to show on home page only", "vws") . "<br>";
            echo __("3. Specify url of any specific page of your site", "vws") . "</p>";
        },
        "video-widget",
        "vws-main-section",
        array(
            "label_for" => "vws_option_input_page",
        ),
    );

    add_settings_field(
        "vws_option_input_width",
        __("Video Width", "vws"),
        function () {
            echo "<input id='vws_option_input_width' class='regular-text code' name='vws_option_input_width' type='number' value='" . esc_attr(get_option('vws_option_input_width')) . "' />";
            echo "<p>" . __("Recommended width of video widget should be from 220px to 320px", "vws") . "</p>";
        },
        "video-widget",
        "vws-main-section",
        array(
            "label_for" => "vws_option_input_width",
        ),
    );

    add_settings_field(
        "vws_option_input_delay",
        __("Appearing delay, ms", "vws"),
        function () {
            echo "<input id='vws_option_input_delay' class='regular-text code' name='vws_option_input_delay' type='number' value='" . esc_attr(get_option('vws_option_input_delay')) . "' />";
            echo "<p>" . __("Delay of widget appearing. Try 2000ms", "vws") . "</p>";
        },
        "video-widget",
        "vws-main-section",
        array(
            "label_for" => "vws_option_input_delay",
        ),
    );

    add_settings_field(
        "vws_option_input_color",
        __("Border color", "vws"),
        function () {
            echo "<input id='vws_option_input_color' class='regular-text code' name='vws_option_input_color' type='color' value='" . esc_attr(get_option('vws_option_input_color')) . "' />";
            echo "<p>" . __("Border color of widget", "vws") . "</p>";
        },
        "video-widget",
        "vws-main-section",
        array(
            "label_for" => "vws_option_input_color",
        ),
    );
}

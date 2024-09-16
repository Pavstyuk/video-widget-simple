<?php

if ($_GET["key"] != "vws-video-widget-simple") die("Nothing to do. Bye");

require_once $_SERVER["DOCUMENT_ROOT"] . "/wp-load.php";

$video_url = esc_html(get_option("vws_option_input_video"));
$video_width = esc_html(get_option("vws_option_input_width"));
$video_delay = esc_html(get_option("vws_option_input_delay"));
$border_color = esc_html(get_option("vws_option_input_color"));
$page_url = esc_html(get_option("vws_option_input_page"));

$arr = array(
    "video" => $video_url,
    "width" => $video_width,
    "delay" => $video_delay,
    "color" => $border_color,
    "page" => $page_url
);

echo json_encode($arr);

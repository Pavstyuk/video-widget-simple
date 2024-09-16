<div class="wrap">
    <h1><?php _e('Video Widget Simple Settings', 'vws') ?></h1>
    <p><?php _e('Settings for Video Widget Simple. Copy URL of a video to display from media gallery. Set parameters.', 'vws') ?></p>

    <form action="options.php" method="post">
        <?php
        settings_fields("vws_option_group");
        do_settings_sections("video-widget");
        submit_button();
        ?>
    </form>

    <?php if (get_option("vws_option_input_video")) : ?>
        <h2><?php _e("Saved Options", "vws") ?></h2>
        <p>
            <b><?php _e("Video: ", "vws") ?></b> <?= esc_attr(get_option("vws_option_input_video")) ?><br>
            <b><?php _e("Page: ", "vws") ?></b> <?= esc_attr(get_option("vws_option_input_page")) ?><br>
            <b><?php _e("Width: ", "vws") ?></b> <?= esc_attr(get_option("vws_option_input_width")) ?><br>
            <b><?php _e("Border: ", "vws") ?></b> <?= esc_attr(get_option("vws_option_input_color")) ?><br>
            <b><?php _e("Delay: ", "vws") ?></b> <?= esc_attr(get_option("vws_option_input_delay")) ?>
        </p>

        <h2><?php _e("Example of your video in active state", "vws") ?></h2>
        <div class="vws-widget-wrap" style="border-color: <?= esc_attr(get_option("vws_option_input_color")) ?>">
            <video class="vws-widget-video" width="<?= esc_attr(get_option("vws_option_input_width")) ?>" autoplay muted controls>
                <source src="<?= esc_attr(get_option("vws_option_input_video")) ?>" type="video/mp4">
            </video>
        </div>
    <?php endif; ?>

</div>
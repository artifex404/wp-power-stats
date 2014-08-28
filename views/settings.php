<div class="wrap">

    <?php screen_icon() ?>
    <h2><?php echo esc_html($title); ?></h2>
    
    <form method="post" action="options.php">
    <?php settings_fields('wp-power-stats-settings'); ?>
    <?php do_settings_sections('wp-power-stats-settings'); ?>
    <?php submit_button() ?>
    </form>

</div>
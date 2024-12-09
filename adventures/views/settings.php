<div class="wrap">
    <h1>Adventures</h1>

    <form action="options.php" method="post">
        <?php 
        settings_fields(ADV__PLUGIN_SLUG);
        do_settings_sections(ADV__PLUGIN_SLUG);
        submit_button();
        ?>
    </form>
</div>

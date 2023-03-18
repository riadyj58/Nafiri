<?php
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly
?>
<div class="rivax-dashboard-wrapper">
    <div class="rivax-dashboard-header">
        <div class="rivax-dashboard-header-content">
            <?php
            $theme = wp_get_theme(); // For use with some settings. Not necessary.
            $theme = $theme->parent() ?: $theme;
            ?>
            <h1><?php esc_html_e('Welcome to Kayleen - Version ', 'kayleen'); echo esc_html($theme->get( 'Version' )); ?></h1>
            <p><?php esc_html_e('Thank you so much to join with Rivax Studio Family. Hope to enjoy the theme :)', 'kayleen'); ?></p>
            <p><?php esc_html_e('If you interested our theme, Please look at the our other themes on themeforest.', 'kayleen'); ?></p>
            <a class="rivax-dashboard-btn" href="https://1.envato.market/7m70Rd" target="_blank"><?php esc_html_e('Rivax Studio Themes', 'kayleen'); ?></a>
        </div>
        <div class="rivax-dashboard-header-logo">
            <a href="https://1.envato.market/7m70Rd" target="_blank">
                <img src="<?php echo get_template_directory_uri() . '/admin/assets/img/developer-logo.png'; ?>" alt="RivaxStudio">
                <span>RivaxStudio</span>
            </a>
        </div>
    </div>
    <div class="rivax-dashboard-body">
        <div class="rivax-dashboard-card">
            <div class="rivax-dashboard-card-inner card-1">
                <h3><?php esc_html_e('Step 1 : Install Required Plugins', 'kayleen'); ?></h3>
                <p><?php esc_html_e('Our theme has some required and optional plugins to function properly. Please install them.', 'kayleen'); ?></p>
                <a class="rivax-dashboard-btn" href="<?php echo esc_url(admin_url( 'themes.php?page=tgmpa-install-plugins' )); ?>"><?php esc_html_e('Install Plugins', 'kayleen'); ?></a>
            </div>
        </div>
        <div class="rivax-dashboard-card">
            <div class="rivax-dashboard-card-inner card-2">
                <h3><?php esc_html_e('Step 2 : Import Demo Content', 'kayleen'); ?></h3>
                <p><?php esc_html_e('Importing demo data (post, pages, images, theme settings, etc.) is the quickest and easiest way to set up your new theme.', 'kayleen'); ?></p>
                <a class="rivax-dashboard-btn" href="<?php echo esc_url(admin_url( 'admin.php?page=rivax-demo-importer' )); ?>"><?php esc_html_e('Import Demo', 'kayleen'); ?></a>
            </div>
        </div>
        <div class="rivax-dashboard-card">
            <div class="rivax-dashboard-card-inner card-3">
                <h3><?php esc_html_e('Step 3 : Read Theme Documentation', 'kayleen'); ?></h3>
                <p><?php esc_html_e('Follow our documentation and read the theme setup and configurations to learn how to use the theme.', 'kayleen'); ?></p>
                <a class="rivax-dashboard-btn" href="https://docs.rivaxstudio.com/kayleen/" target="_blank"><?php esc_html_e('Read Documentation', 'kayleen'); ?></a>
            </div>
        </div>
        <div class="rivax-dashboard-card">
            <div class="rivax-dashboard-card-inner card-4">
                <h3><?php esc_html_e('Step 4 : Need Any Help?', 'kayleen'); ?></h3>
                <p><?php esc_html_e('If you need any assistance, feel free to contact us and ask your question.', 'kayleen'); ?></p>
                <a class="rivax-dashboard-btn" href="https://1.envato.market/7m70Rd" target="_blank"><?php esc_html_e('Ask Question', 'kayleen'); ?></a>
            </div>
        </div>
    </div>
</div>


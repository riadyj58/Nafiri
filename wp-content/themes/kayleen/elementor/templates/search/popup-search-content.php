<div class="popup-search">
    <div class="popup-search-container">
        <span class="popup-search-closer"></span>
        <div class="popup-search-content">
            <div class="popup-search-title-wrapper">
                <h3><?php esc_html_e('Type and hit Enter to search', 'kayleen'); ?></h3>
            </div>
            <div class="popup-search-form-wrapper">
                <form action="<?php echo home_url('/'); ?>" method="get" class="popup-search-form">
                    <input type="text" name="s" value="" class="search-field" placeholder="<?php esc_html_e('Search ...', 'kayleen'); ?>" aria-label="Search" required>
                    <button type="submit" class="submit" aria-label="Submit">
                        <i class="ri-search-2-line"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

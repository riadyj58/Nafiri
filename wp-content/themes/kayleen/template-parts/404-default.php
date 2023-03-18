<?php
/**
 * Template part for displaying default page 404
 */
?>
<div class="container">
    <div class="page-content-wrapper">
        <div class="content-container">
            <div class="page-content page-404" >
                <h1>404</h1>
                <p>
                    <?php esc_html_e('Maaf, kami tidak dapat menemukan halaman yang Anda cari.', 'kayleen'); ?>
                    <a href="<?php echo home_url('/'); ?>"><?php esc_html_e('Kembali ke halaman utama', 'kayleen'); ?></a>
                </p>
            </div>
        </div>
    </div>
</div>

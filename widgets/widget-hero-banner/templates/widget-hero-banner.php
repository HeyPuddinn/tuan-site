<?php
if (!defined('ABSPATH')) exit; // Exit if accessed directly
?>

<div class="hero-banner-widget">
    <div class="hero-banner-container">
        <?php if (!empty($settings['avatar']['url'])): ?>
            <div class="hero-banner-avatar">
                <img src="<?php echo esc_url($settings['avatar']['url']); ?>" alt="<?php echo esc_attr($settings['name']); ?>">
                <div class="glitch__layers">
                    <div class="glitch__layer"></div>
                    <div class="glitch__layer"></div>
                    <div class="glitch__layer"></div>
                </div>
            </div>
        <?php endif; ?>
        
        <div class="hero-banner-content-wrapper">
            <?php if (!empty($settings['name'])): ?>
                <h2 class="hero-banner-name"><?php echo esc_html($settings['name']); ?></h2>
            <?php endif; ?>
            
            <?php if (!empty($settings['job_titles'])): ?>
                <div class="hero-banner-job-titles">
                    <?php echo esc_html($settings['job_titles']); ?>
                </div>
            <?php endif; ?>
            
            <?php if (!empty($settings['content'])): ?>
                <div class="hero-banner-content">
                    <?php echo wp_kses_post($settings['content']); ?>
                </div>
            <?php endif; ?>
            
            <?php if (!empty($settings['cv_pdf']['url']) && !empty($settings['button_text'])): ?>
                <div class="hero-banner-button">
                    <a href="<?php echo esc_url($settings['cv_pdf']['url']); ?>" download>
                        <?php echo esc_html($settings['button_text']); ?>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div> 
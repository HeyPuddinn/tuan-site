<?php
if (!defined('ABSPATH')) exit; // Exit if accessed directly
?>

<div class="portfolio-banner-widget">
    <div class="portfolio-banner-container">
        <div class="portfolio-banner-content">
            <div class="portfolio-banner-greeting">
                <?php echo esc_html($settings['greeting']); ?>
            </div>
            
            <div class="portfolio-banner-message-container">
                <div class="portfolio-banner-message">
                    <?php echo esc_html($settings['portfolio_message']); ?>
                </div>
                <div class="portfolio-banner-subtext">
                    <?php echo esc_html($settings['subtext']); ?>
                </div>
            </div>
        </div>
        
        <div class="portfolio-banner-footer">
            <div class="portfolio-banner-job-title">
                <?php echo esc_html($settings['job_title']); ?>
            </div>
            <div class="portfolio-banner-year">
                <?php echo esc_html($settings['year']); ?>
            </div>
        </div>
    </div>
</div> 
<?php
if (!defined('ABSPATH')) exit; // Exit if accessed directly
?>

<div class="portfolio-hero-widget">
    <div class="portfolio-hero-content">
        <div class="wrapper-welcome">
            <h1 class="portfolio-hero-welcome first" data-scroll><?php echo esc_html($settings['welcome_text']); ?></h1>
            <h1 class="portfolio-hero-welcome second" data-scroll><?php echo esc_html($settings['welcome_text']); ?></h1>
        </div>
        <div class="text-content">
            <div class="portfolio-text-container">
                <?php for($i = 0; $i < 4; $i++): ?>
                    <div class="portfolio-text" data-scroll data-scroll-delay="<?php echo $i * 0.2; ?>">
                        <?php echo esc_html($settings['portfolio_text']); ?>
                    </div>
                <?php endfor; ?>
            </div>
            <?php if ($settings['avatar']['url']): ?>
                <div class="portfolio-hero-avatar" data-scroll>
                    <img src="<?php echo esc_url($settings['avatar']['url']); ?>" 
                         alt="Portfolio Avatar">
                </div>
            <?php endif; ?>
        </div>
    </div>
</div> 
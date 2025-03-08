<?php
/**
 * Template for We Make Art Widget
 * 
 * @package HelloElementor
 * @subpackage Widgets
 * @since 1.0.0
 */

if (!defined('ABSPATH')) exit; // Exit if accessed directly
?>

<div class="widget-we-make-art">
    <div class="content-section">
        <?php if ($settings['title']) : ?>
            <h2 class="widget-title"><?php echo esc_html($settings['title']); ?></h2>
        <?php endif; ?>
        
        <?php if ($settings['main_description']) : ?>
            <div class="widget-description">
                <?php echo wp_kses_post($settings['main_description']); ?>
            </div>
        <?php endif; ?>
        
        <?php if ($settings['secondary_description']) : ?>
            <div class="widget-description secondary">
                <?php echo wp_kses_post($settings['secondary_description']); ?>
            </div>
        <?php endif; ?>

        <?php if ($settings['button_text']) : ?>
            <a class="widget-button" 
               href="<?php echo esc_url($settings['button_link']['url']); ?>"
               <?php echo $settings['button_link']['is_external'] ? 'target="_blank"' : ''; ?>
               <?php echo $settings['button_link']['nofollow'] ? 'rel="nofollow"' : ''; ?>>
                <?php echo esc_html($settings['button_text']); ?>
            </a>
        <?php endif; ?>
    </div>

    <?php if ($settings['gallery']) : ?>
        <div class="widget-gallery">
            <?php foreach ($settings['gallery'] as $image) : ?>
                <div class="gallery-item">
                    <img src="<?php echo esc_url($image['url']); ?>" 
                         alt="<?php echo esc_attr($image['alt']); ?>">
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div> 
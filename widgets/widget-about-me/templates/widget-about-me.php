<?php
if (!defined('ABSPATH')) exit; // Exit if accessed directly
?>

<div class="about-me-widget">
    <div class="about-me-container">
        <h2 class="about-me-title">ABOUT ME ?</h2>
        
        <div class="about-me-content-wrapper">
            <div class="about-me-content" 
                 data-initial-color="<?php echo esc_attr($settings['initial_text_color']); ?>"
                 data-animated-color="<?php echo esc_attr($settings['animated_text_color']); ?>">
                <?php echo wp_kses_post($settings['about_me_content']); ?>
            </div>
            
            <?php if ($settings['profile_image']['url']): ?>
                <div class="about-me-image">
                    <img src="<?php echo esc_url($settings['profile_image']['url']); ?>" 
                         alt="Profile Image">
                </div>
            <?php endif; ?>
        </div>
    </div>
</div> 
<?php
if (!defined('ABSPATH')) exit; // Exit if accessed directly
?>

<div class="companies-widget">
    <div class="companies-container">
        <div class="companies-title">
            <h2><?php echo esc_html($settings['widget_title']); ?></h2>
        </div>
        <div class="companies-logos-container">
            <div class="companies-logos">
                <?php foreach ($settings['company_items'] as $item) : ?>
                    <div class="company-logo">
                        <?php 
                        $target = $item['company_url']['is_external'] ? ' target="_blank"' : '';
                        $nofollow = $item['company_url']['nofollow'] ? ' rel="nofollow"' : '';
                        
                        if (!empty($item['company_url']['url'])) : ?>
                            <a href="<?php echo esc_url($item['company_url']['url']); ?>"<?php echo $target . $nofollow; ?>>
                        <?php endif; ?>
                        
                        <?php if (!empty($item['company_logo']['url'])) : ?>
                            <img src="<?php echo esc_url($item['company_logo']['url']); ?>" alt="<?php echo esc_attr($item['company_name']); ?>">
                        <?php endif; ?>
                        
                        <?php if (!empty($item['company_url']['url'])) : ?>
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div> 
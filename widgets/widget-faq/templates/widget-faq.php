<?php
if (!defined('ABSPATH')) exit; // Exit if accessed directly
?>

<div class="faq-widget">
    <div class="faq-container">
      <div class="faq-title">
        <h2><?php echo esc_html($settings['widget_title']); ?></h2>
      </div>
        <?php foreach ($settings['faq_items'] as $index => $item) : ?>
            <div class="faq-item" data-item-id="<?php echo esc_attr($index); ?>">
                <div class="faq-item-title">
                    <?php echo esc_html($item['faq_title']); ?>
                </div>
                <div class="faq-item-content" style="display: none;">
                    <?php echo wp_kses_post($item['faq_content']); ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div> 
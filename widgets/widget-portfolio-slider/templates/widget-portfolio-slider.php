<?php
if (!defined('ABSPATH')) exit; // Exit if accessed directly
?>

<div class="portfolio-slider-widget">
    <div class="portfolio-container">
        <div class="portfolio-header">
            <div class="portfolio-title">
                <h2><?php echo esc_html($settings['widget_title']); ?></h2>
            </div>
            <?php if (!empty($settings['view_all_link']['url'])) : ?>
                <div class="portfolio-view-all">
                    <a href="<?php echo esc_url($settings['view_all_link']['url']); ?>"
                       <?php echo $settings['view_all_link']['is_external'] ? 'target="_blank"' : ''; ?>
                       <?php echo $settings['view_all_link']['nofollow'] ? 'rel="nofollow"' : ''; ?>>
                        <?php echo esc_html($settings['view_all_text']); ?>
                    </a>
                </div>
            <?php endif; ?>
        </div>
        <div class="portfolio-subtitle">
            <?php echo esc_html($settings['subtitle']); ?>
        </div>
        
        <div class="portfolio-slider-container">
            <div class="swiper-container portfolio-slider"
                 data-slides-desktop="<?php echo esc_attr($settings['slides_per_view'] ?? 3); ?>"
                 data-slides-tablet="<?php echo esc_attr($settings['slides_per_view_tablet'] ?? 2); ?>"
                 data-slides-mobile="<?php echo esc_attr($settings['slides_per_view_mobile'] ?? 1); ?>"
                 data-space-between="<?php echo esc_attr($settings['space_between']['size'] ?? 20); ?>">
                <div class="swiper-wrapper">
                    <?php foreach ($settings['portfolio_items'] as $index => $item) : ?>
                        <div class="swiper-slide portfolio-slide">
                            <div class="portfolio-slide-image">
                                <?php if (!empty($item['portfolio_image']['url'])) : ?>
                                    <img src="<?php echo esc_url($item['portfolio_image']['url']); ?>" alt="<?php echo esc_attr($item['portfolio_title']); ?>">
                                <?php else : ?>
                                    <div class="placeholder-image"></div>
                                <?php endif; ?>
                                
                                <?php if (!empty($settings['show_branding']) && $settings['show_branding'] === 'yes') : ?>
                                <div class="portfolio-branding">
                                    <span class="branding-text"><?php echo esc_html($settings['branding_text'] ?? 'Brand'); ?></span>
                                </div>
                                <?php endif; ?>
                                
                                <div class="portfolio-hover-overlay">
                                    <div class="portfolio-content">
                                        <div class="portfolio-group-title">
                                            <h3 class="portfolio-item-title"><?php echo esc_html($item['portfolio_title']); ?></h3>
                                            <?php if (!empty($item['portfolio_tags'])) : ?>
                                                <div class="portfolio-item-tags"><?php echo esc_html($item['portfolio_tags']); ?></div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="portfolio-item-icons">
                                            <?php if (!empty($item['portfolio_link']['url'])) : ?>
                                                <a href="<?php echo esc_url($item['portfolio_link']['url']); ?>" 
                                                   class="portfolio-icon-link"
                                                   <?php echo (!empty($item['portfolio_link']['is_external'])) ? 'target="_blank"' : ''; ?>>
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                        <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                    </svg>
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            
            <div class="portfolio-slider-navigation">
                <div class="portfolio-pagination">
                    <span class="current">01</span>
                    <div class="progress-container">
                        <div class="progress-bar"></div>
                    </div>
                    <span class="total"><?php echo count($settings['portfolio_items']) < 10 ? '0' . count($settings['portfolio_items']) : count($settings['portfolio_items']); ?></span>
                </div>
                <div class="portfolio-nav-arrows">
                    <div class="portfolio-nav-arrow portfolio-prev">←</div>
                    <div class="portfolio-nav-arrow portfolio-next">→</div>
                </div>
            </div>
        </div>
    </div>
</div> 
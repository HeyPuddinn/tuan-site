<?php
if (!defined('ABSPATH')) exit; // Exit if accessed directly
?>

<div class="portfolio-project-widget">
    <div class="portfolio-project-header">
        <h2 class="portfolio-project-title"><?php echo esc_html($settings['title']); ?></h2>
        <p class="portfolio-project-description"><?php echo esc_html($settings['description']); ?></p>
    </div>
    
    <div class="portfolio-project-filters">
        <?php if ('yes' === $settings['show_all_button']) : ?>
            <button class="portfolio-project-filter-button active" data-filter="all"><?php echo esc_html($settings['all_button_text']); ?></button>
        <?php endif; ?>
        
        <?php foreach ($settings['filters'] as $filter) : ?>
            <button class="portfolio-project-filter-button" data-filter="<?php echo esc_attr($filter['filter_slug']); ?>">
                <?php echo esc_html($filter['filter_name']); ?>
            </button>
        <?php endforeach; ?>
    </div>
    
    <div class="portfolio-project-grid">
        <?php foreach ($settings['projects'] as $index => $project) : 
            $filter_classes = '';
            if (!empty($project['filter_categories'])) {
                foreach ($project['filter_categories'] as $category) {
                    $filter_classes .= ' ' . $category;
                }
            }
            
            $project_url = !empty($project['project_link']['url']) ? $project['project_link']['url'] : '#';
            $target = !empty($project['project_link']['is_external']) ? ' target="_blank"' : '';
            $nofollow = !empty($project['project_link']['nofollow']) ? ' rel="nofollow"' : '';
            
            // Add has-nav class if navigation is enabled for this project
            $extra_class = ('yes' === $project['show_navigation']) ? ' has-nav' : '';
        ?>
        
        <div class="portfolio-project-item<?php echo esc_attr($filter_classes . $extra_class); ?>" data-filter-categories="<?php echo esc_attr(trim($filter_classes)); ?>">
            <a href="<?php echo esc_url($project_url); ?>"<?php echo $target . $nofollow; ?>>
                <div class="portfolio-project-image">
                    <?php if (!empty($project['project_image']['url'])) : ?>
                        <img src="<?php echo esc_url($project['project_image']['url']); ?>" alt="<?php echo esc_attr($project['project_title']); ?>">
                    <?php endif; ?>
                    
                    <div class="portfolio-project-overlay">
                        <div class="portfolio-project-content">
                            <h3 class="portfolio-project-title-overlay"><?php echo esc_html($project['project_title']); ?></h3>
                            <div class="portfolio-project-type"><?php echo esc_html($project['project_type']); ?></div>
                        </div>
                    </div>
                </div>
            </a>
            
            <!-- Project action buttons -->
            <?php if ('yes' === $settings['show_action_buttons']) : ?>
                <div class="portfolio-project-actions">
                    <?php if ('yes' === $settings['show_view_button']) : ?>
                        <a href="<?php echo esc_url($project_url); ?>" class="action-button view-project"<?php echo $target . $nofollow; ?>>
                            <i class="fas fa-eye"></i>
                        </a>
                    <?php endif; ?>
                    <?php if ('yes' === $settings['show_link_button']) : ?>
                        <a href="<?php echo esc_url($project_url); ?>" class="action-button project-link"<?php echo $target . $nofollow; ?>>
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    </svg>
                        </a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            
            <?php if ('yes' === $project['show_navigation'] && 'yes' === $settings['show_arrows']) : ?>
                <div class="portfolio-project-nav">
                    <div class="nav-button prev"><i class="fas fa-chevron-left"></i></div>
                    <div class="nav-button next"><i class="fas fa-chevron-right"></i></div>
                </div>
            <?php endif; ?>
            
            <?php if ('yes' === $project['show_navigation'] && 'yes' === $settings['show_dots']) : ?>
                <div class="portfolio-project-dots">
                    <?php for ($i = 0; $i < $settings['dots_count']; $i++) : ?>
                        <div class="dot<?php echo ($i === 0) ? ' active' : ''; ?>"></div>
                    <?php endfor; ?>
                </div>
            <?php endif; ?>
        </div>
        
        <?php endforeach; ?>
    </div>
</div> 
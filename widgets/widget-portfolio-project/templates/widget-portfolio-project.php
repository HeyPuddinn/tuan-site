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
            
            // Add media type class
            $media_type = !empty($project['media_type']) ? $project['media_type'] : 'image';
            $extra_class .= ' media-' . $media_type;
        ?>
        
        <div class="portfolio-project-item<?php echo esc_attr($filter_classes . $extra_class); ?>" data-filter-categories="<?php echo esc_attr(trim($filter_classes)); ?>" data-media-type="<?php echo esc_attr($media_type); ?>">
            <a href="<?php echo esc_url($project_url); ?>"<?php echo $target . $nofollow; ?>>
                <div class="portfolio-project-image">
                    <?php
                    // Display proper media based on type
                    switch ($media_type) {
                        case 'image':
                            if (!empty($project['project_image']['url'])) : ?>
                                <img src="<?php echo esc_url($project['project_image']['url']); ?>" alt="<?php echo esc_attr($project['project_title']); ?>">
                            <?php endif;
                            break;
                            
                        case 'youtube':
                            $youtube_id = $this->get_youtube_id($project['youtube_url']);
                            if (!empty($youtube_id)) : ?>
                                <div class="video-background">
                                    <iframe src="https://www.youtube.com/embed/<?php echo esc_attr($youtube_id); ?>?autoplay=1&mute=1&loop=1&playlist=<?php echo esc_attr($youtube_id); ?>&controls=0&showinfo=0" frameborder="0" allow="accelerometer; autoplay; loop; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                </div>
                            <?php endif;
                            break;
                            
                        case 'vimeo':
                            $vimeo_id = $this->get_vimeo_id($project['vimeo_url']);
                            if (!empty($vimeo_id)) : ?>
                                <div class="video-background">
                                    <iframe src="https://player.vimeo.com/video/<?php echo esc_attr($vimeo_id); ?>?autoplay=1&loop=1&background=1" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
                                </div>
                            <?php endif;
                            break;
                            
                        case 'mp4':
                            if (!empty($project['mp4_url']['url'])) : ?>
                                <div class="video-background">
                                    <video autoplay muted loop playsinline>
                                        <source src="<?php echo esc_url($project['mp4_url']['url']); ?>" type="video/mp4">
                                    </video>
                                </div>
                            <?php endif;
                            break;
                    }
                    ?>
                    
                    <?php if (!empty($settings['show_branding']) && $settings['show_branding'] === 'yes') : ?>
                    <div class="portfolio-branding">
                        <span class="branding-text"><?php echo esc_html($settings['branding_text'] ?? 'Brand'); ?></span>
                    </div>
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
                    
                    <!-- Add new view button for popup gallery -->
                    <a href="javascript:void(0)" class="action-button view-gallery" data-index="<?php echo esc_attr($index); ?>">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 12C1 12 5 4 12 4C19 4 23 12 23 12C23 12 19 20 12 20C5 20 1 12 1 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M12 15C13.6569 15 15 13.6569 15 12C15 10.3431 13.6569 9 12 9C10.3431 9 9 10.3431 9 12C9 13.6569 10.3431 15 12 15Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                    
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

<!-- Popup Gallery -->
<div class="portfolio-project-popup">
    <div class="popup-overlay"></div>
    <div class="popup-container">
        <div class="popup-close">&times;</div>
        
        <div class="swiper portfolio-swiper">
            <div class="swiper-wrapper">
                <?php foreach ($settings['projects'] as $index => $project) : 
                    $media_type = !empty($project['media_type']) ? $project['media_type'] : 'image';
                ?>
                    <div class="swiper-slide" data-media-type="<?php echo esc_attr($media_type); ?>">
                        <div class="popup-slide-content">
                            <?php
                            switch ($media_type) {
                                case 'image':
                                    if (!empty($project['project_image']['url'])) : ?>
                                        <img src="<?php echo esc_url($project['project_image']['url']); ?>" alt="<?php echo esc_attr($project['project_title']); ?>">
                                    <?php endif;
                                    break;

                                case 'youtube':
                                    $youtube_id = $this->get_youtube_id($project['youtube_url']);
                                    if (!empty($youtube_id)) : ?>
                                        <div class="video-wrapper youtube-video">
                                            <iframe src="https://www.youtube.com/embed/<?php echo esc_attr($youtube_id); ?>?autoplay=0&rel=0" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                        </div>
                                    <?php endif;
                                    break;

                                case 'vimeo':
                                    $vimeo_id = $this->get_vimeo_id($project['vimeo_url']);
                                    if (!empty($vimeo_id)) : ?>
                                        <div class="video-wrapper vimeo-video">
                                            <iframe src="https://player.vimeo.com/video/<?php echo esc_attr($vimeo_id); ?>" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
                                        </div>
                                    <?php endif;
                                    break;

                                case 'mp4':
                                    if (!empty($project['mp4_url']['url'])) : ?>
                                        <div class="video-wrapper mp4-video">
                                            <video controls>
                                                <source src="<?php echo esc_url($project['mp4_url']['url']); ?>" type="video/mp4">
                                                <?php _e('Your browser does not support the video tag.', 'hello-elementor'); ?>
                                            </video>
                                        </div>
                                    <?php endif;
                                    break;
                            }
                            ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <div class="swiper-pagination"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    </div>
</div>
</div> 
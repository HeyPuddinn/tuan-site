<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

$projects = [];
if (!empty($settings['projects_posts'])) {
    $projects = get_posts([
        'post_type' => 'post',
        'post__in' => $settings['projects_posts'],
        'posts_per_page' => -1,
        'orderby' => 'post__in',
    ]);
}

$gallery_items = [];
if (!empty($settings['gallery_posts'])) {
    $gallery_items = get_posts([
        'post_type' => 'gallery',
        'post__in' => $settings['gallery_posts'],
        'posts_per_page' => -1,
        'orderby' => 'post__in',
    ]);
}
?>

<div class="portfolio-masonry-container">
    <div class="tabs-container">
        <div class="tabs-wrapper" id="stickyTabs">
            <div class="tabs">
                <button class="tab-btn active" data-tab="projects"><?php echo esc_html__('Projects', 'hello-elementor-widgets'); ?></button>
                <button class="tab-btn" data-tab="gallery"><?php echo esc_html__('Gallery', 'hello-elementor-widgets'); ?></button>
            </div>
        </div>
        
        <div class="tab-spacer"></div>
        
        <!-- Projects Tab Content -->
        <div id="projects" class="tab-content active">
            <div class="projects-container">
                <?php foreach ($projects as $index => $project) : 
                    $thumbnail = get_the_post_thumbnail_url($project->ID, 'full');
                    if (!$thumbnail) {
                        continue;
                    }
                ?>
                    <div class="project-card" animation-item="<?php echo esc_attr($index * 50); ?>">
                        <div class="project-img-wrapper">
                            <img src="<?php echo esc_url($thumbnail); ?>" alt="<?php echo esc_attr($project->post_title); ?>" class="project-img">
                        </div>
                        <div class="project-info">
                            <h3 class="project-title"><?php echo esc_html($project->post_title); ?></h3>
                            <p class="project-desc"><?php echo wp_trim_words($project->post_excerpt ?: $project->post_content, 20); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="projects-end-trigger"></div>
        </div>
        
        <!-- Gallery Tab Content -->
        <div id="gallery" class="tab-content">
            <div class="masonry-grid" id="gallery-grid">
                <?php 
                $sizes = ['size-1x1', 'size-2x2', 'size-1x1', 'size-1x2', 'size-2x1', 'size-1x1', 'size-3x2'];
                foreach ($gallery_items as $index => $item) :
                    $thumbnail = get_the_post_thumbnail_url($item->ID, 'full');
                    if (!$thumbnail) {
                        continue;
                    }
                    $size = $sizes[$index % count($sizes)];
                ?>
                    <div class="masonry-item <?php echo esc_attr($size); ?>">
                        <img src="<?php echo esc_url($thumbnail); ?>" alt="<?php echo esc_attr($item->post_title); ?>" data-index="<?php echo esc_attr($index); ?>">
                        <?php if ($item->post_title) : ?>
                            <div class="item-text">
                                <h3><?php echo esc_html($item->post_title); ?></h3>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<!-- Modal with Swiper -->
<div id="imageModal" class="modal">
    <span class="close" id="closeModal">&times;</span>
    <div class="modal-content">
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                <?php foreach ($gallery_items as $index => $item) :
                    $thumbnail = get_the_post_thumbnail_url($item->ID, 'full');
                    if (!$thumbnail) {
                        continue;
                    }
                ?>
                    <div class="swiper-slide" data-index="<?php echo esc_attr($index); ?>">
                        <img src="<?php echo esc_url($thumbnail); ?>" alt="<?php echo esc_attr($item->post_title); ?>">
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
</div> 
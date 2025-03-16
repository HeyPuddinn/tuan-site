<?php
namespace HelloElementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Widget_Portfolio_Masonry extends Widget_Base {

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);

        // Register scripts
        wp_register_script(
            'gsap',
            'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js',
            [],
            '3.12.2',
            true
        );

        wp_register_script(
            'scrolltrigger',
            'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js',
            ['gsap'],
            '3.12.2',
            true
        );

        wp_register_script(
            'swiper',
            'https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js',
            [],
            '10.0.0',
            true
        );

        wp_register_style(
            'swiper',
            'https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css',
            [],
            '10.0.0'
        );

        wp_register_script(
            'widget-portfolio-masonry-script',
            plugins_url('/assets/js/widget-portfolio-masonry.js', __FILE__),
            ['jquery', 'gsap', 'scrolltrigger', 'swiper'],
            '1.0.0',
            true
        );

        wp_register_style(
            'widget-portfolio-masonry-style',
            plugins_url('/assets/css/widget-portfolio-masonry.css', __FILE__),
            ['swiper'],
            '1.0.0'
        );
    }

    public function get_name() {
        return 'portfolio-masonry';
    }

    public function get_title() {
        return esc_html__('Portfolio Masonry Gallery', 'hello-elementor-widgets');
    }

    public function get_icon() {
        return 'eicon-gallery-grid';
    }

    public function get_categories() {
        return ['hello-elementor-widgets'];
    }

    public function get_script_depends() {
        return [
            'gsap',
            'scrolltrigger',
            'swiper',
            'widget-portfolio-masonry-script'
        ];
    }

    public function get_style_depends() {
        return [
            'swiper',
            'widget-portfolio-masonry-style'
        ];
    }

    protected function register_controls() {
        // Projects Tab Section
        $this->start_controls_section(
            'section_projects',
            [
                'label' => esc_html__('Projects Tab', 'hello-elementor-widgets'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'projects_posts',
            [
                'label' => esc_html__('Select Projects', 'hello-elementor-widgets'),
                'type' => Controls_Manager::SELECT2,
                'options' => $this->get_posts('post'),
                'multiple' => true,
                'label_block' => true,
            ]
        );

        $this->end_controls_section();

        // Gallery Tab Section
        $this->start_controls_section(
            'section_gallery',
            [
                'label' => esc_html__('Gallery Tab', 'hello-elementor-widgets'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'gallery_posts',
            [
                'label' => esc_html__('Select Gallery Items', 'hello-elementor-widgets'),
                'type' => Controls_Manager::SELECT2,
                'options' => $this->get_posts('gallery'),
                'multiple' => true,
                'label_block' => true,
            ]
        );

        $this->end_controls_section();

        // Style Tab
        $this->start_controls_section(
            'section_style_tabs',
            [
                'label' => esc_html__('Tabs Style', 'hello-elementor-widgets'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'tabs_background_color',
            [
                'label' => esc_html__('Tabs Background Color', 'hello-elementor-widgets'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tabs-wrapper' => 'background-color: {{VALUE}};',
                ],
                'default' => '#121212',
            ]
        );

        $this->add_control(
            'tab_text_color',
            [
                'label' => esc_html__('Tab Text Color', 'hello-elementor-widgets'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tab-btn' => 'color: {{VALUE}};',
                ],
                'default' => '#999',
            ]
        );

        $this->add_control(
            'tab_active_color',
            [
                'label' => esc_html__('Active Tab Color', 'hello-elementor-widgets'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tab-btn.active' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .tab-btn.active:after' => 'background-color: {{VALUE}};',
                ],
                'default' => '#ff5252',
            ]
        );

        $this->end_controls_section();

        // Project Cards Style
        $this->start_controls_section(
            'section_style_projects',
            [
                'label' => esc_html__('Project Cards Style', 'hello-elementor-widgets'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'project_title_typography',
                'label' => esc_html__('Title Typography', 'hello-elementor-widgets'),
                'selector' => '{{WRAPPER}} .project-title',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'project_desc_typography',
                'label' => esc_html__('Description Typography', 'hello-elementor-widgets'),
                'selector' => '{{WRAPPER}} .project-desc',
            ]
        );

        $this->end_controls_section();

        // Gallery Items Style
        $this->start_controls_section(
            'section_style_gallery',
            [
                'label' => esc_html__('Gallery Items Style', 'hello-elementor-widgets'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'gallery_item_border_radius',
            [
                'label' => esc_html__('Border Radius', 'hello-elementor-widgets'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .masonry-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'gallery_item_box_shadow',
                'selector' => '{{WRAPPER}} .masonry-item',
            ]
        );

        $this->end_controls_section();
    }

    private function get_posts($post_type) {
        $posts = get_posts([
            'post_type' => $post_type,
            'posts_per_page' => -1,
            'post_status' => 'publish',
        ]);

        $options = [];
        foreach ($posts as $post) {
            $options[$post->ID] = $post->post_title;
        }

        return $options;
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        
        // Include the template file
        include __DIR__ . '/templates/template.php';
    }
} 
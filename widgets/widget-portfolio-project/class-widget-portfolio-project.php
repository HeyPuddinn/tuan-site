<?php
namespace HelloElementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;
use Elementor\Repeater;
use Elementor\Utils;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Widget_Portfolio_Project extends Widget_Base {
    public function get_name() {
        return 'widget-portfolio-project';
    }

    public function get_title() {
        return __('Portfolio Projects', 'hello-elementor');
    }

    public function get_icon() {
        return 'eicon-gallery-grid';
    }

    public function get_categories() {
        return ['general'];
    }

    public function get_script_depends() {
        return ['elementor-swiper', 'widget-portfolio-project-script'];
    }

    public function get_style_depends() {
        return ['elementor-swiper', 'widget-portfolio-project-style'];
    }

    protected function register_controls() {
        // Content Section - Title
        $this->start_controls_section(
            'section_title',
            [
                'label' => __('Title', 'hello-elementor'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __('Title', 'hello-elementor'),
                'type' => Controls_Manager::TEXT,
                'default' => __('The Projects', 'hello-elementor'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => __('Description', 'hello-elementor'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'hello-elementor'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'branding_text',
            [
                'label' => __('Branding Text', 'hello-elementor'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Brand', 'hello-elementor'),
                'label_block' => true,
                'description' => __('Text displayed in the left corner of each portfolio item', 'hello-elementor'),
            ]
        );

        $this->add_control(
            'show_branding',
            [
                'label' => __('Show Branding', 'hello-elementor'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'hello-elementor'),
                'label_off' => __('Hide', 'hello-elementor'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->end_controls_section();

        // Content Section - Filter Buttons
        $this->start_controls_section(
            'section_filter_buttons',
            [
                'label' => __('Filter Buttons', 'hello-elementor'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'show_all_button',
            [
                'label' => __('Show All Button', 'hello-elementor'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'hello-elementor'),
                'label_off' => __('Hide', 'hello-elementor'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'all_button_text',
            [
                'label' => __('All Button Text', 'hello-elementor'),
                'type' => Controls_Manager::TEXT,
                'default' => __('All', 'hello-elementor'),
                'condition' => [
                    'show_all_button' => 'yes',
                ],
            ]
        );

        $filter_repeater = new Repeater();

        $filter_repeater->add_control(
            'filter_name',
            [
                'label' => __('Filter Name', 'hello-elementor'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Filter', 'hello-elementor'),
                'label_block' => true,
            ]
        );

        $filter_repeater->add_control(
            'filter_slug',
            [
                'label' => __('Filter Slug', 'hello-elementor'),
                'type' => Controls_Manager::TEXT,
                'default' => __('filter', 'hello-elementor'),
                'description' => __('Lowercase letters and hyphens only', 'hello-elementor'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'filters',
            [
                'label' => __('Filter Buttons', 'hello-elementor'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $filter_repeater->get_controls(),
                'default' => [
                    [
                        'filter_name' => __('Design', 'hello-elementor'),
                        'filter_slug' => 'design',
                    ],
                    [
                        'filter_name' => __('Print', 'hello-elementor'),
                        'filter_slug' => 'print',
                    ],
                    [
                        'filter_name' => __('Logo', 'hello-elementor'),
                        'filter_slug' => 'logo',
                    ],
                    [
                        'filter_name' => __('Marketing', 'hello-elementor'),
                        'filter_slug' => 'marketing',
                    ],
                    [
                        'filter_name' => __('Social Media', 'hello-elementor'),
                        'filter_slug' => 'social-media',
                    ],
                    [
                        'filter_name' => __('Web Design', 'hello-elementor'),
                        'filter_slug' => 'web-design',
                    ],
                    [
                        'filter_name' => __('Video', 'hello-elementor'),
                        'filter_slug' => 'video',
                    ],
                ],
                'title_field' => '{{{ filter_name }}}',
            ]
        );

        $this->end_controls_section();

        // Content Section - Projects
        $this->start_controls_section(
            'section_projects',
            [
                'label' => __('Projects', 'hello-elementor'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $project_repeater = new Repeater();

        $project_repeater->add_control(
            'project_title',
            [
                'label' => __('Project Title', 'hello-elementor'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Project Title', 'hello-elementor'),
                'label_block' => true,
            ]
        );

        $project_repeater->add_control(
            'project_type',
            [
                'label' => __('Project Type', 'hello-elementor'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Website, Logo', 'hello-elementor'),
                'label_block' => true,
            ]
        );

        $project_repeater->add_control(
            'media_type',
            [
                'label' => __('Media Type', 'hello-elementor'),
                'type' => Controls_Manager::SELECT,
                'default' => 'image',
                'options' => [
                    'image' => __('Image', 'hello-elementor'),
                    'youtube' => __('YouTube Video', 'hello-elementor'),
                    'vimeo' => __('Vimeo Video', 'hello-elementor'),
                    'mp4' => __('MP4 Video', 'hello-elementor'),
                ],
                'label_block' => true,
            ]
        );

        $project_repeater->add_control(
            'project_image',
            [
                'label' => __('Project Image', 'hello-elementor'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'media_type' => 'image',
                ],
            ]
        );

        $project_repeater->add_control(
            'youtube_url',
            [
                'label' => __('YouTube URL', 'hello-elementor'),
                'type' => Controls_Manager::TEXT,
                'placeholder' => __('https://www.youtube.com/watch?v=XXXXXXXXX', 'hello-elementor'),
                'default' => '',
                'label_block' => true,
                'condition' => [
                    'media_type' => 'youtube',
                ],
            ]
        );

        $project_repeater->add_control(
            'vimeo_url',
            [
                'label' => __('Vimeo URL', 'hello-elementor'),
                'type' => Controls_Manager::TEXT,
                'placeholder' => __('https://vimeo.com/XXXXXXXXX', 'hello-elementor'),
                'default' => '',
                'label_block' => true,
                'condition' => [
                    'media_type' => 'vimeo',
                ],
            ]
        );

        $project_repeater->add_control(
            'mp4_url',
            [
                'label' => __('MP4 Video URL', 'hello-elementor'),
                'type' => Controls_Manager::MEDIA,
                'media_type' => 'video',
                'default' => [
                    'url' => '',
                ],
                'description' => __('Upload or select MP4 video file', 'hello-elementor'),
                'condition' => [
                    'media_type' => 'mp4',
                ],
            ]
        );
        
        $project_repeater->add_control(
            'show_navigation',
            [
                'label' => __('Show Navigation', 'hello-elementor'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'hello-elementor'),
                'label_off' => __('No', 'hello-elementor'),
                'return_value' => 'yes',
                'default' => 'no',
                'description' => __('Enable navigation arrows and dots', 'hello-elementor'),
            ]
        );

        $project_repeater->add_control(
            'filter_categories',
            [
                'label' => __('Filter Categories', 'hello-elementor'),
                'type' => Controls_Manager::SELECT2,
                'options' => [
                    'design' => __('Design', 'hello-elementor'),
                    'print' => __('Print', 'hello-elementor'),
                    'logo' => __('Logo', 'hello-elementor'),
                    'marketing' => __('Marketing', 'hello-elementor'),
                    'social-media' => __('Social Media', 'hello-elementor'),
                    'web-design' => __('Web Design', 'hello-elementor'),
                    'video' => __('Video', 'hello-elementor'),
                ],
                'multiple' => true,
                'label_block' => true,
            ]
        );

        $project_repeater->add_control(
            'project_link',
            [
                'label' => __('Project Link', 'hello-elementor'),
                'type' => Controls_Manager::URL,
                'placeholder' => __('https://your-link.com', 'hello-elementor'),
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => '#',
                    'is_external' => false,
                    'nofollow' => false,
                ],
                'label_block' => true,
            ]
        );

        $this->add_control(
            'projects',
            [
                'label' => __('Projects', 'hello-elementor'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $project_repeater->get_controls(),
                'default' => [
                    [
                        'project_title' => __('Project 1', 'hello-elementor'),
                        'project_type' => __('Web Design', 'hello-elementor'),
                        'filter_categories' => ['web-design', 'design'],
                        'show_navigation' => 'no',
                    ],
                    [
                        'project_title' => __('Web Project', 'hello-elementor'),
                        'project_type' => __('Website, Logo', 'hello-elementor'),
                        'filter_categories' => ['web-design', 'logo'],
                        'show_navigation' => 'yes',
                    ],
                    [
                        'project_title' => __('Packaging', 'hello-elementor'),
                        'project_type' => __('Packaging Design', 'hello-elementor'),
                        'filter_categories' => ['print', 'design'],
                        'show_navigation' => 'no',
                    ],
                ],
                'title_field' => '{{{ project_title }}}',
            ]
        );

        $this->end_controls_section();

        // Navigation Options
        $this->start_controls_section(
            'section_navigation',
            [
                'label' => __('Navigation Options', 'hello-elementor'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'show_action_buttons',
            [
                'label' => __('Show Action Buttons', 'hello-elementor'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'hello-elementor'),
                'label_off' => __('Hide', 'hello-elementor'),
                'return_value' => 'yes',
                'default' => 'yes',
                'description' => __('Show eye and link buttons on hover', 'hello-elementor'),
            ]
        );

        $this->add_control(
            'show_view_button',
            [
                'label' => __('Show View Button', 'hello-elementor'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'hello-elementor'),
                'label_off' => __('Hide', 'hello-elementor'),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'show_action_buttons' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'show_link_button',
            [
                'label' => __('Show Link Button', 'hello-elementor'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'hello-elementor'),
                'label_off' => __('Hide', 'hello-elementor'),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'show_action_buttons' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'show_arrows',
            [
                'label' => __('Show Arrows', 'hello-elementor'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'hello-elementor'),
                'label_off' => __('Hide', 'hello-elementor'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_dots',
            [
                'label' => __('Show Dots', 'hello-elementor'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'hello-elementor'),
                'label_off' => __('Hide', 'hello-elementor'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'dots_count',
            [
                'label' => __('Dots Count', 'hello-elementor'),
                'type' => Controls_Manager::NUMBER,
                'default' => 3,
                'min' => 1,
                'max' => 10,
                'condition' => [
                    'show_dots' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Section - Title
        $this->start_controls_section(
            'section_style_title',
            [
                'label' => __('Title & Description', 'hello-elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => __('Title Typography', 'hello-elementor'),
                'selector' => '{{WRAPPER}} .portfolio-project-title',
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __('Title Color', 'hello-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .portfolio-project-title' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'label' => __('Description Typography', 'hello-elementor'),
                'selector' => '{{WRAPPER}} .portfolio-project-description',
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => __('Description Color', 'hello-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#cccccc',
                'selectors' => [
                    '{{WRAPPER}} .portfolio-project-description' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Section - Filter Buttons
        $this->start_controls_section(
            'section_style_filters',
            [
                'label' => __('Filter Buttons', 'hello-elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'filter_typography',
                'label' => __('Typography', 'hello-elementor'),
                'selector' => '{{WRAPPER}} .portfolio-project-filter-button',
            ]
        );

        $this->start_controls_tabs('filter_style_tabs');

        // Normal state
        $this->start_controls_tab(
            'filter_normal',
            [
                'label' => __('Normal', 'hello-elementor'),
            ]
        );

        $this->add_control(
            'filter_color',
            [
                'label' => __('Text Color', 'hello-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#cccccc',
                'selectors' => [
                    '{{WRAPPER}} .portfolio-project-filter-button' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'filter_background',
            [
                'label' => __('Background Color', 'hello-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => 'transparent',
                'selectors' => [
                    '{{WRAPPER}} .portfolio-project-filter-button' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        // Active state
        $this->start_controls_tab(
            'filter_active',
            [
                'label' => __('Active', 'hello-elementor'),
            ]
        );

        $this->add_control(
            'filter_active_color',
            [
                'label' => __('Text Color', 'hello-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#F4B183',
                'selectors' => [
                    '{{WRAPPER}} .portfolio-project-filter-button.active' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'filter_active_background',
            [
                'label' => __('Background Color', 'hello-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => 'transparent',
                'selectors' => [
                    '{{WRAPPER}} .portfolio-project-filter-button.active' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'filter_active_underline',
            [
                'label' => __('Show Underline', 'hello-elementor'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'hello-elementor'),
                'label_off' => __('No', 'hello-elementor'),
                'return_value' => 'yes',
                'default' => 'yes',
                'selectors' => [
                    '{{WRAPPER}} .portfolio-project-filter-button.active' => 'text-decoration: underline;',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        // Style Section - Projects
        $this->start_controls_section(
            'section_style_projects',
            [
                'label' => __('Projects', 'hello-elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'project_spacing',
            [
                'label' => __('Spacing', 'hello-elementor'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 10,
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .portfolio-project-grid' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'project_aspect_ratio',
            [
                'label' => __('Aspect Ratio', 'hello-elementor'),
                'type' => Controls_Manager::SELECT,
                'default' => '1-1',
                'options' => [
                    '1-1' => '1:1',
                    '4-3' => '4:3',
                    '3-2' => '3:2',
                    '16-9' => '16:9',
                    '2-3' => '2:3',
                    '3-4' => '3:4',
                ],
                'selectors' => [
                    '{{WRAPPER}} .portfolio-project-item' => 'aspect-ratio: var(--aspect-ratio);',
                ],
                'selectors_dictionary' => [
                    '1-1' => '1/1',
                    '4-3' => '4/3',
                    '3-2' => '3/2',
                    '16-9' => '16/9',
                    '2-3' => '2/3',
                    '3-4' => '3/4',
                ],
            ]
        );

        // Project Overlay Style
        $this->start_controls_tabs('project_overlay_style_tabs');

        // Normal state
        $this->start_controls_tab(
            'project_overlay_normal',
            [
                'label' => __('Normal', 'hello-elementor'),
            ]
        );

        $this->add_control(
            'project_overlay_background',
            [
                'label' => __('Overlay Background', 'hello-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => 'rgba(0,0,0,0)',
                'selectors' => [
                    '{{WRAPPER}} .portfolio-project-overlay' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'project_overlay_opacity',
            [
                'label' => __('Overlay Opacity', 'hello-elementor'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 0,
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .portfolio-project-overlay' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        // Hover state
        $this->start_controls_tab(
            'project_overlay_hover',
            [
                'label' => __('Hover', 'hello-elementor'),
            ]
        );

        $this->add_control(
            'project_overlay_hover_background',
            [
                'label' => __('Overlay Background', 'hello-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => 'rgba(0,0,0,0.8)',
                'selectors' => [
                    '{{WRAPPER}} .portfolio-project-item:hover .portfolio-project-overlay' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'project_overlay_hover_opacity',
            [
                'label' => __('Overlay Opacity', 'hello-elementor'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 1,
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .portfolio-project-item:hover .portfolio-project-overlay' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        // Project Content Style
        $this->add_control(
            'project_content_heading',
            [
                'label' => __('Project Content', 'hello-elementor'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'project_title_typography',
                'label' => __('Project Title Typography', 'hello-elementor'),
                'selector' => '{{WRAPPER}} .portfolio-project-title-overlay',
            ]
        );

        $this->add_control(
            'project_title_color',
            [
                'label' => __('Project Title Color', 'hello-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .portfolio-project-title-overlay' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'project_type_typography',
                'label' => __('Project Type Typography', 'hello-elementor'),
                'selector' => '{{WRAPPER}} .portfolio-project-type',
            ]
        );

        $this->add_control(
            'project_type_color',
            [
                'label' => __('Project Type Color', 'hello-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#F4B183',
                'selectors' => [
                    '{{WRAPPER}} .portfolio-project-type' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Section - Navigation
        $this->start_controls_section(
            'section_style_navigation',
            [
                'label' => __('Navigation', 'hello-elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_arrows' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'arrows_size',
            [
                'label' => __('Arrows Size', 'hello-elementor'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 30,
                ],
                'range' => [
                    'px' => [
                        'min' => 20,
                        'max' => 60,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .nav-button' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'arrows_color',
            [
                'label' => __('Arrows Color', 'hello-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .nav-button' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'arrows_background',
            [
                'label' => __('Arrows Background', 'hello-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => 'rgba(255, 255, 255, 0.2)',
                'selectors' => [
                    '{{WRAPPER}} .nav-button' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'dots_size',
            [
                'label' => __('Dots Size', 'hello-elementor'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 8,
                ],
                'range' => [
                    'px' => [
                        'min' => 4,
                        'max' => 20,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .dot' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'show_dots' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'dots_color',
            [
                'label' => __('Dots Color', 'hello-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => 'rgba(255, 255, 255, 0.3)',
                'selectors' => [
                    '{{WRAPPER}} .dot' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'show_dots' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'dots_active_color',
            [
                'label' => __('Dots Active Color', 'hello-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#F4B183',
                'selectors' => [
                    '{{WRAPPER}} .dot.active' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'show_dots' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Section - Branding
        $this->start_controls_section(
            'style_branding_section',
            [
                'label' => __('Branding Style', 'hello-elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_branding' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'branding_background_color',
            [
                'label' => __('Background Color', 'hello-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => 'rgba(255, 127, 80, 0.9)',
                'selectors' => [
                    '{{WRAPPER}} .portfolio-branding' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'branding_text_color',
            [
                'label' => __('Text Color', 'hello-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .portfolio-branding .branding-text' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'branding_typography',
                'label' => __('Typography', 'hello-elementor'),
                'selector' => '{{WRAPPER}} .portfolio-branding .branding-text',
            ]
        );

        $this->add_control(
            'branding_padding',
            [
                'label' => __('Padding', 'hello-elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .portfolio-branding' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'top' => 5,
                    'right' => 10,
                    'bottom' => 5,
                    'left' => 10,
                    'unit' => 'px',
                    'isLinked' => false,
                ],
            ]
        );

        $this->add_control(
            'branding_border_radius',
            [
                'label' => __('Border Radius', 'hello-elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .portfolio-branding' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'top' => 4,
                    'right' => 4,
                    'bottom' => 4,
                    'left' => 4,
                    'unit' => 'px',
                    'isLinked' => true,
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        include HELLO_ELEMENTOR_WIDGETS_PATH . 'widgets/widget-portfolio-project/templates/widget-portfolio-project.php';
    }
    
    /**
     * Extract YouTube video ID from URL
     *
     * @param string $url YouTube URL
     * @return string YouTube video ID or empty string if not found
     */
    protected function get_youtube_id($url) {
        // Return empty if URL is empty
        if (empty($url)) {
            return '';
        }
        
        $video_id = '';
        
        // Match youtube.com URLs
        if (preg_match('/youtube\.com\/watch\?v=([^\&\?\/]+)/', $url, $id)) {
            $video_id = $id[1];
        } 
        // Match youtu.be URLs
        elseif (preg_match('/youtu\.be\/([^\&\?\/]+)/', $url, $id)) {
            $video_id = $id[1];
        }
        // Match youtube.com/embed URLs
        elseif (preg_match('/youtube\.com\/embed\/([^\&\?\/]+)/', $url, $id)) {
            $video_id = $id[1];
        }
        
        return $video_id;
    }
    
    /**
     * Extract Vimeo video ID from URL
     *
     * @param string $url Vimeo URL
     * @return string Vimeo video ID or empty string if not found
     */
    protected function get_vimeo_id($url) {
        // Return empty if URL is empty
        if (empty($url)) {
            return '';
        }
        
        $video_id = '';
        
        // Match vimeo.com URLs
        if (preg_match('/vimeo\.com\/([0-9]+)/', $url, $id)) {
            $video_id = $id[1];
        }
        // Match player.vimeo.com URLs
        elseif (preg_match('/player\.vimeo\.com\/video\/([0-9]+)/', $url, $id)) {
            $video_id = $id[1];
        }
        
        return $video_id;
    }
} 
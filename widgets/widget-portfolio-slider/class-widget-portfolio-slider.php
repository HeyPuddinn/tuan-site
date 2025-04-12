<?php
namespace HelloElementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;
use Elementor\Repeater;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Widget_Portfolio_Slider extends Widget_Base {
    public function get_name() {
        return 'widget-portfolio-slider';
    }

    public function get_title() {
        return __('Portfolio Slider', 'hello-elementor');
    }

    public function get_icon() {
        return 'eicon-slider-album';
    }

    public function get_categories() {
        return ['general'];
    }

    public function get_script_depends() {
        return ['widget-portfolio-slider-script'];
    }

    public function get_style_depends() {
        return ['widget-portfolio-slider-style'];
    }

    protected function register_controls() {
        // Content Section
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', 'hello-elementor'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'widget_title',
            [
                'label' => __('Widget Title', 'hello-elementor'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Portfolio', 'hello-elementor'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'subtitle',
            [
                'label' => __('Subtitle', 'hello-elementor'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Some recent project', 'hello-elementor'),
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

        $repeater = new Repeater();

        $repeater->add_control(
            'portfolio_title',
            [
                'label' => __('Title', 'hello-elementor'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Project Title', 'hello-elementor'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'portfolio_image',
            [
                'label' => __('Image', 'hello-elementor'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'portfolio_link',
            [
                'label' => __('Project Link', 'hello-elementor'),
                'type' => Controls_Manager::URL,
                'placeholder' => __('https://your-link.com', 'hello-elementor'),
                'default' => [
                    'url' => '#',
                ],
            ]
        );

        $repeater->add_control(
            'portfolio_tags',
            [
                'label' => esc_html__('Tags', 'hello-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => esc_html__('Website, Logo', 'hello-elementor-widgets'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'portfolio_items',
            [
                'label' => __('Portfolio Items', 'hello-elementor'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'portfolio_title' => __('Project 1', 'hello-elementor'),
                        'portfolio_link' => ['url' => '#'],
                    ],
                    [
                        'portfolio_title' => __('Project 2', 'hello-elementor'),
                        'portfolio_link' => ['url' => '#'],
                    ],
                    [
                        'portfolio_title' => __('Project 3', 'hello-elementor'),
                        'portfolio_link' => ['url' => '#'],
                    ],
                ],
                'title_field' => '{{{ portfolio_title }}}',
            ]
        );

        $this->add_control(
            'view_all_link',
            [
                'label' => esc_html__('View All Link', 'hello-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-link.com', 'hello-elementor-widgets'),
                'show_external' => true,
                'default' => [
                    'url' => '',
                    'is_external' => false,
                    'nofollow' => false,
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'view_all_text',
            [
                'label' => esc_html__('View All Text', 'hello-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('View All', 'hello-elementor-widgets'),
                'condition' => [
                    'view_all_link[url]!' => '',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Section - Widget Title
        $this->start_controls_section(
            'style_widget_title_section',
            [
                'label' => __('Widget Title Style', 'hello-elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'widget_title_typography',
                'label' => __('Typography', 'hello-elementor'),
                'selector' => '{{WRAPPER}} .portfolio-title h2',
            ]
        );

        $this->add_control(
            'widget_title_color',
            [
                'label' => __('Title Color', 'hello-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .portfolio-title h2' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'widget_title_alignment',
            [
                'label' => __('Alignment', 'hello-elementor'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'hello-elementor'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'hello-elementor'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'hello-elementor'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .portfolio-title' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Section - Subtitle
        $this->start_controls_section(
            'style_subtitle_section',
            [
                'label' => __('Subtitle Style', 'hello-elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'subtitle_typography',
                'label' => __('Typography', 'hello-elementor'),
                'selector' => '{{WRAPPER}} .portfolio-subtitle',
            ]
        );

        $this->add_control(
            'subtitle_color',
            [
                'label' => __('Subtitle Color', 'hello-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#cccccc',
                'selectors' => [
                    '{{WRAPPER}} .portfolio-subtitle' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Section - Slider
        $this->start_controls_section(
            'style_slider_section',
            [
                'label' => __('Slider Style', 'hello-elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'slide_background',
            [
                'label' => __('Slide Background', 'hello-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#222222',
                'selectors' => [
                    '{{WRAPPER}} .portfolio-slide' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'slide_padding',
            [
                'label' => __('Slide Padding', 'hello-elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .portfolio-slide' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '0',
                    'left' => '0',
                    'unit' => 'px',
                    'isLinked' => false,
                ],
            ]
        );

        $this->add_control(
            'slide_border_radius',
            [
                'label' => __('Border Radius', 'hello-elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .portfolio-slide' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '0',
                    'left' => '0',
                    'unit' => 'px',
                    'isLinked' => true,
                ],
            ]
        );

        $this->end_controls_section();

        // Style Section - Navigation
        $this->start_controls_section(
            'style_navigation_section',
            [
                'label' => __('Navigation Style', 'hello-elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control(
            'nav_arrow_color',
            [
                'label' => __('Arrow Color', 'hello-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .portfolio-nav-arrow' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'nav_arrow_size',
            [
                'label' => __('Arrow Size', 'hello-elementor'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 50,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 24,
                ],
                'selectors' => [
                    '{{WRAPPER}} .portfolio-nav-arrow' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'pagination_color',
            [
                'label' => __('Pagination Color', 'hello-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .portfolio-pagination .current' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .portfolio-pagination .total' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

        // Add a new section for slider settings
        $this->start_controls_section(
            'slider_settings_section',
            [
                'label' => __('Slider Settings', 'hello-elementor'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_responsive_control(
            'slides_per_view',
            [
                'label' => esc_html__('Slides Per View', 'hello-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 10,
                'default' => 3,
                'tablet_default' => 2,
                'mobile_default' => 1,
            ]
        );

        $this->add_control(
            'space_between',
            [
                'label' => __('Space Between Slides', 'hello-elementor'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 20,
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
        
        // Include the template file
        include(HELLO_ELEMENTOR_WIDGETS_PATH . 'widgets/widget-portfolio-slider/templates/widget-portfolio-slider.php');
    }
} 
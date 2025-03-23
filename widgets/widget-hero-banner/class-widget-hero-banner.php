<?php
namespace HelloElementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Utils;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Widget_Hero_Banner extends Widget_Base {
    public function get_name() {
        return 'widget-hero-banner';
    }

    public function get_title() {
        return __('Hero Banner', 'hello-elementor');
    }

    public function get_icon() {
        return 'eicon-banner';
    }

    public function get_categories() {
        return ['general'];
    }

    public function get_script_depends() {
        return ['widget-hero-banner-script'];
    }

    public function get_style_depends() {
        return ['widget-hero-banner-style'];
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
            'avatar',
            [
                'label' => __('Avatar Image', 'hello-elementor'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'name',
            [
                'label' => __('Name', 'hello-elementor'),
                'type' => Controls_Manager::TEXT,
                'default' => __('I\'m Tuan', 'hello-elementor'),
                'placeholder' => __('Enter your name', 'hello-elementor'),
            ]
        );

        $this->add_control(
            'job_titles',
            [
                'label' => __('Job Titles', 'hello-elementor'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __('Digital Marketer | Social Media Manager | Visual Creator', 'hello-elementor'),
                'placeholder' => __('Enter job titles separated by | symbol', 'hello-elementor'),
                'description' => __('Enter multiple job titles separated by the | symbol', 'hello-elementor'),
            ]
        );

        $this->add_control(
            'content',
            [
                'label' => __('Content', 'hello-elementor'),
                'type' => Controls_Manager::WYSIWYG,
                'default' => __('This is my website.<br>Thank you for visiting.', 'hello-elementor'),
                'placeholder' => __('Enter your content here', 'hello-elementor'),
            ]
        );

        $this->add_control(
            'cv_pdf',
            [
                'label' => __('CV PDF File', 'hello-elementor'),
                'type' => Controls_Manager::MEDIA,
                'media_type' => 'application/pdf',
                'default' => [
                    'url' => '',
                ],
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => __('Button Text', 'hello-elementor'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Download CV', 'hello-elementor'),
                'placeholder' => __('Enter button text', 'hello-elementor'),
            ]
        );

        $this->end_controls_section();

        // Style Section
        $this->start_controls_section(
            'style_section',
            [
                'label' => __('Style', 'hello-elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        // Avatar Style
        $this->add_control(
            'avatar_heading',
            [
                'label' => __('Avatar', 'hello-elementor'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'avatar_border_radius',
            [
                'label' => __('Border Radius', 'hello-elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .hero-banner-avatar img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'top' => '10',
                    'right' => '10',
                    'bottom' => '10',
                    'left' => '10',
                    'unit' => 'px',
                    'isLinked' => true,
                ],
            ]
        );

        $this->add_control(
            'avatar_border_color',
            [
                'label' => __('Border Color', 'hello-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#C78140',
                'selectors' => [
                    '{{WRAPPER}} .hero-banner-avatar img' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'avatar_border_width',
            [
                'label' => __('Border Width', 'hello-elementor'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 10,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 2,
                ],
                'selectors' => [
                    '{{WRAPPER}} .hero-banner-avatar img' => 'border-style: solid; border-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // Name Style
        $this->add_control(
            'name_heading',
            [
                'label' => __('Name', 'hello-elementor'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'name_typography',
                'selector' => '{{WRAPPER}} .hero-banner-name',
            ]
        );

        $this->add_control(
            'name_color',
            [
                'label' => __('Color', 'hello-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .hero-banner-name' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Job Titles Style
        $this->add_control(
            'job_titles_heading',
            [
                'label' => __('Job Titles', 'hello-elementor'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'job_titles_typography',
                'selector' => '{{WRAPPER}} .hero-banner-job-titles',
            ]
        );

        $this->add_control(
            'job_titles_color',
            [
                'label' => __('Color', 'hello-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#C78140',
                'selectors' => [
                    '{{WRAPPER}} .hero-banner-job-titles' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Content Style
        $this->add_control(
            'content_heading',
            [
                'label' => __('Content', 'hello-elementor'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'selector' => '{{WRAPPER}} .hero-banner-content',
            ]
        );

        $this->add_control(
            'content_color',
            [
                'label' => __('Color', 'hello-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .hero-banner-content' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Button Style
        $this->add_control(
            'button_heading',
            [
                'label' => __('Button', 'hello-elementor'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'selector' => '{{WRAPPER}} .hero-banner-button a',
            ]
        );

        $this->start_controls_tabs('button_style_tabs');

        $this->start_controls_tab(
            'button_normal_tab',
            [
                'label' => __('Normal', 'hello-elementor'),
            ]
        );

        $this->add_control(
            'button_text_color',
            [
                'label' => __('Text Color', 'hello-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .hero-banner-button a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_background_color',
            [
                'label' => __('Background Color', 'hello-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .hero-banner-button a' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_border_radius',
            [
                'label' => __('Border Radius', 'hello-elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .hero-banner-button a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'top' => '5',
                    'right' => '5',
                    'bottom' => '5',
                    'left' => '5',
                    'unit' => 'px',
                    'isLinked' => true,
                ],
            ]
        );

        $this->add_control(
            'button_padding',
            [
                'label' => __('Padding', 'hello-elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .hero-banner-button a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'top' => '10',
                    'right' => '20',
                    'bottom' => '10',
                    'left' => '20',
                    'unit' => 'px',
                    'isLinked' => false,
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'button_hover_tab',
            [
                'label' => __('Hover', 'hello-elementor'),
            ]
        );

        $this->add_control(
            'button_hover_text_color',
            [
                'label' => __('Text Color', 'hello-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .hero-banner-button a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_background_color',
            [
                'label' => __('Background Color', 'hello-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#C78140',
                'selectors' => [
                    '{{WRAPPER}} .hero-banner-button a:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_transition',
            [
                'label' => __('Transition Duration', 'hello-elementor'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 0.3,
                ],
                'range' => [
                    'px' => [
                        'max' => 3,
                        'step' => 0.1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .hero-banner-button a' => 'transition-duration: {{SIZE}}s',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        // Background Style
        $this->add_control(
            'background_heading',
            [
                'label' => __('Background', 'hello-elementor'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'background_color',
            [
                'label' => __('Background Color', 'hello-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .hero-banner-widget' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'widget_padding',
            [
                'label' => __('Padding', 'hello-elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .hero-banner-widget' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'top' => '50',
                    'right' => '30',
                    'bottom' => '50',
                    'left' => '30',
                    'unit' => 'px',
                    'isLinked' => false,
                ],
            ]
        );

        $this->end_controls_section();

        // Responsive section
        $this->start_controls_section(
            'responsive_section',
            [
                'label' => __('Responsive Settings', 'hello-elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'layout_tablet',
            [
                'label' => __('Tablet Layout', 'hello-elementor'),
                'type' => Controls_Manager::SELECT,
                'default' => 'flex',
                'options' => [
                    'flex' => __('Side by Side', 'hello-elementor'),
                    'block' => __('Stacked', 'hello-elementor'),
                ],
                'selectors' => [
                    '(tablet){{WRAPPER}} .hero-banner-container' => 'flex-direction: {{VALUE}};',
                ],
                'selectors_dictionary' => [
                    'flex' => 'row',
                    'block' => 'column',
                ],
            ]
        );

        $this->add_control(
            'layout_mobile',
            [
                'label' => __('Mobile Layout', 'hello-elementor'),
                'type' => Controls_Manager::SELECT,
                'default' => 'block',
                'options' => [
                    'flex' => __('Side by Side', 'hello-elementor'),
                    'block' => __('Stacked', 'hello-elementor'),
                ],
                'selectors' => [
                    '(mobile){{WRAPPER}} .hero-banner-container' => 'flex-direction: {{VALUE}};',
                ],
                'selectors_dictionary' => [
                    'flex' => 'row',
                    'block' => 'column',
                ],
            ]
        );

        $this->add_control(
            'avatar_size_tablet',
            [
                'label' => __('Avatar Size (Tablet)', 'hello-elementor'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 300,
                    ],
                ],
                'default' => [
                    'size' => 200,
                ],
                'selectors' => [
                    '(tablet){{WRAPPER}} .hero-banner-avatar img' => 'width: {{SIZE}}px; height: {{SIZE}}px;',
                ],
            ]
        );

        $this->add_control(
            'avatar_size_mobile',
            [
                'label' => __('Avatar Size (Mobile)', 'hello-elementor'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 300,
                    ],
                ],
                'default' => [
                    'size' => 180,
                ],
                'selectors' => [
                    '(mobile){{WRAPPER}} .hero-banner-avatar img' => 'width: {{SIZE}}px; height: {{SIZE}}px;',
                ],
            ]
        );

        $this->add_control(
            'content_alignment_tablet',
            [
                'label' => __('Content Alignment (Tablet)', 'hello-elementor'),
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
                    '(tablet){{WRAPPER}} .hero-banner-content-wrapper' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'content_alignment_mobile',
            [
                'label' => __('Content Alignment (Mobile)', 'hello-elementor'),
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
                'default' => 'center',
                'selectors' => [
                    '(mobile){{WRAPPER}} .hero-banner-content-wrapper' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'spacing_tablet',
            [
                'label' => __('Spacing Between Elements (Tablet)', 'hello-elementor'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 30,
                ],
                'selectors' => [
                    '(tablet){{WRAPPER}} .hero-banner-name' => 'margin-bottom: {{SIZE}}px;',
                    '(tablet){{WRAPPER}} .hero-banner-job-titles' => 'margin-bottom: {{SIZE}}px;',
                    '(tablet){{WRAPPER}} .hero-banner-content' => 'margin-bottom: {{SIZE}}px;',
                ],
            ]
        );

        $this->add_control(
            'spacing_mobile',
            [
                'label' => __('Spacing Between Elements (Mobile)', 'hello-elementor'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 20,
                ],
                'selectors' => [
                    '(mobile){{WRAPPER}} .hero-banner-name' => 'margin-bottom: {{SIZE}}px;',
                    '(mobile){{WRAPPER}} .hero-banner-job-titles' => 'margin-bottom: {{SIZE}}px;',
                    '(mobile){{WRAPPER}} .hero-banner-content' => 'margin-bottom: {{SIZE}}px;',
                    '(mobile){{WRAPPER}} .hero-banner-avatar' => 'margin-bottom: {{SIZE}}px;',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        
        include __DIR__ . '/templates/widget-hero-banner.php';
    }
} 
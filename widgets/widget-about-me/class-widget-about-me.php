<?php
namespace HelloElementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Widget_About_Me extends Widget_Base {
    public function get_name() {
        return 'widget-about-me';
    }

    public function get_title() {
        return __('About Me', 'hello-elementor');
    }

    public function get_icon() {
        return 'eicon-person';
    }

    public function get_categories() {
        return ['general'];
    }

    public function get_script_depends() {
        return ['widget-about-me-script'];
    }

    public function get_style_depends() {
        return ['widget-about-me-style'];
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
            'about_me_content',
            [
                'label' => __('About Me Content', 'hello-elementor'),
                'type' => Controls_Manager::WYSIWYG,
                'default' => __('I am a digital marketing specialist with over 3 years of experience in Social Media. My expertise includes content creation, campaign management, and audience engagement strategies that drive measurable results for businesses of all sizes.', 'hello-elementor'),
            ]
        );

        $this->add_control(
            'profile_image',
            [
                'label' => __('Profile Image', 'hello-elementor'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => '',
                ],
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

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => __('Title Typography', 'hello-elementor'),
                'selector' => '{{WRAPPER}} .about-me-title',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'label' => __('Content Typography', 'hello-elementor'),
                'selector' => '{{WRAPPER}} .about-me-content',
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __('Title Color', 'hello-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .about-me-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'initial_text_color',
            [
                'label' => __('Initial Text Color', 'hello-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#626262',
                'selectors' => [
                    '{{WRAPPER}} .about-me-content' => 'color: {{VALUE}}',
                ],
                'description' => __('Initial color of text before animation', 'hello-elementor'),
            ]
        );

        $this->add_control(
            'animated_text_color',
            [
                'label' => __('Animated Text Color', 'hello-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'description' => __('Color that text will animate to', 'hello-elementor'),
            ]
        );

        $this->add_control(
            'background_color',
            [
                'label' => __('Background Color', 'hello-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#0a0a13',
                'selectors' => [
                    '{{WRAPPER}} .about-me-widget' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'padding',
            [
                'label' => __('Padding', 'hello-elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .about-me-widget' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'top' => '50',
                    'right' => '20',
                    'bottom' => '0',
                    'left' => '20',
                    'unit' => 'px',
                    'isLinked' => false,
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        
        // Add data attributes for the animation
        $this->add_render_attribute('content', 'data-initial-color', $settings['initial_text_color']);
        $this->add_render_attribute('content', 'data-animated-color', $settings['animated_text_color']);
        
        include __DIR__ . '/templates/widget-about-me.php';
    }
} 
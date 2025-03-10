<?php
namespace HelloElementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Widget_Portfolio_Hero extends Widget_Base {
    public function get_name() {
        return 'widget-portfolio-hero';
    }

    public function get_title() {
        return __('Portfolio Hero', 'hello-elementor');
    }

    public function get_icon() {
        return 'eicon-banner';
    }

    public function get_categories() {
        return ['general'];
    }

    public function get_script_depends() {
        return ['widget-portfolio-hero-script'];
    }

    public function get_style_depends() {
        return ['widget-portfolio-hero-style'];
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
            'welcome_text',
            [
                'label' => __('Welcome Text', 'hello-elementor'),
                'type' => Controls_Manager::TEXT,
                'default' => __('WELCOME TO MY', 'hello-elementor'),
            ]
        );

        $this->add_control(
            'portfolio_text',
            [
                'label' => __('Portfolio Text', 'hello-elementor'),
                'type' => Controls_Manager::TEXT,
                'default' => __('PORTFOLIO', 'hello-elementor'),
            ]
        );

        $this->add_control(
            'avatar',
            [
                'label' => __('Avatar Image', 'hello-elementor'),
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
                'name' => 'welcome_typography',
                'label' => __('Welcome Text Typography', 'hello-elementor'),
                'selector' => '{{WRAPPER}} .portfolio-hero-welcome',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'portfolio_typography',
                'label' => __('Portfolio Text Typography', 'hello-elementor'),
                'selector' => '{{WRAPPER}} .portfolio-text',
            ]
        );

        $this->add_control(
            'welcome_color',
            [
                'label' => __('Welcome Text Color', 'hello-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .portfolio-hero-welcome' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'portfolio_color',
            [
                'label' => __('Portfolio Text Color', 'hello-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .portfolio-text' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'animation_speed',
            [
                'label' => __('Animation Speed (ms)', 'hello-elementor'),
                'type' => Controls_Manager::NUMBER,
                'default' => 500,
                'min' => 100,
                'max' => 2000,
                'step' => 100,
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        include __DIR__ . '/templates/widget-portfolio-hero.php';
    }
} 
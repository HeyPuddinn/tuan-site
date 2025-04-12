<?php
namespace HelloElementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;
use Elementor\Repeater;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Widget_Portfolio_Banner extends Widget_Base {
    public function get_name() {
        return 'widget-portfolio-banner';
    }

    public function get_title() {
        return __('Portfolio Banner', 'hello-elementor');
    }

    public function get_icon() {
        return 'eicon-banner';
    }

    public function get_categories() {
        return ['general'];
    }

    public function get_script_depends() {
        return ['widget-portfolio-banner-script'];
    }

    public function get_style_depends() {
        return ['widget-portfolio-banner-style'];
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
            'greeting',
            [
                'label' => __('Greeting', 'hello-elementor'),
                'type' => Controls_Manager::TEXT,
                'default' => __('HELLO!', 'hello-elementor'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'portfolio_message',
            [
                'label' => __('Portfolio Message', 'hello-elementor'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Đây là Portfolio của mình', 'hello-elementor'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'subtext',
            [
                'label' => __('Subtext', 'hello-elementor'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Cảm ơn bạn đã ghé thăm', 'hello-elementor'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'job_title',
            [
                'label' => __('Job Title', 'hello-elementor'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Digital Marketer | Social Media Manager | Visual Creator', 'hello-elementor'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'year',
            [
                'label' => __('Year', 'hello-elementor'),
                'type' => Controls_Manager::TEXT,
                'default' => date('Y'),
                'label_block' => true,
            ]
        );

        $this->end_controls_section();

        // Style Section - Greeting
        $this->start_controls_section(
            'style_greeting_section',
            [
                'label' => __('Greeting Style', 'hello-elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'greeting_typography',
                'label' => __('Typography', 'hello-elementor'),
                'selector' => '{{WRAPPER}} .portfolio-banner-greeting',
            ]
        );

        $this->add_control(
            'greeting_color',
            [
                'label' => __('Color', 'hello-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#F4B183',
                'selectors' => [
                    '{{WRAPPER}} .portfolio-banner-greeting' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Section - Portfolio Message
        $this->start_controls_section(
            'style_portfolio_message_section',
            [
                'label' => __('Portfolio Message Style', 'hello-elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'portfolio_message_typography',
                'label' => __('Typography', 'hello-elementor'),
                'selector' => '{{WRAPPER}} .portfolio-banner-message',
            ]
        );

        $this->add_control(
            'portfolio_message_color',
            [
                'label' => __('Color', 'hello-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#F4B183',
                'selectors' => [
                    '{{WRAPPER}} .portfolio-banner-message' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Section - Subtext
        $this->start_controls_section(
            'style_subtext_section',
            [
                'label' => __('Subtext Style', 'hello-elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'subtext_typography',
                'label' => __('Typography', 'hello-elementor'),
                'selector' => '{{WRAPPER}} .portfolio-banner-subtext',
            ]
        );

        $this->add_control(
            'subtext_color',
            [
                'label' => __('Color', 'hello-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#F4B183',
                'selectors' => [
                    '{{WRAPPER}} .portfolio-banner-subtext' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Section - Job Title
        $this->start_controls_section(
            'style_job_title_section',
            [
                'label' => __('Job Title Style', 'hello-elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'job_title_typography',
                'label' => __('Typography', 'hello-elementor'),
                'selector' => '{{WRAPPER}} .portfolio-banner-job-title',
            ]
        );

        $this->add_control(
            'job_title_color',
            [
                'label' => __('Color', 'hello-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .portfolio-banner-job-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Section - Year
        $this->start_controls_section(
            'style_year_section',
            [
                'label' => __('Year Style', 'hello-elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'year_typography',
                'label' => __('Typography', 'hello-elementor'),
                'selector' => '{{WRAPPER}} .portfolio-banner-year',
            ]
        );

        $this->add_control(
            'year_color',
            [
                'label' => __('Color', 'hello-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .portfolio-banner-year' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Section - Background
        $this->start_controls_section(
            'style_background_section',
            [
                'label' => __('Background Style', 'hello-elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'background_color',
            [
                'label' => __('Background Color', 'hello-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#1F1F1F',
                'selectors' => [
                    '{{WRAPPER}} .portfolio-banner-widget' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        include HELLO_ELEMENTOR_WIDGETS_PATH . 'widgets/widget-portfolio-banner/templates/widget-portfolio-banner.php';
    }
} 
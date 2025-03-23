<?php
namespace HelloElementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Utils;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Widget_Companies_Worked_With extends Widget_Base {
    public function get_name() {
        return 'widget-companies-worked-with';
    }

    public function get_title() {
        return __('Companies Worked With', 'hello-elementor');
    }

    public function get_icon() {
        return 'eicon-logo';
    }

    public function get_categories() {
        return ['general'];
    }

    public function get_style_depends() {
        return ['widget-companies-worked-with-style'];
    }

    public function get_script_depends() {
        return ['widget-companies-worked-with-script'];
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
                'default' => __('Company I Worked With', 'hello-elementor'),
                'label_block' => true,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'company_name',
            [
                'label' => __('Company Name', 'hello-elementor'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Company Name', 'hello-elementor'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'company_logo',
            [
                'label' => __('Company Logo', 'hello-elementor'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'company_url',
            [
                'label' => __('Company URL', 'hello-elementor'),
                'type' => Controls_Manager::URL,
                'placeholder' => __('https://your-link.com', 'hello-elementor'),
                'show_external' => true,
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                ],
            ]
        );

        $this->add_control(
            'company_items',
            [
                'label' => __('Company Logos', 'hello-elementor'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'company_name' => __('Walmart', 'hello-elementor'),
                    ],
                    [
                        'company_name' => __('LinkedIn', 'hello-elementor'),
                    ],
                    [
                        'company_name' => __('Google', 'hello-elementor'),
                    ],
                    [
                        'company_name' => __('Slack', 'hello-elementor'),
                    ],
                    [
                        'company_name' => __('Amazon', 'hello-elementor'),
                    ],
                ],
                'title_field' => '{{{ company_name }}}',
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
                'selector' => '{{WRAPPER}} .companies-title h2',
            ]
        );

        $this->add_control(
            'widget_title_color',
            [
                'label' => __('Title Color', 'hello-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .companies-title h2' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'widget_title_margin',
            [
                'label' => __('Title Margin', 'hello-elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .companies-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '30',
                    'left' => '0',
                    'unit' => 'px',
                    'isLinked' => false,
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
                    '{{WRAPPER}} .companies-title' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Section - Logos Layout
        $this->start_controls_section(
            'style_logos_section',
            [
                'label' => __('Logos Style', 'hello-elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'logos_background_color',
            [
                'label' => __('Background Color', 'hello-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .companies-container' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'logos_padding',
            [
                'label' => __('Logos Container Padding', 'hello-elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .companies-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'top' => '20',
                    'right' => '20',
                    'bottom' => '20',
                    'left' => '20',
                    'unit' => 'px',
                    'isLinked' => false,
                ],
            ]
        );

        $this->add_control(
            'logo_width',
            [
                'label' => __('Logo Width', 'hello-elementor'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 50,
                        'max' => 300,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 10,
                        'max' => 100,
                        'step' => 5,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 120,
                ],
                'selectors' => [
                    '{{WRAPPER}} .company-logo img' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'logo_spacing',
            [
                'label' => __('Logo Spacing', 'hello-elementor'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 5,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 30,
                ],
                'selectors' => [
                    '{{WRAPPER}} .company-logo' => 'padding: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'logos_per_row',
            [
                'label' => __('Logos Per Row', 'hello-elementor'),
                'type' => Controls_Manager::SELECT,
                'default' => '5',
                'options' => [
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                    '6' => '6',
                ],
                'selectors' => [
                    '{{WRAPPER}} .companies-logos' => 'grid-template-columns: repeat({{VALUE}}, 1fr);',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        include __DIR__ . '/templates/widget-companies-worked-with.php';
    }
} 
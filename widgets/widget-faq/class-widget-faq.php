<?php
namespace HelloElementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Widget_Faq extends Widget_Base {
    public function get_name() {
        return 'widget-faq';
    }

    public function get_title() {
        return __('FAQ Accordion', 'hello-elementor');
    }

    public function get_icon() {
        return 'eicon-accordion';
    }

    public function get_categories() {
        return ['general'];
    }

    public function get_script_depends() {
        return ['widget-faq-script'];
    }

    public function get_style_depends() {
        return ['widget-faq-style'];
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
                'default' => __('WHAT I CAN DO', 'hello-elementor'),
                'label_block' => true,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'faq_title',
            [
                'label' => __('Title', 'hello-elementor'),
                'type' => Controls_Manager::TEXT,
                'default' => __('FAQ Item Title', 'hello-elementor'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'faq_content',
            [
                'label' => __('Content', 'hello-elementor'),
                'type' => Controls_Manager::WYSIWYG,
                'default' => __('FAQ Item Content', 'hello-elementor'),
            ]
        );

        $this->add_control(
            'faq_items',
            [
                'label' => __('FAQ Items', 'hello-elementor'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'faq_title' => __('SOCIAL MEDIA MANAGER', 'hello-elementor'),
                        'faq_content' => __('Content for social media manager services.', 'hello-elementor'),
                    ],
                    [
                        'faq_title' => __('ADVERTISING', 'hello-elementor'),
                        'faq_content' => __('Content for advertising services.', 'hello-elementor'),
                    ],
                    [
                        'faq_title' => __('CONTENT MARKETING', 'hello-elementor'),
                        'faq_content' => __('Content for content marketing services.', 'hello-elementor'),
                    ],
                    [
                        'faq_title' => __('GRAPHIC DESIGN', 'hello-elementor'),
                        'faq_content' => __('Content for graphic design services.', 'hello-elementor'),
                    ],
                    [
                        'faq_title' => __('PHOTOGRAPHY', 'hello-elementor'),
                        'faq_content' => __('Content for photography services.', 'hello-elementor'),
                    ],
                ],
                'title_field' => '{{{ faq_title }}}',
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
                'selector' => '{{WRAPPER}} .faq-title h2',
            ]
        );

        $this->add_control(
            'widget_title_color',
            [
                'label' => __('Title Color', 'hello-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .faq-title h2' => 'color: {{VALUE}}',
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
                    '{{WRAPPER}} .faq-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
            'widget_title_padding',
            [
                'label' => __('Title Padding', 'hello-elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .faq-title h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .faq-title' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Section - Title
        $this->start_controls_section(
            'style_title_section',
            [
                'label' => __('Item Title Style', 'hello-elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => __('Typography', 'hello-elementor'),
                'selector' => '{{WRAPPER}} .faq-item-title',
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __('Title Color', 'hello-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .faq-item-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'title_background',
            [
                'label' => __('Title Background', 'hello-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .faq-item' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'title_padding',
            [
                'label' => __('Title Padding', 'hello-elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .faq-item-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'top' => '15',
                    'right' => '20',
                    'bottom' => '15',
                    'left' => '20',
                    'unit' => 'px',
                    'isLinked' => false,
                ],
            ]
        );

        $this->end_controls_section();

        // Style Section - Content
        $this->start_controls_section(
            'style_content_section',
            [
                'label' => __('Content Style', 'hello-elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'label' => __('Typography', 'hello-elementor'),
                'selector' => '{{WRAPPER}} .faq-item-content',
            ]
        );

        $this->add_control(
            'content_color',
            [
                'label' => __('Content Color', 'hello-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .faq-item-content' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'content_background',
            [
                'label' => __('Content Background', 'hello-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#111111',
                'selectors' => [
                    '{{WRAPPER}} .faq-item-content' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'content_padding',
            [
                'label' => __('Content Padding', 'hello-elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .faq-item-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

        $this->end_controls_section();

        // Style Section - Layout
        $this->start_controls_section(
            'style_layout_section',
            [
                'label' => __('Layout', 'hello-elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'item_spacing',
            [
                'label' => __('Item Spacing', 'hello-elementor'),
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
                    'size' => 1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .faq-item:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'border_width',
            [
                'label' => __('Border Width', 'hello-elementor'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 10,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 0,
                ],
                'selectors' => [
                    '{{WRAPPER}} .faq-item' => 'border-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'border_color',
            [
                'label' => __('Border Color', 'hello-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#333333',
                'selectors' => [
                    '{{WRAPPER}} .faq-item' => 'border-color: {{VALUE}}; border-style: solid;',
                ],
                'condition' => [
                    'border_width[size]!' => 0,
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        include __DIR__ . '/templates/widget-faq.php';
    }
} 
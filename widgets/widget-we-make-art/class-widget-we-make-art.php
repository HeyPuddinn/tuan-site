<?php
namespace HelloElementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Widget_We_Make_Art extends Widget_Base {
    public function get_name() {
        return 'widget-we-make-art';
    }

    public function get_title() {
        return __('We Make Art', 'hello-elementor');
    }

    public function get_icon() {
        return 'eicon-gallery-grid';
    }

    public function get_categories() {
        return ['general'];
    }

    public function get_script_depends() {
        return ['widget-we-make-art-script'];
    }

    public function get_style_depends() {
        return ['widget-we-make-art-style'];
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
            'title',
            [
                'label' => __('Title', 'hello-elementor'),
                'type' => Controls_Manager::TEXT,
                'default' => __('We Make Art', 'hello-elementor'),
            ]
        );

        $this->add_control(
            'main_description',
            [
                'label' => __('Main Description', 'hello-elementor'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __('Our team is dedicated to creating captivating game worlds that spark imagination and immerse players in unforgettable experiences. From concept design to final polish, we approach each project with creativity, technical expertise, and a commitment to excellence, bringing your visions to life with precision and passion.', 'hello-elementor'),
            ]
        );

        $this->add_control(
            'secondary_description',
            [
                'label' => __('Secondary Description', 'hello-elementor'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __('We are more than just an art studio; we are storytellers and innovators who understand the power of visual expression. With a collaborative spirit and a global perspective, we blend artistry with cutting-edge technology to produce high-quality assets that stand out in today\'s competitive gaming landscape. Partner with us to elevate your game with art that speaks to players on a deeper level.', 'hello-elementor'),
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => __('Button Text', 'hello-elementor'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Learn More', 'hello-elementor'),
            ]
        );

        $this->add_control(
            'button_link',
            [
                'label' => __('Button Link', 'hello-elementor'),
                'type' => Controls_Manager::URL,
                'placeholder' => __('https://your-link.com', 'hello-elementor'),
                'show_external' => true,
                'default' => [
                    'url' => '#',
                    'is_external' => false,
                    'nofollow' => false,
                ],
            ]
        );

        $this->add_control(
            'gallery',
            [
                'label' => __('Add Game Images', 'hello-elementor'),
                'type' => Controls_Manager::GALLERY,
                'default' => [],
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
                'selector' => '{{WRAPPER}} .widget-title',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'label' => __('Description Typography', 'hello-elementor'),
                'selector' => '{{WRAPPER}} .widget-description',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        include __DIR__ . '/templates/widget-we-make-art.php';
    }
} 
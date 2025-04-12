<?php
namespace HelloElementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Widget_Contact extends Widget_Base {
    public function get_name() {
        return 'widget-contact';
    }

    public function get_title() {
        return __('Contact Form', 'hello-elementor');
    }

    public function get_icon() {
        return 'eicon-form-horizontal';
    }

    public function get_categories() {
        return ['general'];
    }

    public function get_script_depends() {
        return ['widget-contact-script'];
    }

    public function get_style_depends() {
        return [
            'widget-contact-style',
            'fontawesome-all',
            'fontawesome-brands'
        ];
    }

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);

        // Register Font Awesome styles
        wp_register_style(
            'fontawesome-all',
            'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css',
            [],
            '5.15.4'
        );

        wp_register_style(
            'fontawesome-brands',
            'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/brands.min.css',
            ['fontawesome-all'],
            '5.15.4'
        );
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
            'section_title',
            [
                'label' => __('Section Title', 'hello-elementor'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Contact Me', 'hello-elementor'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'contact_form_id',
            [
                'label' => __('Contact Form 7 ID', 'hello-elementor'),
                'type' => Controls_Manager::TEXT,
                'description' => __('Enter the Contact Form 7 ID here', 'hello-elementor'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'office_address',
            [
                'label' => __('Office Address', 'hello-elementor'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Jurain,Dhaka Bangladesh', 'hello-elementor'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'contact_number',
            [
                'label' => __('Contact Number', 'hello-elementor'),
                'type' => Controls_Manager::TEXT,
                'default' => __('+1234321321', 'hello-elementor'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'email_address',
            [
                'label' => __('Email Address', 'hello-elementor'),
                'type' => Controls_Manager::TEXT,
                'default' => __('websitename@gmail.com', 'hello-elementor'),
                'label_block' => true,
            ]
        );

        // Social Links
        $this->add_control(
            'facebook_link',
            [
                'label' => __('Facebook Link', 'hello-elementor'),
                'type' => Controls_Manager::URL,
                'placeholder' => __('https://your-link.com', 'hello-elementor'),
                'show_external' => true,
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                ],
            ]
        );

        $this->add_control(
            'twitter_link',
            [
                'label' => __('Twitter Link', 'hello-elementor'),
                'type' => Controls_Manager::URL,
                'placeholder' => __('https://your-link.com', 'hello-elementor'),
                'show_external' => true,
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                ],
            ]
        );

        $this->add_control(
            'linkedin_link',
            [
                'label' => __('LinkedIn Link', 'hello-elementor'),
                'type' => Controls_Manager::URL,
                'placeholder' => __('https://your-link.com', 'hello-elementor'),
                'show_external' => true,
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                ],
            ]
        );

        $this->add_control(
            'github_link',
            [
                'label' => __('GitHub Link', 'hello-elementor'),
                'type' => Controls_Manager::URL,
                'placeholder' => __('https://your-link.com', 'hello-elementor'),
                'show_external' => true,
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
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

        // Section Title Style
        $this->add_control(
            'section_title_heading',
            [
                'label' => __('Section Title', 'hello-elementor'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'section_title_color',
            [
                'label' => __('Title Color', 'hello-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#E5855E',
                'selectors' => [
                    '{{WRAPPER}} .contact-section-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'section_title_typography',
                'label' => __('Title Typography', 'hello-elementor'),
                'selector' => '{{WRAPPER}} .contact-section-title',
                'default' => [
                    'font_size' => '48px',
                    'font_weight' => '600',
                ],
            ]
        );

        $this->add_responsive_control(
            'section_title_margin',
            [
                'label' => __('Title Margin', 'hello-elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .contact-section-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '50',
                    'left' => '0',
                    'unit' => 'px',
                    'isLinked' => false,
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __('Title Color', 'hello-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#E5855E',
                'selectors' => [
                    '{{WRAPPER}} .contact-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => __('Title Typography', 'hello-elementor'),
                'selector' => '{{WRAPPER}} .contact-title',
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label' => __('Text Color', 'hello-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .contact-info' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'social_icon_color',
            [
                'label' => __('Social Icon Color', 'hello-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .social-icons a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="contact-widget">
            <h2 class="contact-section-title"><?php echo esc_html($settings['section_title']); ?></h2>
            <div class="contact-container">
                <div class="contact-info-column">
                    <div class="office-info">
                        <div class="info-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <div class="info-content">
                                <h4>Address:</h4>
                                <p><?php echo esc_html($settings['office_address']); ?></p>
                            </div>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-phone"></i>
                            <div class="info-content">
                                <h4>Phone:</h4>
                                <p><?php echo esc_html($settings['contact_number']); ?></p>
                            </div>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-envelope"></i>
                            <div class="info-content">
                                <h4>Email:</h4>
                                <p><?php echo esc_html($settings['email_address']); ?></p>
                            </div>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <div class="info-content">
                                <h4>Working Hours:</h4>
                                <p>Mon to Sat 9:00 am to 5:00 pm</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="contact-form-column">
                    <?php if ($settings['contact_form_id']) : ?>
                        <?php echo do_shortcode('[contact-form-7 id="' . esc_attr($settings['contact_form_id']) . '"]'); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php
    }
} 
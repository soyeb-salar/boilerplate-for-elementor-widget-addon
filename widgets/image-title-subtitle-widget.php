<?php
if (!defined('ABSPATH')) {
    exit;
}
// Exit if accessed directly

class EIT_Image_Title_Subtitle_Widget extends \Elementor\Widget_Base

{

    public function get_name()
    {
        return 'eit_image_title_subtitle';
    }

    public function get_title()
    {
        return __('Image Title Subtitle', 'plugin-name');
    }

    public function get_icon()
    {
        return 'eicon-image-box';
    }

    public function get_categories()
    {
        return ['general'];
    }

    protected function register_controls()
    {

        // Image Control Section
        $this->start_controls_section(
            'image_section',
            [
                'label' => __('Image', 'plugin-name'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'image',
            [
                'label' => __('Choose Image', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Image_Size::get_type(),
            [
                'name' => 'image_size',
                'default' => 'large',
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();

        // Title Control Section
        $this->start_controls_section(
            'title_section',
            [
                'label' => __('Title', 'plugin-name'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __('Title', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Your Title', 'plugin-name'),
                'placeholder' => __('Enter title', 'plugin-name'),
            ]
        );

        // Title Typography
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => __('Title Typography', 'plugin-name'),
                'selector' => '{{WRAPPER}} .eit-title',
            ]
        );

        // Title Color
        $this->add_control(
            'title_color',
            [
                'label' => __('Title Color', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eit-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Subtitle Control Section
        $this->start_controls_section(
            'subtitle_section',
            [
                'label' => __('Subtitle', 'plugin-name'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'subtitle',
            [
                'label' => __('Subtitle', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Your Subtitle', 'plugin-name'),
                'placeholder' => __('Enter subtitle', 'plugin-name'),
            ]
        );

        // Subtitle Typography
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'subtitle_typography',
                'label' => __('Subtitle Typography', 'plugin-name'),
                'selector' => '{{WRAPPER}} .eit-subtitle',
            ]
        );

        // Subtitle Color
        $this->add_control(
            'subtitle_color',
            [
                'label' => __('Subtitle Color', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eit-subtitle' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        // Image Rendering
        if (!empty($settings['image']['url'])) {
            echo '<div class="eit-image">';
            echo \Elementor\Group_Control_Image_Size::get_attachment_image_html($settings, 'image_size', 'image');
            echo '</div>';
        }

        // Title Rendering
        if (!empty($settings['title'])) {
            echo '<h2 class="eit-title" style="color:' . esc_attr($settings['title_color']) . ';">' . esc_html($settings['title']) . '</h2>';
        }

        // Subtitle Rendering
        if (!empty($settings['subtitle'])) {
            echo '<p class="eit-subtitle" style="color:' . esc_attr($settings['subtitle_color']) . ';">' . esc_html($settings['subtitle']) . '</p>';
        }
    }

    protected function _content_template()
    {
        ?>
    <#
    // Check if image is selected and output the image HTML
    var image = settings.image.url ? '<img src="' + settings.image.url + '" />' : '';

    #>
    <div class="eit-widget">
        <# if ( image ) { #>
            <div class="eit-image">{{{ image }}}</div>
        <# } #>

        <# if ( settings.title ) { #>
            <h2 class="eit-title" style="color: {{ settings.title_color }};">{{{ settings.title }}}</h2>
        <# } #>

        <# if ( settings.subtitle ) { #>
            <p class="eit-subtitle" style="color: {{ settings.subtitle_color }};">{{{ settings.subtitle }}}</p>
        <# } #>
    </div>
    <?php
}

}

<?php

/**
 * Material Cards Widget Class
 *
 * @package           EasySliderForElementor
 * @author            Krunal Kanojiya
 * @copyright         2023 Krunal Kanojiya
 * @license           GPL-2.0-or-later
 */

if(!defined ('ABSPATH')){
	exit;
}

class Elementor_Easy_Slider extends \Elementor\Widget_Base {

	public function get_script_depends() {
		return [ 'easy-slider-script-1','easy-slider-script-2' ];
	}

	public function get_style_depends() {
		return [ 'easy-slider-style-1','easy-slider-style-2' ];
	}

	public function get_name() {
		return 'easy_slider_for_elementor';
	}

	public function get_title() {
		return esc_html__( 'Easy Slider', 'easy-slider-for-elementor' );
	}

	public function get_icon() {
		// return 'eicon-code';
        return 'eicon-slider-push';
	}

	public function get_categories() {
		return [ 'basic' ];
	}

	public function get_keywords() {
		return [ 'hello', 'world' ];
		
	}

	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'easy-slider-for-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'image',
			[
				'label' => esc_html__( 'Choose Image', 'easy-slider-for-elementor' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_control(
			'list',
			[
				'label' => esc_html__( 'Image List', 'easy-slider-for-elementor' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'list_title' => esc_html__( 'Image', 'easy-slider-for-elementor' ),
					],
					[
						'list_title' => esc_html__( 'Image', 'easy-slider-for-elementor' ),
					],
					[
						'list_title' => esc_html__( 'Image', 'easy-slider-for-elementor' ),
					]
				],
				'title_field' => '{{{ list_title }}}',
			]
		);
		$this->end_controls_section();

	}

	protected function render() {
		
		$settings = $this->get_settings_for_display();

		if ( $settings['list'] ) {
			echo '<div class="owl-carousel owl-theme">';
			foreach (  $settings['list'] as $item ) {
				?>
				
				<div class="item">
					<img src="<?php echo $item['image']['url'] ?>" alt="dummy"/>
				</div>

				<?php
			}
			echo '</div>';
		}

		?>
		<script>
			jQuery(document).ready(function () {
				jQuery(".owl-carousel").owlCarousel({
						loop: true,
						margin: 10,
						responsiveClass: true,
						autoplay:true,
						autoplayTimeout:1000,
						autoplayHoverPause:true,
						rewind:true,
						responsive: {
						0: {
							items: 1,
							nav: true,
						},
						600: {
							items: 3,
							nav: false,
						},
						1000: {
							items: 3,
							nav: true,
							loop: false,
						},
						},
					})
				}
			);
    </script>

		<?php
	}
}
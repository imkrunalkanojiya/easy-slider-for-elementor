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
		return [ 'general' ];
	}

	public function get_keywords() {
		return [ 'slider', 'carousel' ];
		
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
					],
					[
						'list_title' => esc_html__( 'Image', 'easy-slider-for-elementor' ),
					]
				],
				'title_field' => '{{{ list_title }}}',
			]
		);
		$this->end_controls_section();



		$this->start_controls_section(
			'style_section',
			[
				'label' => esc_html__( 'Carousel Style', 'easy-slider-for-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'c_loop',
			[
				'label' => esc_html__( 'Loop', 'easy-slider-for-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'easy-slider-for-elementor' ),
				'label_off' => esc_html__( 'Hide', 'easy-slider-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'c_autoplay',
			[
				'label' => esc_html__( 'Autoplay', 'easy-slider-for-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'easy-slider-for-elementor' ),
				'label_off' => esc_html__( 'Hide', 'easy-slider-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'c_autoplayhoverpause',
			[
				'label' => esc_html__( 'Autoplay Hover Pause', 'easy-slider-for-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'easy-slider-for-elementor' ),
				'label_off' => esc_html__( 'Hide', 'easy-slider-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'c_autoplaytimeout',
			[
				'label' => esc_html__( 'Autoplay Timout', 'easy-slider-for-elementor' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1000,
				'max' => 6000,
				'step' => 100,
				'default' => 1000,
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
					<img src="<?php echo $item['image']['url'] ?>" alt="carousel-image"/>
				</div>

				<?php
			}
			echo '</div>';
		}

		?>
		<script>
			jQuery(document).ready(function () {

				let sLoop = <?php echo ($settings['c_loop'] === 'yes') ? "true" : "false"; ?>;
				let sAutoPlay = <?php echo ($settings['c_autoplay'] === 'yes') ? "true" : "false"; ?>;
				let sAutoPlayHoverPause = <?php echo ($settings['c_autoplayhoverpause'] === 'yes') ? "true" : "false"; ?>;
				let sAutoPlayTimeOut = <?php echo $settings['c_autoplaytimeout'] ?>

				jQuery(".owl-carousel").owlCarousel({
						loop: sLoop,
						margin: 10,
						responsiveClass: true,
						autoplay: sAutoPlay,
						autoplayTimeout:sAutoPlayTimeOut,
						autoplayHoverPause:sAutoPlayHoverPause,
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
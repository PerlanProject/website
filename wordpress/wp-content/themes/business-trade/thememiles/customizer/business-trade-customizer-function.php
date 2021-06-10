<?php
/**
 * Define some custom classes for nexas.
 * 
 * https://codex.wordpress.org/Class_Reference/WP_Customize_Control
 *
 * @package ThemeMiles
 * @subpackage ThemeMiles
 * @since 1.0.0
 */

if ( class_exists( 'WP_Customize_Control' ) ) {
	   	
	/**
	 * A class to create a dropdown for all categories in your WordPress site
	 *
	 * @since 1.0.0
	 * @nexas public
	 */
	class Business_Trade_Customize_Category_Control extends WP_Customize_Control {
		
		/**
		 * Render the control's content.
		 *
		 * @return void
		 * @since 1.0.0
		 */
		public function render_content() {
			$education_way_dropdown = wp_dropdown_categories(
					array(
						'name'              => 'customize-dropdown-categories' . $this->id,
						'echo'              => 0,
						'show_option_none'  => esc_html__( '&mdash; Select Category &mdash;','business-trade'),
						'option_none_value' => '0',
						'selected'          => $this->value(),
					)
			);

			// Hackily add in the data link parameter.
			$education_way_dropdown = str_replace( '<select', '<select ' . $this->get_link(), $education_way_dropdown );

			printf(
				'<label class="customize-control-select"><span class="customize-control-title">%s</span><span class="description customize-control-description">%s</span> %s </label>',
				$this->label,
				$this->description,
				$education_way_dropdown
			);
		}
	}

	
}


/**
 * Alpha Color Picker Customizer Control
 *
 * This control adds a second slider for opacity to the stock WordPress color picker,
 * and it includes logic to seamlessly convert between RGBa and Hex color values as
 * opacity is added to or removed from a color.
 *
 * This Alpha Color Picker is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this Alpha Color Picker. 
 */

if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'Business_Trade_Color_Control' )):

class Business_Trade_Color_Control extends WP_Customize_Control {
    /**
     * Official control name.
     */
    public $type = 'alpha-color';
    /**
     * Add support for palettes to be passed in.
     *
     * Supported palette values are true, false, or an array of RGBa and Hex colors.
     */
    public $palette;
    /**
     * Add support for showing the opacity value on the slider handle.
     */
    public $show_opacity;
    /**
     * Enqueue scripts and styles.
     *
     * Ideally these would get registered and given proper paths before this control object
     * gets initialized, then we could simply enqueue them here, but for completeness as a
     * stand alone class we'll register and enqueue them here.
     */

    /**
     * Render the control.
     */
    public function render_content() {
        // Process the palette
        if ( is_array( $this->palette ) ) {
            $palette = implode( '|', $this->palette );
        } else {
            // Default to true.
            $palette = ( false === $this->palette || 'false' === $this->palette ) ? 'false' : 'true';
        }
        // Support passing show_opacity as string or boolean. Default to true.
        $show_opacity = ( false === $this->show_opacity || 'false' === $this->show_opacity ) ? 'false' : 'true';
        // Begin the output. ?>
        <label>
            <?php // Output the label and description if they were passed in.
            if ( isset( $this->label ) && '' !== $this->label ) {
                echo '<span class="customize-control-title">' . sanitize_text_field( $this->label ) . '</span>';
            }
            if ( isset( $this->description ) && '' !== $this->description ) {
                echo '<span class="description customize-control-description">' . sanitize_text_field( $this->description ) . '</span>';
            } ?>
            <input class="alpha-color-control" type="text" data-show-opacity="<?php echo $show_opacity; ?>" data-palette="<?php echo esc_attr( $palette ); ?>" data-default-color="<?php echo esc_attr( $this->settings['default']->default ); ?>" <?php $this->link(); ?>  />
        </label>
        <?php
    }
}
 endif;




/**
     * A class to create a option separator in customizer section 
     *
     *@since 1.0.0
     */
if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'Business_Trade_Customize_Section_Separator' )):

    class Business_Trade_Customize_Section_Separator extends WP_Customize_Control {
        /**
         * The type of customize control being rendered.
         *
         * @since  1.0.0
         * @access public
         * @var    string
         */
        public $type = 'business_trade_separator';

        /**
         * Displays the control content.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        public function render_content() {
    ?>
        
    <?php
        }
    }

 endif;
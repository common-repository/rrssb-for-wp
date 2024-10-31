<?php

/**
 * Provide a admin area view for the plugin.
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://www.codigitus.com
 * @since      1.0.0
 */
?>
<div class="wrap">
	<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
	<form method="post" name="rrssb_options" action="options.php">
		<?php
		settings_fields( $this->plugin_name );
		$settings = get_option( $this->plugin_name );
		$buttons  = $settings['buttons'];
		?>
		<div class="rrssb-list">
			<h3><?php _e('Botones inactivos',$this->plugin_name); ?></h3>
			<ul class="rrssb-buttons rrssb-inactive">
				<?php
				$buttons_list = new Rrssb_For_Wp_Buttons( 'inactive', $buttons );
				echo $buttons_list->make_list_buttons();
				?>
			</ul>
		</div>

		<div class="rrssb-list">
			<h3><?php _e('Botones activos',$this->plugin_name); ?></h3>
			<ul class="rrssb-buttons rrssb-active">
				<?php
				$buttons_list = new Rrssb_For_Wp_Buttons( 'active', $buttons );
				echo $buttons_list->make_list_buttons();
				?>
			</ul>
		</div>

		<h3><?php _e('Visibilidad de los botones',$this->plugin_name); ?></h3>
		<table class="form-table">
			<tbody>
			<tr>
				<th scope="row">
					<?php _e('Mostrar botones en',$this->plugin_name); ?>
				</th>
				<td>
					<fieldset>
						<legend class="screen-reader-text"><span><?php _e('Mostrar botones en',$this->plugin_name); ?></span></legend>
						<?php foreach ( get_post_types( [ 'public' => true ], 'objects' ) as $post_type ) {
							$is_checked = in_array( $post_type->name, $settings['visibility'] ) ?
								$post_type->name : 0; ?>
							<label for="<?php echo $post_type->labels->name; ?>">
								<input name="<?php echo $this->plugin_name; ?>[visibility][<?php echo $post_type->name; ?>]"
								       type="checkbox"
								       id="<?php echo $this->plugin_name . '-' . $post_type->name; ?>" <?php checked( $is_checked, $post_type->name ); ?>
								       value="1">
								<span><?php echo ucfirst( $post_type->labels->name ); ?></span>
							</label>
							<br>
						<?php } ?>
					</fieldset>
				</td>
			</tr>

			<tr>
				<th scope="row">
					<label for="show_in"><?php _e('Lugar para mostrar',$this->plugin_name); ?></label>
				</th>
				<td>
					<select name="<?php echo $this->plugin_name; ?>[show_in]"
					        id="<?php echo $this->plugin_name; ?>-show_in">
						<option <?php selected( $settings['show_in'], 'top' ); ?> value="top">
							<?php _e('Parte superior (antes del contenido)',$this->plugin_name); ?>
						</option>
						<option <?php selected( $settings['show_in'], 'bottom' ); ?> value="bottom">
							<?php _e('Parte inferior (después del contenido)',$this->plugin_name); ?>
						</option>
						<option <?php selected( $settings['show_in'], 'top-and-bottom' ); ?> value="top-and-bottom">
							<?php _e('Parte superior e inferior (antes y después del contenido)',$this->plugin_name); ?>
						</option>
					</select>
				</td>
			</tr>
			<tr>
				<th scope="row">
					<label for="show_in"><?php _e('Excluir IDs',$this->plugin_name); ?></label>
				</th>
				<td>
					<input type="text" name="<?php echo $this->plugin_name; ?>[exclude_ids]"
					       id="<?php echo $this->plugin_name; ?>-exclude_ids"
					       value="<?php echo $settings['exclude_ids']; ?>">
					<p class="description" id="admin-exclude-ids-description">
						<?php _e('Introduzca los IDs separados por comas.',$this->plugin_name); ?></p>
				</td>
			</tr>
			</tbody>
		</table>

		<input type="hidden" id="<?php echo $this->plugin_name; ?>-buttons"
		       name="<?php echo $this->plugin_name; ?>[buttons]" value="<?php echo $buttons; ?>"/>
		
		<?php submit_button(); ?>
	</form>
</div>

<?php

/**
 * WIP
 *
 * Class Civicrm_Ux_Option_Store
 */
class Civicrm_Ux_Option_Store {

	/**
	 * array[option name]
	 *      ['instance']
	 *      ['default']
	 *
	 * @var array
	 */
	protected $options;

	public function __construct() {
		$this->options = [];

		// For membership
		$this->register_option( 'civicrm_summary_options', NULL, [
			'civicrm_summary_show_renewal_date'    => '30',
			'civicrm_summary_membership_join_URL'  => '/join/',
			'civicrm_summary_membership_renew_URL' => '/renew/',
		] );

		// For contributions
		$this->register_option( 'civicrm_contribution_ux', NULL, [
			'is_recur_default'     => FALSE,
			'is_autorenew_default' => FALSE,
		] );

		// For Plugins we wish to block
		$this->register_option( 'civicrm_plugin_activation_blocks', NULL, [
			'event_tickets' => TRUE,
		] );
	}

	public function register_option( $name, $instance, $default = '' ) {
		if ( in_array( $name, array_keys( $this->options ) ) ) {
			// TODO throw exception?
			return;
		}

		$this->options[ $name ] = [
			'instance' => $instance,
			'default'  => $default,
		];
	}

	public function get_option( $name ) {
		return get_option( $name, $this->options[ $name ]['default'] );
	}

	public function update_option( $name, $value, $autoload ) {
		return update_option( $name, $value, $autoload );
	}

	public function delete_option( $name ) {
		return delete_option( $name );
	}

	public function get_options() {
		return $this->options;
	}

}
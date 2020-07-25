<?php
namespace Wdr\App\Controllers\Admin\Tabs\Reports;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class RuleAmountWithCartDiscount extends RuleAmount {

    public function get_subtitle() {
        return __( 'Amount shown in default store currency', WDR_TEXT_DOMAIN );
    }

	protected function prepare_params( $params ) {
		$params['include_cart_discount'] = true;
		return $params;
	}
}
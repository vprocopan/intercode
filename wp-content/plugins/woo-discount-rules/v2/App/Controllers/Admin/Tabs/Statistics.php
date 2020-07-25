<?php

namespace Wdr\App\Controllers\Admin\Tabs;

use Wdr\App\Controllers\Configuration;
use Wdr\App\Helpers\Rule;
use Wdr\App\Controllers\Admin\Tabs\Reports;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Statistics extends Base
{
    public $priority = 30;
    protected $tab = 'statistics';
    protected $reports;
    protected $rule_details = array();


    /**
     * GeneralSettings constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->title = __('Reports', WDR_TEXT_DOMAIN);
        $rule_helper = new Rule();
        $available_conditions = $this->getAvailableConditions();
        $rules = $rule_helper->getAllRules($available_conditions);
        foreach ($rules as $rule){
            $rule_id = $rule->getId();
            $rule_title = $rule->getTitle();
            $this->rule_details[$rule_id] = array(
                'handler' => new Reports\RuleNameDiscount($rule),
                'label'   => __( $rule_title , WDR_TEXT_DOMAIN ),
                'group'   => __( 'Rule Name', WDR_TEXT_DOMAIN ),
                'rule_id'   => $rule_id,
            );
        }
        $this->reports = array(
            'rule_amount_extra' => array(
                'handler' => new Reports\RuleAmountWithCartDiscount(),
                'label'   => __( 'All Rules', WDR_TEXT_DOMAIN ),
                'group'   => __( 'Rule', WDR_TEXT_DOMAIN ),
                'rule_id'   => 0,
            ),
            'rule_amount' => array(
               'handler' => new Reports\RuleAmount(),
                'label'   => __( 'All Rules (except cart adjustment type)', WDR_TEXT_DOMAIN ),
                'group'   => __( 'Rule', WDR_TEXT_DOMAIN ),
                'rule_id'   => 0,
            ),
        );
        $this->reports = $this->reports+$this->rule_details;
    }

    /**
     * Render settings page
     * @param null $page
     * @return mixed|void
     */
    public function render($page = NULL)
    {

        $charts = array();
        foreach ( $this->reports as $k => $item ) {
            $group = $item['group'];
            if ( ! isset( $charts[ $group ] ) ) {
                $charts[ $group ] = array();
            }
            $charts[ $group ][ $k ] = $item['label'];
        }

        $params = array(
          'charts' => $charts,
        );
        self::$template_helper->setPath(WDR_PLUGIN_PATH . 'App/Views/Admin/Tabs/Statistics.php')->setData($params)->display();
    }

    /**
     * Get chart data for analytics
     */
    protected function ajax_get_chart_data() {
        parse_str( $_POST['params'], $params );
        $type = $params['type'];
        if ( isset( $this->reports[ $type ] ) ) {
            $handler = $this->reports[ $type ]['handler'];
            $data = $handler->get_data( $params );
            wp_send_json_success( $data );
        } else {
            wp_send_json_error();
        }
    }

}
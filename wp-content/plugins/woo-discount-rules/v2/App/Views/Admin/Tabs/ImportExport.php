<?php
if (!defined('ABSPATH')) exit;
use Wdr\App\Models\DBTable;
?>
<br>
<div class="wdr_settings ui-page-theme-a awdr-container">
    <div class="wdr_settings_container" style="border-bottom: 1px solid black; padding-bottom: 10px;">
        <div>
            <h3><?php _e('Export tool', WDR_TEXT_DOMAIN);?></h3>
            <div>
                <p>
                <form method="post">
                    <button type="submit" id="wdr-export" name="wdr-export" class="button button-primary">
                        <?php _e('Export', WDR_TEXT_DOMAIN);?>
                    </button>
                </form>
                </p>

            </div>
        </div>
    </div>
    <div class="wdr_settings_container" >
        <div>
            <h3><?php _e('Import Tool', WDR_TEXT_DOMAIN);?></h3>
            <div><?php
                $message = '';
                if (isset($_POST['wdr-import'])) {
                    $fileName = $_FILES["awdr_import_rule"]["tmp_name"];

                    if ($_FILES["awdr_import_rule"]["size"] > 0) {

                        $file = fopen($fileName, "r");
                        $current_date_time = '';
                        if (function_exists('current_time')) {
                            $current_time = current_time('timestamp');
                            $current_date_time = date('Y-m-d H:i:s', $current_time);
                        }
                        $current_user = get_current_user_id();
                        $i = 1;

                        while (($column = fgetcsv($file, 100000, ",")) !== FALSE) {
                            if($i == 1){
                                $i++;
                                continue;
                            }
                            $rule_id = isset($column[0]) ? $column[0] :  NULL;
                            $enabled = isset($column[1]) ? $column[1] :  0;
                            $deleted = isset($column[2]) ? $column[2] :  0;
                            $exclusive = isset($column[3]) ? $column[3] :  0;
                            $title = isset($column[4]) ? $column[4] :  "Untitled Rule";
                            $priority = isset($column[5]) ? $column[5] :  $rule_id;
                            $apply_to = isset($column[6]) ? $column[6] :  NULL;
                            $filters = isset($column[7]) ? $column[7] :  '[]';
                            $conditions = isset($column[8]) ? $column[8] :  '[]';
                            $product_adjustments = isset($column[9]) ? $column[9] :  "[]";
                            $cart_adjustment = isset($column[10]) ? $column[10] :  "[]";
                            $buy_x_get_x = isset($column[11]) ? $column[11] :  "[]";
                            $buy_x_get_y = isset($column[12]) ? $column[12] :  "[]";
                            $bulk_adjustment = isset($column[13]) ? $column[13] :  "[]";
                            $set_adjustment = isset($column[14]) ? $column[14] :  "[]";
                            $other_discount = isset($column[15]) ? $column[15] :  NULL;
                            $date_from = isset($column[16]) ? $column[16] :  NULL;
                            $date_to = isset($column[17]) ? $column[17] :  NULL;
                            $usage_limits = isset($column[18]) ? $column[18] :  0;
                            $rule_language = isset($column[19]) ? $column[19] :  "[]";
                            $used_limits = isset($column[20]) ? $column[20] :  0;
                            $additional = isset($column[21]) ? $column[21] :  '{"condition_relationship":"and"}';
                            $max_discount_sum = isset($column[22]) ? $column[22] :  NULL;
                            $advanced_discount_message = isset($column[23]) ? $column[23] :  '{"display":"0","badge_color_picker":"#ffffff","badge_text_color_picker":"#000000","badge_text":""}';
                            $discount_type = isset($column[24]) ? $column[24] :  "wdr_simple_discount";
                            $used_coupons = isset($column[25]) ? $column[25] :  "[]";
                            $created_by = isset($column[26]) ? $column[26] :  $current_user;
                            $created_on = isset($column[27]) ? $column[27] :  $current_date_time;
                            $modified_by = isset($column[28]) ? $column[28] :  $current_user;
                            $modified_on = isset($column[29]) ? $column[29] :  $current_date_time;


                            $arg = array(
                                'enabled' => $enabled,
                                'deleted' => $deleted,
                                'exclusive' => $exclusive,
                                'title' => (empty($title)) ? esc_html__('Untitled Rule', WDR_TEXT_DOMAIN) : $title,
                                'priority' => $priority,
                                'apply_to' => $apply_to,
                                'filters' => $filters,
                                'conditions' => $conditions,
                                'product_adjustments' => $product_adjustments,
                                'cart_adjustments' => $cart_adjustment,
                                'buy_x_get_x_adjustments' => $buy_x_get_x,
                                'buy_x_get_y_adjustments' => $buy_x_get_y,
                                'bulk_adjustments' => $bulk_adjustment,
                                'set_adjustments' => $set_adjustment,
                                'other_discounts' => $other_discount,
                                'date_from' => $date_from,
                                'date_to' => $date_to,
                                'usage_limits' => $usage_limits,
                                'rule_language' => $rule_language,
                                'used_limits' => $used_limits,
                                'additional' => $additional,
                                'max_discount_sum' => $max_discount_sum,
                                'advanced_discount_message' => $advanced_discount_message,
                                'discount_type' => $discount_type,
                                'used_coupons' => $used_coupons,
                                'created_by' => $created_by,
                                'created_on' => $created_on,
                                'modified_by' => $modified_by,
                                'modified_on' => $modified_on,
                            );


                            $column_format = array('%d','%d','%d', '%s', '%d', '%d', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%d', '%d', '%d', '%s', '%d','%s','%d','%s','%s','%s','%d', '%s', '%d', '%s');

                            $rule_id = DBTable::saveRule($column_format, $arg);

                            if (!empty($rule_id)) {
                                $type = "success";
                                $message = __('<b style="color: green;">Rules Imported successfully</b>', WDR_TEXT_DOMAIN);
                            } else {
                                $type = "error";
                                $message = __('<b style="color: red;">Problem in Importing CSV Data</b>', WDR_TEXT_DOMAIN);
                                break;
                            }
                        }
                    }
                }?>
                <form method="post" name="awdr-import-csv" id="awdr-import-csv" enctype="multipart/form-data">
                    <input type="file" name="awdr_import_rule" id="awdr-file-uploader" accept=".csv"><br>
                    <span id="awdr-upload-response"><?php echo $message;?></span></br>
                    <button type="submit" id="wdr-import" name="wdr-import" class="button button-primary">
                        <?php _e('Import', WDR_TEXT_DOMAIN);?>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
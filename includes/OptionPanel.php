<?php

namespace AllInOneTrackingWoocommerce\includes;

class OptionPanel extends \WC_Settings_Page
{
    protected $current_section;

    public function __construct()
    {
        global $current_section;

        $this->id = 'wootaio';
        $this->label = __('Order Tracking', 'all-in-one-tracking-woocommerce');
        $this->current_section = $current_section;
        parent::__construct();
    }
    public function get_settings_for_default_section()
    {
        return [
            'section_title_1' => [
                'name' => __('Tracking Status Configurations', 'all-in-one-tracking-woocommerce'),
                'type' => 'title',
                'id' => 'wc_settings_tab_wootaio_title'
            ],
            'message_template' => [
	            'name' => __('template', 'all-in-one-tracking-woocommerce'),
	            'type' => 'textarea',
	            'id' => 'wootaio_setting_template',
	            'css' => 'max-width:550px;width:100%;',
	            'default' => file_get_contents(WOOTAIO_PLUGIN_PATH . '/default-template.htm'),
	            'custom_attributes' => ['rows' => 10],
            ],
            'section_end' => [
                'type' => 'sectionend',
                'id' => 'wc_settings_tab_wootaio_end_section'
            ],
        ];
    }

    public function save()
    {
        parent::save();
    }
}
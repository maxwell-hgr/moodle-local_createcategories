<?php
defined('MOODLE_INTERNAL') || die();

if ($hassiteconfig) {
    $settings = new admin_settingpage('local_create_categories', 'Create Categories');

    $settings->add(new admin_setting_configtext(
        'local_create_categories/prefix',
        'Categories prefix',
        'Define the prefix for the categories.',
        '2025.1',
        PARAM_TEXT
    ));

    $ADMIN->add('localplugins', $settings);

    $ADMIN->add('courses', new admin_externalpage(
        'local_create_categories_index',
        'Create Categories',
        new moodle_url('/local/create_categories/index.php'),
        'moodle/site:config'
    ));
}

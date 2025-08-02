<?php

require_once(__DIR__ . '/../../config.php');
require_once('lib.php');

require_login();

$context = context_system::instance();
require_capability('moodle/site:config', $context);

$PAGE->set_url(new moodle_url('/local/create_categories/index.php'));
$PAGE->set_context(context_system::instance());
$PAGE->set_title(get_string('pluginname', 'local_create_categories'));
$PAGE->set_heading(get_string('pluginname', 'local_create_categories'));

if (optional_param('executar', false, PARAM_BOOL)) {
    local_create_categories_function();
    redirect($PAGE->url, get_string('success', 'local_create_categories'), null, \core\output\notification::NOTIFY_SUCCESS);
}

echo $OUTPUT->header();
echo $OUTPUT->single_button(
    new moodle_url('/local/create_categories/index.php', ['executar' => 1]),
    get_string('createcategories', 'local_create_categories')
);
echo $OUTPUT->footer();

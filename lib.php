<?php
defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/course/lib.php');

function local_create_categories_function() {
    global $DB;

    $prefix = get_config('local_create_categories', 'prefix') ?: '2025.1';
    $json_structure = get_config('local_create_categories', 'json_structure');

    $categories_data = json_decode($json_structure, true);

    if (empty($categories_data)) {
        throw new moodle_exception('error_json_invalid', 'local_create_categories', '', 'Estrutura JSON inválida ou vazia.');
    }

    try {
        $transaction = $DB->start_delegated_transaction();

        $main_category = \core_course_category::create([
            'name' => $prefix,
            'parent' => 0,
            'visible' => 1
        ]);

        $create_recursive = function($parent_id, $items) use ($prefix, &$create_recursive) {
            foreach ($items as $item) {
                if (is_array($item) && isset($item['name'])) {
                    $cat = \core_course_category::create([
                        'name' => "{$prefix}-" . $item['name'],
                        'parent' => $parent_id,
                        'visible' => 1
                    ]);
                    if (!empty($item['subcategories'])) {
                        $create_recursive($cat->id, $item['subcategories']);
                    }
                } else {
                    \core_course_category::create([
                        'name' => "{$prefix}-" . (string)$item,
                        'parent' => $parent_id,
                        'visible' => 1
                    ]);
                }
            }
        };

        $create_recursive($main_category->id, $categories_data);

        $DB->commit_delegated_transaction($transaction);
        return true;
    } catch (Exception $e) {
        $DB->rollback_delegated_transaction($transaction);
        throw $e;
    }
}
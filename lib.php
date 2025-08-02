<?php

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/course/lib.php');
require_once($CFG->dirroot . '/course/classes/category.php');

function local_create_categories_function() {
    global $DB;

    try {
        $transaction = $DB->start_delegated_transaction();

        $prefix = get_config('local_create_categories', 'prefix') ?? '2025.1';

        $categories = [
            'categories' => [
                'Gama',
                'Ceilândia',
                'Planaltina',
                [
                    'name' => 'Campus Darcy Ribeiro',
                    'subcategories' => [
                        'Assessoria de Assuntos Internacionais',
                        'Centro de Apoio ao Desenvolvimento Tecnológico - CDT',
                        'Centro de Desenvolvimento Sustentável - CDS',
                        'Centro de Excelência em Turismo',
                        'Centro de Estudos Avançados Multidisciplinares',
                        'Faculdade de Arquitetura e Urbanismo',
                        'Faculdade de Ciência da Informação',
                        'Faculdade de Ciências da Saúde',
                        'Faculdade de Medicina - Medicina',
                        'Faculdade de Comunicação',
                        'Faculdade de Direito',
                        'Faculdade de Educação - Pedagogia',
                        [
                            'name' => 'Faculdade de Tecnologia e Engenharias',
                            'subcategories' => [
                                'Engenharia Civil e Ambiental',
                                'Estruturas e Construção Civil',
                                'Engenharia de Produção',
                                'Engenharia de Segurança do Trabalho',
                                'Engenharia Elétrica',
                                'Engenharia Florestal',
                                'Engenharia Mecânica',
                                'Engenharia Mecatrônica',
                                'Geotecnia',
                                'Transporte'
                            ]
                        ],
                        'Faculdade de Educação Física',
                        'Instituto de Ciência Política',
                        [
                            'name' => 'Instituto de Artes',
                            'subcategories' => [
                                'Música',
                                'Desenho Industrial',
                                'Artes Visuais',
                                'Artes Cênicas'
                            ]
                        ],
                        'Instituto de Ciências Biológicas',
                        [
                            'name' => 'Instituto de Ciências Exatas',
                            'subcategories' => [
                                'Matemática',
                                'Ciência Computação',
                                'Estatística'
                            ]
                        ],
                        'Mestrado Profissional em Computação Aplicada',
                        [
                            'name' => 'Instituto de Ciências Humanas',
                            'subcategories' => [
                                'Serviço Social',
                                'Geografia',
                                'História',
                                'Filosofia'
                            ]
                        ],
                        'Estudos Latino Americanos',
                        [
                            'name' => 'Instituto de Ciências Sociais',
                            'subcategories' => [
                                'Antropologia'
                            ]
                        ],
                        'Instituto de Relações Internacionais',
                        'Instituto de Física',
                        'Sociologia',
                        'Instituto de Geociências',
                        'Instituto de Letras',
                        'Instituto de Psicologia',
                        'Instituto de Química',
                        'Hospital Universitário',
                        'Decanato de Ensino de Graduação',
                        'Decanato de Pós-Graduação',
                        'Decanato de Extensão',
                        'Decanato de Gestão de Pessoas',
                        'Outros Departamento/Unidade não cadastrado',
                        'Faculdade de Administração e Ciências Econômica - FACE',
                        'Centro UnB Cerrado - CER',
                        'Espaços comunitários'
                    ]
                ]
            ]
        ];

        function create_category($parent_id, $category_data, $prefix) {
            foreach ($category_data as $item) {
                if (is_array($item) && isset($item['name'])) {
                    $category = \core_course_category::create([
                        'name' => "$prefix-" . $item['name'],
                        'description' => '',
                        'visible' => 1,
                        'parent' => $parent_id
                    ]);

                    if (isset($item['subcategories'])) {
                        create_category($category->id, $item['subcategories'], $prefix);
                    }
                } else {
                    \core_course_category::create([
                        'name' => "$prefix-$item",
                        'description' => '',
                        'visible' => 1,
                        'parent' => $parent_id
                    ]);
                }
            }
        }

        $main_category = \core_course_category::create([
            'name' => $prefix,
            'description' => '',
            'visible' => 1,
            'parent' => 0
        ]);

        create_category($main_category->id, $categories['categories'], $prefix);

        $DB->commit_delegated_transaction($transaction);

        return true;
    } catch (Exception $e) {
        if (isset($transaction)) {
            $DB->rollback_delegated_transaction($transaction);
        }
        error_log("Error creating categories: " . $e->getMessage());
        return false;
    }
}

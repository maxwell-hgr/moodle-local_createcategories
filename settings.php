<?php
defined('MOODLE_INTERNAL') || die();

if ($hassiteconfig) {
    $settings = new admin_settingpage('local_create_categories', get_string('pluginname', 'local_create_categories'));

    $settings->add(new admin_setting_configtext(
        'local_create_categories/prefix',
        'Prefixo das Categorias',
        'Define o prefixo (ex: 2025.1)',
        '2025.1',
        PARAM_TEXT
    ));

    $default_json = '[
                          "Gama",
                          "Ceilândia",
                          "Planaltina",
                          {
                            "name": "Campus Darcy Ribeiro",
                            "subcategories": [
                              "Assessoria de Assuntos Internacionais",
                              "Centro de Apoio ao Desenvolvimento Tecnológico - CDT",
                              "Centro de Desenvolvimento Sustentável - CDS",
                              "Centro de Excelência em Turismo",
                              "Centro de Estudos Avançados Multidisciplinares",
                              "Faculdade de Arquitetura e Urbanismo",
                              "Faculdade de Ciência da Informação",
                              "Faculdade de Ciências da Saúde",
                              "Faculdade de Medicina - Medicina",
                              "Faculdade de Comunicação",
                              "Faculdade de Direito",
                              "Faculdade de Educação - Pedagogia",
                              {
                                "name": "Faculdade de Tecnologia e Engenharias",
                                "subcategories": [
                                  "Engenharia Civil e Ambiental",
                                  "Estruturas e Construção Civil",
                                  "Engenharia de Produção",
                                  "Engenharia de Segurança do Trabalho",
                                  "Engenharia Elétrica",
                                  "Engenharia Florestal",
                                  "Engenharia Mecânica",
                                  "Engenharia Mecatrônica",
                                  "Geotecnia",
                                  "Transporte"
                                ]
                              },
                              "Faculdade de Educação Física",
                              "Instituto de Ciência Política",
                              {
                                "name": "Instituto de Artes",
                                "subcategories": [
                                  "Música",
                                  "Desenho Industrial",
                                  "Artes Visuais",
                                  "Artes Cênicas"
                                ]
                              },
                              "Instituto de Ciências Biológicas",
                              {
                                "name": "Instituto de Ciências Exatas",
                                "subcategories": [
                                  "Matemática",
                                  "Ciência Computação",
                                  "Estatística"
                                ]
                              },
                              "Mestrado Profissional em Computação Aplicada",
                              {
                                "name": "Instituto de Ciências Humanas",
                                "subcategories": [
                                  "Serviço Social",
                                  "Geografia",
                                  "História",
                                  "Filosofia"
                                ]
                              },
                              "Estudos Latino Americanos",
                              {
                                "name": "Instituto de Ciências Sociais",
                                "subcategories": [
                                  "Antropologia"
                                ]
                              },
                              "Instituto de Relações Internacionais",
                              "Instituto de Física",
                              "Sociologia",
                              "Instituto de Geociências",
                              "Instituto de Letras",
                              "Instituto de Psicologia",
                              "Instituto de Química",
                              "Hospital Universitário",
                              "Decanato de Ensino de Graduação",
                              "Decanato de Pós-Graduação",
                              "Decanato de Extensão",
                              "Decanato de Gestão de Pessoas",
                              "Outros Departamento/Unidade não cadastrado",
                              "Faculdade de Administração e Ciências Econômica - FACE",
                              "Centro UnB Cerrado - CER",
                              "Espaços comunitários"
                            ]
                          }
                        ]';

    $settings->add(new admin_setting_configtextarea(
        'local_create_categories/json_structure',
        'Estrutura das Categorias (JSON)',
        'Insira a estrutura em formato JSON. Exemplo: ["Cat1", {"name": "Pai", "subcategories": ["Filho"]}]',
        $default_json,
        PARAM_RAW
    ));

    $ADMIN->add('localplugins', $settings);

    $ADMIN->add('courses', new admin_externalpage(
        'local_create_categories_index',
        'Create Categories',
        new moodle_url('/local/create_categories/index.php'),
        'moodle/site:config'
    ));
}
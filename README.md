# CEAD - Moodle Plugin: Local CREATECATEGORIES
## Descrição
Esse plugin cria a estrutura de categorias necessária para gerenciamento de cursos por parte da equipe de TI.
**Todos os semestres um membro da equipe deve revisar o JSON e gerar a estrutura para que os cursos sejam gerenciados da melhor forma.**

## Instalação
1. Copie a pasta do plugin para moodle_root/local/.
2. Acesse o Moodle como administrador para terminar a instalação.
3. Uma estrutura JSON padrão foi pré-configurada, na instalação do plugin será possível revisar essa estrutura por meio da página settings.

## Uso
1. Visite a página Administração do Site -> Plugins (em plugins locais) -> Create Categories
2. Revise a estrutura JSON com os campus, categorias e subcategorias
3. A cada semestre o prefixo deve obrigatoriamente ser atualizado. Ex: O segundo semestre de 2026 corresponde ao prefixo 2026.2
4. Vá para a página Administração do Site -> Cursos -> Create Categories
5. Clique no botão 'Create Categories'
6. Verifique se a estrutura foi criada corretamente

## Recursos
 - Criação automática de toda a estrutura de categorias, diminuindo consideravelmente o tempo gasto para a tarefa.
 - Gerenciamento do JSON dinâmico para possíveis atualizações na estrutura.
 - Criação das categorias com um click por meio da página index.php.

## Requisitos
 - Moodle 4.1 ou maior.
 - PHP 7.3 ou maior.
 - Permissão de Admin.

## License
This project is licensed under the GNU General Public License.

## Author
Maxwell H. S. Souza

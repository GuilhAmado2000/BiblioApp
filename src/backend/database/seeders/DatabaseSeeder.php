<?php

namespace Database\Seeders;

use App\Models\BookType;
use App\Models\Category;
use App\Models\Language;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Idiomas dos livros
        $languages = [
            ['name' => 'Português', 'code' => 'pt'],
            ['name' => 'Espanhol', 'code' => 'es'],
            ['name' => 'Francês', 'code' => 'fr'],
            ['name' => 'Inglês', 'code' => 'en'],
            ['name' => 'Alemão', 'code' => 'de'],
            ['name' => 'Holandês', 'code' => 'nl'],
            ['name' => 'Italiano', 'code' => 'it'],
            ['name' => 'Russo', 'code' => 'ru'],
            ['name' => 'Chinês (Mandarim)', 'code' => 'zh'],
            ['name' => 'Hindi', 'code' => 'hi'],
            ['name' => 'Árabe', 'code' => 'ar'],
            ['name' => 'Grego', 'code' => 'el'],
            ['name' => 'Latim', 'code' => 'la'],
        ];

        // Criar languages
        foreach ($languages as $language) {
            Language::firstOrCreate(
                ['name' => $language['name']],
                ['code' => $language['code']]
            );
        }

        // Categorias dos livros (conteúdo)
        $categories = [
            ['name' => 'Ficção'],
            ['name' => 'Não Ficção'],

            ['name' => 'Infantil'],
            ['name' => 'Juvenil'],
            ['name' => 'Jovem Adulto'],

            ['name' => 'Poesia'],
            ['name' => 'Teatro'],
            ['name' => 'Banda Desenhada e Manga'],

            ['name' => 'Ciência e Tecnologia'],
            ['name' => 'Direito e Política'],
            ['name' => 'Educação'],
            ['name' => 'Saúde e Bem-estar'],
            ['name' => 'Religião'],
            ['name' => 'Línguas'],
            ['name' => 'Arte e Cultura'],
            ['name' => 'Lazer'],

            ['name' => 'Regional'],
            ['name' => 'Periódicas'],
            ['name' => 'Trabalhos Académicos']
        ];

        // Criar categories
        foreach ($categories as $category) {
            Category::firstOrCreate(
                ['name' => $category['name']],
                ['slug' => Str::slug($category['name'])]
            );
        }

        $this->associateCategory();

        // Quanto à estrutura física
        $types_book = [
            ['name' => 'Capa dura',
                'description' => 'Encadernação rígida e resistente'],
            ['name' => 'Capa mole',
                'description' => 'Encadernação flexível, leve e económica'],
            ['name' => 'Edição de bolso',
                'description' => 'Versão compacta com formato e tipografia reduzidos. Portátil e acessível'],
            ['name' => 'Edição de colecionador',
                'description' => 'Papel especial, capa decorada e de edição limitada'],
            ['name' => 'Encadernação espiral',
                'description' => 'Encadernação em espiral (abre 360°) - (livros técnicos ou agendas)'],
            ['name' => 'Livro pop-up / interativo',
                'description' => 'Com elementos tridimensionais, abas ou janelas (livros infantis ou artísticos)'],
            ['name' => 'Livro cartonado',
                'description' => 'Feito com páginas grossas (cartão) - (livros infantis)'],
            ['name' => 'eBook',
                'description' => 'Formato digital de leitura, compatível com dispositivos eletrónicos'],
            ['name' => 'Audiobooks',
                'description' => 'Versão em áudio narrado do livro'],
            ['name' => 'Braille',
                'description' => 'Sistema tátil em relevo, destinado a leitores com deficiência visual'],
            ['name' => 'Fonte ampliada',
                'description' => 'Versão com letras grandes para acessibilidade visual'],
        ];

        // Criar book types
        foreach ($types_book as $type) {
            BookType::firstOrCreate(
                ['name' => $type['name']],
                ['description' => $type['description']]
            );
        }
    }

    private function associateCategory(): void
    {
        $map = [
            'Ficção' => [
                'Clássico', 'Romance', 'Policial | Mistério', 'Terror | Horror',
                'Contos', 'Fantasia', 'Novela', 'Ficção Científica',
                'Aventura', 'Distopia | Pós-apocalíptico', 'Drama'
            ],
            'Não Ficção' => [
                'Biografia', 'Autobiografia', 'História', 'Atualidade | Sociedade | Política',
                'Comédia | Humor', 'Filosofia', 'Psicologia'
            ],
            'Educação' => [
                'Apoio Escolar', 'Manual Escolar', 'Outros'
            ],
            'Lazer' => [
                'Gastronomia', 'Desporto', 'Viagens', 'Passatempos'
            ],
            'Regional' => [
                'Porto de Mós', 'Leiria', 'Outros'
            ],
            'Periódicas' => [
                'Revistas', 'Jornais'
            ],
            'Trabalhos Académicos' => [
                'Teses', 'Dissertações', 'Relatórios', 'Artigos Científicos', 'Outros'
            ],
        ];

        foreach ($map as $parentName => $childrenNames) {
            $parent = Category::where('name', $parentName)->first();

            if (!$parent) {
                // Evita erro se a categoria não existir
                continue;
            }

            foreach ($childrenNames as $childName) {
                Category::firstOrCreate(
                    ['name' => $childName],
                    [
                        'id' => Str::uuid(),
                        'parent_id' => $parent->id,
                        'slug' => Str::slug($childName),
                    ]
                );
            }
        }
    }
}

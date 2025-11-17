<?php

namespace App\Http\Services;

use App\Http\Repositories\PersonagemRepository;
use Faker\Factory;
use Illuminate\Support\Facades\Http;

class PersonagemService
{
    protected PersonagemRepository $personagemRepository;

    public function __construct(PersonagemRepository $personagemRepository)
    {
        $this->personagemRepository = $personagemRepository;
    }

    public function index(int $userId)
    {
        return $this->personagemRepository->byUser($userId);
    }

    public function generatePersonagemData()
    {
        $faker = Factory::create('pt_BR');

        $nome = $faker->firstName();
        $sobrenome = $faker->lastName();

        $exemplosHistorias = [
            'Acólito: Cresceu servindo em um templo, aprendendo rituais sagrados e ajudando fiéis.',
            'Soldado: Lutou em batalhas pelo reino, conhece táticas de guerra e tem contatos militares.',
            'Forasteiro: Viveu isolado na natureza, entendendo trilhas, sobrevivência e caçadas.',
            'Charlatão: Mestre dos disfarces e truques, consegue manipular quase qualquer um.',
            'Nobre: Tem influência política, foi educado em etiqueta e possui bens herdados.',
            'Artesão de Guilda: Pertence à guilda famosa, sabe negociar e possui colegas influentes.',
            'Náufrago: Sobreviveu a desastres, desenvolveu habilidades de sobrevivência em ilhas remotas.',
        ];
        $historia = $exemplosHistorias[array_rand($exemplosHistorias)];

        $inventariosBase = [
            'Espada curta, capa resistente, kit de aventureiro',
            'Machado de batalha, escudo de madeira, mochila de viagem',
            'Arco longo, aljava com flechas, mapa antigo',
            'Livro de magia, amuleto sagrado, túnica bordada',
            'Bolsa de moedas, carta misteriosa, lanterna',
        ];
        $inventario = $inventariosBase[array_rand($inventariosBase)];

        // Atributos
        $atributos = [
            'forca'         => $faker->numberBetween(8, 18),
            'destreza'      => $faker->numberBetween(8, 18),
            'constituicao'  => $faker->numberBetween(8, 18),
            'inteligencia'  => $faker->numberBetween(8, 18),
            'sabedoria'     => $faker->numberBetween(8, 18),
            'carisma'       => $faker->numberBetween(8, 18),
        ];

        // Classe
        $classeResp = Http::get('https://www.dnd5eapi.co/api/classes/');
        $classes = $classeResp->json()['results'] ?? [];
        $idxClasse = array_rand($classes);
        $classeEscolhida = $classes[$idxClasse]['name'] ?? 'Guerreiro';
        $classeIndex = $classes[$idxClasse]['index'] ?? null;
        $classeDetalhes = [];
        if ($classeIndex) {
            $detalheClasseResp = Http::get("https://www.dnd5eapi.co/api/classes/$classeIndex");
            $classeDetalhes = $detalheClasseResp->json();
        }

        // Raça
        $racaResp = Http::get('https://www.dnd5eapi.co/api/races/');
        $racas = $racaResp->json()['results'] ?? [];
        $idxRaca = array_rand($racas);
        $racaEscolhida = $racas[$idxRaca]['name'] ?? 'Humano';
        $racaIndex = $racas[$idxRaca]['index'] ?? null;
        $racaDetalhes = [];
        if ($racaIndex) {
            $detalheRacaResp = Http::get("https://www.dnd5eapi.co/api/races/$racaIndex");
            $racaDetalhes = $detalheRacaResp->json();
        }

        // Magia
        $magiaResp = Http::get('https://www.dnd5eapi.co/api/spells/');
        $magias = $magiaResp->json()['results'] ?? [];
        $magiasEscolhidas = [];
        $quantidadeMagias = 3;
        if(count($magias) >= $quantidadeMagias){
            $indices = array_rand($magias, $quantidadeMagias);
            if (!is_array($indices)) $indices = [$indices];
            foreach ($indices as $idx) {
                $magiasEscolhidas[] = $magias[$idx]['name'];
            }
        }
        $poderes = implode(', ', $magiasEscolhidas);

        return [
            'nome'           => $nome,
            'sobrenome'      => $sobrenome,
            'historia'       => $historia,
            'inventario'     => $inventario,
            'classe'         => $classeEscolhida,
            'classeDetalhes' => $classeDetalhes,
            'raca'           => $racaEscolhida,
            'racaDetalhes'   => $racaDetalhes,
            'magia'          => $poderes,
            'atributos'      => $atributos,
        ];
    }

    public function store(array $data, int $userId)
    {
        $data['user_id'] = $userId;
        return $this->personagemRepository->store($data);
    }

    public function show(string $id, int $userId)
    {
        return $this->personagemRepository->findForUser($id, $userId);
    }

    public function update(array $data, string $id, int $userId)
    {
        return $this->personagemRepository->updateForUser($data, $id, $userId);
    }

    public function destroy(string $id, int $userId)
    {
        $this->personagemRepository->destroyForUser($id, $userId);
    }
}

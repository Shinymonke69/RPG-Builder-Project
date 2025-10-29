<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Personagem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Faker\Factory;




class PersonagemController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $personagens = Personagem::where('user_id', Auth::id())->get();
        return view('personagens.index', compact('personagens'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $faker = Factory::create('pt_BR');

        // Dados básicos
        $nome      = $faker->firstName();
        $sobrenome = $faker->lastName();

        // Sortear história e inventário
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


        // Atributos clássicos RPG
        $atributos = [
            'forca'         => $faker->numberBetween(8, 18),
            'destreza'      => $faker->numberBetween(8, 18),
            'constituicao'  => $faker->numberBetween(8, 18),
            'inteligencia'  => $faker->numberBetween(8, 18),
            'sabedoria'     => $faker->numberBetween(8, 18),
            'carisma'       => $faker->numberBetween(8, 18),
        ];

        // --- CLASSE ---
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

        // --- RAÇA ---
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

        // --- MAGIA/PODER ---
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

        return view('personagens.create', [
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
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required|string',
            'sobrenome' => 'required|string',
            'raça' => 'required|string',
            'classe' => 'required|string',
            'atributos' => 'required',
            'poderes' => 'nullable|string',
            'historia' => 'nullable|string',
            'inventario' => 'nullable|string',
        ]);
        $data['user_id'] = Auth::id();

        $data['atributos'] = $request->atributos;

        Personagem::create($data);

        return redirect()->route('personagens.index')->with('Sucesso', 'Personagem criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $personagem = Personagem::FindOrFail($id);
        return view('personagens.show', compact('personagem'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $personagem = Personagem::findOrFail($id);
        return view('personagens.edit', compact('personagem'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $personagem = Personagem::findOrFail($id);

        $data = $request->validate([
            'nome' => 'required|string',
            'sobrenome' => 'required|string',
            'raça' => 'required|string',
            'classe' => 'required|string',
            'atributos' => 'required',
            'poderes' => 'nullable|string',
            'historia' => 'nullable|string',
            'inventario' => 'nullable|string',
        ]);
        $data['atributos'] = json_decode($request->input('atributos'), true);
        $data['atributos'] = $atributos ?? [];

        $personagem->update($data);

        return redirect()->route('personagens.index')->with('Sucesso', 'Personagem atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $personagem = Personagem::findOrFail($id);
        $personagem->delete();

        return redirect()->route('personagens.index')->with('success', 'Personagem removido com sucesso!');
    }
}

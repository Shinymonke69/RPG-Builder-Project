@extends('layouts.app')

@section('slot')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800">
                    <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-6">Lista de Personagens</h1>
                    <a href="{{ route('personagens.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4">Novo Personagem</a>
                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">{{ session('success') }}</div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6"> {{-- Cards em grade responsiva --}}
                        @forelse ($personagens as $personagem)
                            <div class="bg-white dark:bg-gray-900 shadow-lg rounded-lg p-6 flex flex-col space-y-3 border">
                                <div>
                                    <h2 class="text-xl font-bold text-gray-700 dark:text-gray-200">{{ $personagem->nome }}</h2>
                                    <p class="text-gray-500 dark:text-gray-300">Raça: <span class="font-semibold">{{ $personagem->raca }}</span></p>
                                    <p class="text-gray-500 dark:text-gray-300">Classe: <span class="font-semibold">{{ $personagem->classe }}</span></p>
                                </div>
                                <div class="flex space-x-2 mt-4">
                                    <a href="{{ route('personagens.show', $personagem->id) }}" class="bg-indigo-600 hover:bg-indigo-800 text-white px-3 py-1 rounded text-xs">Detalhes</a>
                                    <a href="{{ route('personagens.edit', $personagem->id) }}" class="bg-yellow-600 hover:bg-yellow-700 text-white px-3 py-1 rounded text-xs">Editar</a>
                                    <form action="{{ route('personagens.destroy', $personagem->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white px-3 py-1 rounded text-xs" onclick="return confirm('Tem certeza que deseja excluir este personagem?');">Excluir</button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <p class="col-span-full text-center text-gray-500 dark:text-gray-400">Nenhum personagem cadastrado ainda.</p>
                        @endforelse
                        
                    </div>
                </div>
                <div class="mt-4">
                    {{ $personagens->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('slot')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800">
                    <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-6">Editar Personagem</h1>
                    <form method="POST" action="{{ route('personagens.update', $personagem->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label class="block font-medium text-gray-700 dark:text-gray-300">Nome</label>
                            <input class="form-input mt-1 block w-full" name="nome" value="{{ $personagem->nome }}" required>
                        </div>
                        <div class="mb-4">
                            <label class="block font-medium text-gray-700 dark:text-gray-300">Sobrenome</label>
                            <input class="form-input mt-1 block w-full" name="sobrenome" value="{{ $personagem->sobrenome }}" required>
                        </div>
                        <div class="mb-4">
                            <label class="block font-medium text-gray-700 dark:text-gray-300">Raça</label>
                            <input class="form-input mt-1 block w-full" name="raça" value="{{ $personagem->raça }}" required>
                        </div>
                        <div class="mb-4">
                            <label class="block font-medium text-gray-700 dark:text-gray-300">Classe</label>
                            <input class="form-input mt-1 block w-full" name="classe" value="{{ $personagem->classe }}" required>
                        </div>
                        <div class="mb-4">
                            <label class="block font-medium text-gray-700 dark:text-gray-300">Atributos</label>
                            <div class="flex flex-row gap-4 justify-center items-end">
                                <div class="flex flex-row items-center gap-2">
                                    <label class="text-gray-700 dark:text-gray-300">Força</label>
                                    <input type="number" min="0" max="100" class="form-input w-16 text-center" name="atributos[forca]"
                                        value="{{ $personagem->atributos['forca'] ?? '' }}" required>
                                    <label class="text-gray-700 dark:text-gray-300">Destreza</label>
                                    <input type="number" min="0" max="100" class="form-input w-16 text-center" name="atributos[destreza]"
                                        value="{{ $personagem->atributos['destreza'] ?? '' }}" required>
                                    <label class="text-gray-700 dark:text-gray-300">Constituição</label>
                                    <input type="number" min="0" max="100" class="form-input w-16 text-center" name="atributos[constituicao]"
                                        value="{{ $personagem->atributos['constituicao'] ?? '' }}" required>
                                    <label class="text-gray-700 dark:text-gray-300">Inteligência</label>
                                    <input type="number" min="0" max="100" class="form-input w-16 text-center" name="atributos[inteligencia]"
                                        value="{{ $personagem->atributos['inteligencia'] ?? '' }}" required>
                                    <label class="text-gray-700 dark:text-gray-300">Sabedoria</label>
                                    <input type="number" min="0" max="100" class="form-input w-16 text-center" name="atributos[sabedoria]"
                                        value="{{ $personagem->atributos['sabedoria'] ?? '' }}" required>
                                    <label class="text-gray-700 dark:text-gray-300">Carisma</label>
                                    <input type="number" min="0" max="100" class="form-input w-16 text-center" name="atributos[carisma]"
                                        value="{{ $personagem->atributos['carisma'] ?? '' }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="block font-medium text-gray-700 dark:text-gray-300">Poderes</label>
                            <textarea class="form-input mt-1 block w-full" name="poderes">{{ $personagem->poderes }}</textarea>
                        </div>
                        <div class="mb-4">
                            <label class="block font-medium text-gray-700 dark:text-gray-300">História</label>
                            <input class="form-input mt-1 block w-full" name="historia" value="{{ $personagem->historia }}" required>
                        </div>
                        <div class="mb-4">
                            <label class="block font-medium text-gray-700 dark:text-gray-300">Inventário</label>
                            <textarea class="form-input mt-1 block w-full" name="inventario">{{ $personagem->inventario }}</textarea>
                        </div>
                        <button type="submit" class="bg-green-600 hover:bg-green-800 text-white font-bold py-2 px-4 rounded">Atualizar</button>
                        <a href="{{ route('personagens.index') }}" class="ml-4 text-gray-600 hover:text-gray-900 dark:text-gray-400">Voltar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
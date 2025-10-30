<nav class="bg-[#6d4c41] dark:bg-[#3e2922] border-b border-[#3e2922] text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <!-- Menu à esquerda -->
            <div class="flex items-center gap-8">
                <!-- Remove o logo padrão Laravel -->
                <a href="{{ route('personagens.index') }}" class="text-xl font-bold font-serif tracking-wider">RPG-Builder</a>
                <x-nav-link :href="route('personagens.index')" :active="request()->routeIs('personagens.index')">
                    {{ __('Personagens') }}
                </x-nav-link>
                <x-nav-link :href="route('personagens.create')" :active="request()->routeIs('personagens.create')">
                    {{ __('Criar Personagem') }}
                </x-nav-link>
            </div>
            <!-- Area de login/perfil à direita -->
            <div class="flex items-center gap-4">
                @auth
                    <span class="font-semibold">{{ Auth::user()->name }}</span>
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center rounded-md px-3 py-2 bg-[#4e342e] hover:bg-[#3e2922] focus:outline-none transition text-white font-medium">
                                <span class="mr-2">Conta</span>
                                <svg class="fill-current h-4 w-4" viewBox="0 0 20 20"><path fill-rule="evenodd" d="..." /></svg>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();this.closest('form').submit();">
                                    {{ __('Sair') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @endauth
                @guest
                    <a href="{{ route('login') }}" class="font-semibold underline">Login</a>
                @endguest
            </div>
        </div>
    </div>
</nav>

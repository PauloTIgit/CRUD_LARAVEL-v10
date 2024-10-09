<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Mis Chirps
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <x-nav-link :href="route('chirps.index')" :active="request()->routeIs('chirps.index')">
                        Ver Todos Chirps
                    </x-nav-link>

                    <form action="{{ route('chirps.store') }}" method="POST" style="margin-top: 10px;">
                        @csrf
                        <textarea class="block mt-1 w-full p-6" name="message" style="background-color:#041c25;color:#8b8b91;" placeholder="¿Que tienes en mente?">{{ old('message') }}</textarea>
                        <div class=" text-red text-center text-lg font-bold p-2">
                            @error('message') {{-- aqui ponemos el nombre del input  --}}
                                {{ __($message) }} {{-- esta variable siempre se llamara message y es la que contendra el mensaje de error --}}
                            @enderror
                        </div>
                        <x-primary-button class="mt-3">Chirps</x-primary-button>
                    </form>
                </div>
            </div>
            
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg" style="margin-top: 10px;">
                @foreach ($chirps as $chirp)
                    <div class="p-6 text-gray-900 dark:text-gray-100 shadow-sm sm:rounded-lg">
                        <svg class="w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" className="w-6 h-6">
                            <path strokeLinecap="round" strokeLinejoin="round" d="M8.625 9.75a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375m-13.5 3.01c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.184-4.183a1.14 1.14 0 0 1 .778-.332 48.294 48.294 0 0 0 5.83-.498c1.585-.233 2.708-1.626 2.708-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
                        </svg>
                        <div class="flex-1 text-center">                        
                            <div class="flex justify-between items-center">
                                <div>
                                    <span class="w-4"><h1><b>Usuario: {{ $chirp->user->name }}</b> <small>Creado: {{ $chirp->created_at->format('Y-m-d') }}</small></h1></span>
                                    @if ($chirp->created_at != $chirp->updated_at)
                                        <p><small>Editado: {{ $chirp->updated_at->format('Y,m,d') }}</small></p>
                                    @endif                                    
                                </div>
                            </div>
                            <p>{{ $chirp->message }}</p>                            
                        </div>  
                        @if (auth()->user()->id === $chirp->user_id)
                            <a href="{{ route('chirps.edit', $chirp) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-blue-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">Editar</a>                 
                            <form action="{{ route('chirps.destroy', $chirp) }}" method="POST" style="margin-top: 10px;">
                                @csrf @method('DELETE')
                                <x-primary-button class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-red-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">Borrar</x-primary-button>
                            </form>
                        @endif
                    </div>      
                @endforeach                
            </div>
        </div>
    </div>
</x-app-layout>

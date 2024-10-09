<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Chirps') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('chirps.update', $chirp) }}" method="POST">
                        @csrf @method('PUT')
                        <textarea class="block mt-1 w-full p-6" name="message" style="background-color:#041c25;color:#8b8b91;" placeholder="¿Que tienes en mente?">{{ old('message', $chirp->message) }}</textarea>
                        <div class=" text-red text-center text-lg font-bold p-2">
                            @error('message') {{-- aqui ponemos el nombre del input  --}}
                                {{ __($message) }} {{-- esta variable siempre se llamara message y es la que contendra el mensaje de error --}}
                            @enderror
                        </div>
                        <x-primary-button class="mt-3">Chirps</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>    
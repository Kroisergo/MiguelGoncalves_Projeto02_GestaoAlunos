<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
        
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-medium text-gray-900">Bem-vindo/a ao Sistema de Gestão de Alunos</h3>
                        <p class="mt-4">
                            <a href="{{ route('alunos.index') }}" class="text-blue-500 hover:text-blue-700 font-semibold">
                                -> Lista de Alunos <-
                            </a>
                        </p>
    
                        @can('isAdmin')
                            <p class="mt-4 text-sm text-gray-700">
                                <b>Nota:</b> Como és administrador, terás acesso total para criar, editar e apagar registos, e também para exportar os dados dos alunos.
                            </p>
                        @endcan
    
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-app-layout>

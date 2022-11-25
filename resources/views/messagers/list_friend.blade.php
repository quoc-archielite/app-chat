<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">List Friend</div>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                @foreach($data as $key => $value)
                                    <a href="{{ route('messager', ['id_sender' =>  auth()->user()->id, 'id_receiver' => $value['id']]) }}"><li class="list-group-item">{{ $value['name'] }}</li></a>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

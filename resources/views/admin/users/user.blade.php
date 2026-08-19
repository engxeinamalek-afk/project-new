<x-app-layout>
    <x-slot name="header">
    <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Users
        </h2>
    </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6"><div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-semibold text-gray-700">
                        Users List
                    </h3>
                </div>

            @php
                $userHeaders = ['ID', 'Name', 'Email', 'Joined at'];
            @endphp

            <x-dashboard.table :headers="$userHeaders">
                @foreach($users as $user)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <x-dashboard.td bold>{{ $user->id }}</x-dashboard.td>
                        <x-dashboard.td bold>{{ $user->name }}</x-dashboard.td>
                        <x-dashboard.td bold>{{ $user->email }}</x-dashboard.td>           
                        <x-dashboard.td bold>{{ $user->created_at->format('Y-m-d') }}</x-dashboard.td>
                    </tr>
                @endforeach
            </x-dashboard.table>

            @if ($users->hasPages())
                <div class="mt-6 px-4 py-3 bg-white border-t border-gray-200 sm:px-6 rounded-lg shadow-sm">
                        {{ $users->links() }}
                </div>
            @endif
            </div>
        </div>
    </div>

</x-app-layout>
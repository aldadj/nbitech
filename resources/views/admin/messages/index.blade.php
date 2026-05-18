@extends('layouts.admin')

@section('title', 'Messages Clients')
@section('heading', 'Messages Clients')

@section('content')
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden mb-8">
        <div class="p-4 md:p-6 border-b border-gray-100 flex justify-between items-center">
            <h3 class="text-sm md:text-lg font-bold text-gray-800">Boîte de réception</h3>
        </div>

        <div class="divide-y divide-gray-100">
            @forelse ($messages as $message)
                <a href="{{ route('admin.messages.show', $message) }}" class="block hover:bg-gray-50 transition-colors">
                    <div class="flex items-center p-4 md:p-6 {{ !$message->read ? 'bg-indigo-50' : '' }}">
                        <div class="flex-shrink-0 mr-4">
                            @if(!$message->read)
                                <span class="block w-3 h-3 bg-indigo-500 rounded-full"></span>
                            @else
                                <span class="block w-3 h-3 bg-gray-300 rounded-full"></span>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex justify-between items-center mb-1">
                                <p class="font-bold {{ !$message->read ? 'text-gray-900' : 'text-gray-600' }} truncate">
                                    {{ $message->name }}
                                </p>
                                <p class="text-xs text-gray-400 ml-2 flex-shrink-0">
                                    {{ $message->created_at->diffForHumans() }}
                                </p>
                            </div>
                            <p class="text-sm {{ !$message->read ? 'text-gray-800 font-semibold' : 'text-gray-500' }} truncate">
                                {{ $message->subject }}
                            </p>
                            <p class="text-xs text-gray-400 mt-1 truncate">
                                {{ Str::limit($message->message, 80) }}
                            </p>
                        </div>
                        <div class="flex-shrink-0 ml-4 text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </div>
                    </div>
                </a>
            @empty
                <div class="p-6 text-center text-gray-500">
                    <p class="text-lg mb-2">Inbox vide</p>
                    <p class="text-sm">Aucun message client pour le moment.</p>
                </div>
            @endforelse
        </div>

        @if ($messages->hasPages())
            <div class="p-4 md:p-6 border-t border-gray-100">
                {{ $messages->links() }}
            </div>
        @endif
    </div>
@endsection
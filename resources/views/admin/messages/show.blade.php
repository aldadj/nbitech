@extends('layouts.admin')

@section('title', 'Message de ' . $message->name)
@section('heading', 'Message de ' . $message->name)

@section('content')
    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-8">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <h3 class="text-2xl font-bold text-gray-900">{{ $message->subject }}</h3>
                    <p class="text-gray-600 text-sm">De: <span class="font-semibold">{{ $message->name }}</span> ({{ $message->email }})</p>
                </div>
                <p class="text-xs text-gray-400">{{ $message->created_at->format('d/m/Y H:i') }}</p>
            </div>

            <hr class="my-6 border-gray-100">

            <div class="prose prose-indigo max-w-none">
                <p class="whitespace-pre-wrap leading-relaxed text-gray-800">{{ $message->message }}</p>
            </div>

            <div class="mt-8 flex flex-col sm:flex-row justify-between items-center gap-4">
                <a href="{{ route('admin.messages.index') }}" class="inline-flex items-center justify-center bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded-lg transition w-full sm:w-auto">
                    ← Retour aux messages
                </a>

                @if(!$message->is_read)
                    <form action="{{ route('admin.messages.markAsRead', $message) }}" method="POST" class="w-full sm:w-auto">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="inline-flex items-center justify-center bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg transition w-full sm:w-auto">
                            Marquer comme lu
                        </button>
                    </form>
                @else
                    <span class="text-green-600 font-semibold text-sm">✅ Message lu</span>
                @endif
            </div>
        </div>
    </div>
@endsection
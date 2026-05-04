@extends('layouts.admin')

@section('title', 'Message client')
@section('heading', 'Detail Message')

@section('content')
<div class="bg-white rounded-lg shadow p-6 max-w-3xl">
    <h3 class="text-2xl font-bold mb-2">{{ $message->subject }}</h3>
    <p class="text-gray-700 mb-1"><strong>Nom:</strong> {{ $message->name }}</p>
    <p class="text-gray-700 mb-1"><strong>Email:</strong> {{ $message->email }}</p>
    <p class="text-gray-700 mb-1"><strong>Telephone:</strong> {{ $message->phone ?: '-' }}</p>
    <p class="text-gray-500 text-sm mb-4">{{ $message->created_at->format('d/m/Y H:i') }}</p>
    <div class="rounded bg-gray-50 border p-4 whitespace-pre-wrap text-gray-800">{{ $message->message }}</div>
</div>
@endsection

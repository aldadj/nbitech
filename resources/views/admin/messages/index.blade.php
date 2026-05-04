@extends('layouts.admin')

@section('title', 'Messages')
@section('heading', 'Messages Clients')

@section('content')
<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="overflow-x-auto">
    <table class="w-full min-w-[700px]">
        <thead class="bg-gray-50 border-b">
            <tr>
                <th class="px-4 py-3 text-left">Nom</th>
                <th class="px-4 py-3 text-left">Sujet</th>
                <th class="px-4 py-3 text-left">Contact</th>
                <th class="px-4 py-3 text-left">Date</th>
                <th class="px-4 py-3 text-left">Statut</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            @forelse($messages as $message)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3"><a class="text-blue-700 font-semibold" href="{{ route('admin.messages.show', $message) }}">{{ $message->name }}</a></td>
                    <td class="px-4 py-3">{{ $message->subject }}</td>
                    <td class="px-4 py-3 text-sm">{{ $message->email }}<br>{{ $message->phone }}</td>
                    <td class="px-4 py-3 text-sm">{{ $message->created_at->format('d/m/Y H:i') }}</td>
                    <td class="px-4 py-3">{!! $message->is_read ? '<span class="text-green-700">Lu</span>' : '<span class="text-red-700 font-semibold">Nouveau</span>' !!}</td>
                </tr>
            @empty
                <tr><td colspan="5" class="px-4 py-8 text-center text-gray-500">Aucun message</td></tr>
            @endforelse
        </tbody>
    </table>
    </div>
    <div class="p-4">{{ $messages->links() }}</div>
</div>
@endsection

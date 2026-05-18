<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage; // Assurez-vous que votre modèle de message s'appelle ContactMessage
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the messages.
     */
    public function index()
    {
        $messages = ContactMessage::latest()->paginate(10);
        return view('admin.messages.index', compact('messages'));
    }

    /**
     * Display the specified message.
     */
    public function show(ContactMessage $message)
    {
        $message->markAsRead(); // Marque le message comme lu dès qu'il est consulté.
        return view('admin.messages.show', compact('message'));
    }

    /**
     * Mark the specified message as read.
     */
    public function markAsRead(ContactMessage $message)
    {
        $message->markAsRead(); // Appelle la méthode markAsRead() du modèle.
        return back()->with('success', 'Message marqué comme lu.');
    }
}
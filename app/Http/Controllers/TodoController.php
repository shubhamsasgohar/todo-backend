<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TodoController extends Controller
{
    // Get all tasks
    public function index()
    {
        return response()->json(Todo::orderBy('created_at', 'desc')->get());
    }

    // Create new todo
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'details' => 'nullable|string',
            'file' => 'nullable|mimes:pdf|max:2048'
        ]);

        $filePath = null;

        // If PDF uploaded, store inside public storage
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('todo-documents', 'public');
        }

        $todo = Todo::create([
            'title' => $request->title,
            'details' => $request->details,
            'document_path' => $filePath
        ]);

        return response()->json($todo, 201);
    }

    // Show a single todo
    public function show($id)
    {
        return Todo::findOrFail($id);
    }

    // Update existing todo
    public function update(Request $request, $id)
    {
        $todo = Todo::findOrFail($id);

        $request->validate([
            'title' => 'required|string',
            'details' => 'nullable|string',
            'file' => 'nullable|mimes:pdf|max:2048'
        ]);

        // Handle PDF upload
        if ($request->hasFile('file')) {
            if ($todo->document_path) {
                Storage::disk('public')->delete($todo->document_path);
            }

            $todo->document_path = $request->file('file')->store('todo-documents', 'public');
        }

        $todo->title = $request->title;
        $todo->details = $request->details;
        $todo->save();

        return response()->json($todo);
    }

    // Delete a todo
    public function destroy($id)
    {
        $todo = Todo::findOrFail($id);

        if ($todo->document_path) {
            Storage::disk('public')->delete($todo->document_path);
        }

        $todo->delete();

        return response()->json(['message' => 'Todo removed successfully']);
    }
}


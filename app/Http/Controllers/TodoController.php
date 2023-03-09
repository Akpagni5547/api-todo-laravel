<?php

namespace App\Http\Controllers;

use App\Http\Requests\PatchTodoRequest;
use App\Http\Requests\StoreTodoRequest;
use Illuminate\Http\Request;

use App\Models\Todo;
use App\Http\Resources\TodoCollection;
use App\Http\Resources\TodoResource;
use OpenApi\Annotations as OA;

class TodoController extends Controller
{
    /**
     * @OA\Info(title="My First API", version="0.1")
     */
    public function index()
    {
        return new TodoCollection(Todo::all());
    }

    public function store(StoreTodoRequest $request)
    {
        $todo = Todo::create([
            'title' => $request->title,
            'content' => $request->content,
            'is_completed' => $request->isCompleted ?? false,
        ]);
        return response()->json(data: [
            'data' => [
                'message' => 'Le todo a été crée avec succès',
                'todo' => $todo
            ]
        ], status: 201);
    }

    public function show(Todo $todo)
    {
        return new TodoResource($todo);
    }

    public function updatePartial(PatchTodoRequest $request, Todo $todo)
    {
        $todo->update([
            'title' => $request->title ?? $todo->title,
            'content' => $request->content ?? $todo->content,
            'is_completed' => $request->isCompleted ?? $todo->is_completed
        ]);
        return response()->json(data: [
            'data' => [
                'message' => 'Le todo a été modifié avec succès'
            ]
        ], status: 201);
    }

    public function updateTotaly(StoreTodoRequest $request, Todo $todo)
    {
        $todo->update([
            'title' => $request->title,
            'content' => $request->content,
            'is_completed' => $request->isCompleted ?? $todo->is_completed
        ]);
        return response()->json(data: [
            'data' => [
                'message' => 'Le todo a été modifié avec succès',
            ]
        ], status: 201);
    }

    public function destroy(Todo $todo)
    {
        $todo->delete();
        return response()->json(status: 204);
    }
}

<?php

namespace App\Http\Controllers;

use App\Services\TodolistService;
use Illuminate\Http\Request;

class TodolistController extends Controller
{
    private TodolistService $todolistService;

    public function __construct(TodolistService $todolistService)
    {
        $this->todolistService = $todolistService;
    }
    public function getTodo(Request $request)
    {
        return view('user.home', [
            'title' => 'Todo List',
            'todolist' => $this->todolistService->getTodo()
        ]);
    }

    public function addTodo(Request $request)
    {
        $todo = $request->validate([
            'todo' => 'required'
        ]);
        if($todo){
            $this->todolistService->addTodo(uniqid(), $todo['todo']);
            return redirect()->action([TodolistController::class, 'getTodo']);
        }
        return back()->withErrors($todo);
    }

    public function removeTodo(Request $request, string $todoId)
    {
        $this->todolistService->removeTodo($todoId);
        return redirect()->action([TodolistController::class, 'getTodo']);
    }
}

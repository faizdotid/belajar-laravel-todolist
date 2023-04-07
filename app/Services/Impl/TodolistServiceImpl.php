<?php

namespace App\Services\Impl;

use App\Services\TodolistService;
use Illuminate\Support\Facades\Session;

class TodolistServiceImpl implements TodolistService
{

    public function removeTodo(string $todoId)
    {
        $todolist = Session::get('todolist');
        foreach ($todolist as $index => $value) {
            if($value['id'] == $todoId) {
                unset($todolist[$index]);
                break;
            }
        }
        Session::put('todolist', $todolist);
    }

    public function getTodo(): array
    {
        return Session::get('todolist', []);
    }
    public function addTodo(string $id, string $todo)
    {
        if (!Session::exists('todolist')) {
            Session::put('todolist');
        }
        Session::push('todolist', [
            'id' => $id,
            'todo' => $todo
        ]);
    }
}
<?php
namespace App\Services;

interface TodolistService
{
    function addTodo(string $id, string $todo);

    function getTodo(): array;

    function removeTodo(string $todoId);
}
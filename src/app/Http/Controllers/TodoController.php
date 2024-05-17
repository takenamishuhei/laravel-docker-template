<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;
use Symfony\Component\Console\Input\Input;

class TodoController extends Controller
{
    private $todo;

    public function __construct(Todo $todo)
    {
        $this->todo = $todo;
    }

    public function index()
    {
        $todoList = $this->todo->all();

        return view('todo.index', ['todoList' => $todoList]);
    }

    public function create()
    {
        return view('todo.create');
    }

    public function store(Request $request)
    {
        $inputs = $request->all();

        $this->todo->fill($inputs);
        $this->todo->save();

        return redirect()->route('todo.index');
    }

    public function show($id)
    {
        $todo = $this->todo->find($id);
        
        return view('todo.show', ['todo' => $todo]);
    }

    public function edit($id)
    {
        $todo = $this->todo->find($id);

        return view('todo.edit', ['todo' => $todo]);
    }

public function update(Request $request, $id)
    {
        $inputs = $request->all();
        $todo = $this->todo->find($id);
        $todo-> fill($inputs)->save();

        return redirect()->route('todo.show', $todo->id);
    }
}

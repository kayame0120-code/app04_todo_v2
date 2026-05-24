<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoRequest;
use App\Models\Category;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    //
    public function index()
    {
        $todos = Todo::with('category', 'user')->where('user_id', auth()->id())->get();
        $categories = Category::all();

        return view('index', compact('todos', 'categories'));
    }

    public function store(Request $request)
    {
        $todo = $request->only(['category_id', 'content', 'status']);
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $todo['image_path'] = $path;
        }
        $todo['user_id'] = auth()->id();
        Todo::create($todo);

        return redirect('/')->with('message', 'Todoを追加しました');

    }

    public function update(TodoRequest $request, Todo $todo)
    {
        $todo->update($request->only(['content', 'status']));

        return redirect('/')->with('message', 'Todoを更新しました');
    }

    public function destroy(Todo $todo)
    {
        $todo->delete();

        return redirect('/')->with('message', 'Todoを削除しました');
    }

    public function search(Request $request)
    {
        $todos = Todo::with('category', 'user')
            ->where('user_id', auth()->id())
            ->CategorySearch($request->category_id)->KeywordSearch($request->keyword)->StatusSearch($request->status)->get();
        $categories = Category::all();

        return view('index', compact('todos', 'categories'));
    }

    public function like(Todo $todo)
    {
        $todo->likes()->attach(auth()->id());

        return redirect('/')->with('message', 'Todoにいいねしました');
    }

    public function unlike(Todo $todo)
    {
        $todo->likes()->detach(auth()->id());

        return redirect('/')->with('message', 'Todoのいいねを解除しました');
    }
}

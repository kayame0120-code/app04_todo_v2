@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('header-button')
<form action="/logout" method="POST">
  @csrf
  <button type="submit">ログアウト</button>
</form>
@endsection

@section('content')
<div class="todo__alert">
  @if(session('message'))
  <div class="todo__alert--success">
    {{ session('message') }}
  </div>
  @endif
  @if ($errors->any())
  <div class="todo__alert--danger">
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif
</div>
<div class="todo__content">
  <form class="create-form" action="/todos" method="post" enctype="multipart/form-data">
    @csrf
    <div class="create-form__item">
      <input class="create-form__item-input" type="text" name="content" value="{{ old('content') }}">
      <select class="create-form__item-select" name="category_id">
        @foreach($categories as $category)
        <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
      </select>
      <input type="file" name="image">
      <select name="status">
        <option value="0">未着手</option>
        <option value="1">進行中</option>
        <option value="2">完了</option>
      </select>
    </div>
    <div class="create-form__button">
      <button class="create-form__button-submit" type="submit">作成</button>
    </div>
  </form>
  <form class="search-form" action="/todos/search" method="get">
    @csrf
    <div class="search-form__item">
      <input type="text" name="keyword" value="{{ old('keyword') }}" class="search-form__item-input">
    </div>
    <select name="category_id" class="search-form__item-select">
      @foreach($categories as $category)
      <option value="{{ $category->id }}">{{ $category->name }}</option>
      @endforeach
    </select>
    <select name="status" class="search-form__item-select">
      <option value="">すべて</option>
      <option value="0">未着手</option>
      <option value="1">進行中</option>
      <option value="2">完了</option>
    </select>
    <div class="create-form__button">
      <button class="search-form__button-submit" type="submit">検索</button>
    </div>
  </form>
  <div class="todo-table">
    <table class="todo-table__inner">
      <tr class="todo-table__row">
        <th class="todo-table__header">Todo</th>
      </tr>
      @foreach ($todos as $todo)
      <tr class="todo-table__row">
        <td class="todo-table__item">
          <form class="update-form" action="/todos/{{ $todo->id }}" method="POST">
            @method('PATCH')
            @csrf
            <div class="update-form__item">
              <input class="update-form__item-input" type="text" name="content" value="{{ $todo->content }}">
            </div>
            <div class="update-form__item">
              <p class="update-form__itme-p">{{ $todo->category->name }}</p>
            </div>
            @if($todo->image_path)
            <div class="update-form__item">
              <img src="{{ asset('storage/' . $todo->image_path) }}" width="100">
            </div>
            @endif
            <select name="status">
              <option value="0" {{ $todo->status == 0 ? 'selected' : '' }}>未着手</option>
              <option value="1" {{ $todo->status == 1 ? 'selected' : '' }}>進行中</option>
              <option value="2" {{ $todo->status == 2 ? 'selected' : '' }}>完了</option>
            </select>
            <div class=" update-form__button">
              <button class="update-form__button-submit" type="submit">更新</button>
            </div>
          </form>
        </td>
        <td class="todo-table__item">
          <form class="delete-form" action="/todos/{{ $todo->id }}" method="POST">
            @method('DELETE')
            @csrf
            <div class="delete-form__button">
              <button class="delete-form__button-submit" type="submit">削除</button>
            </div>
          </form>
          @if($todo->likes->contains('id', auth()->id()))
          <form action="/todos/{{ $todo->id }}/like" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">いいね解除</button>
          </form>
          @else
          <form action="/todos/{{ $todo->id }}/like" method="POST">
            @csrf
            <button type="submit">いいね</button>
          </form>
          @endif
          <p>{{ $todo->likes->count() }}件</p>
        </td>
      </tr>
      @endforeach
    </table>
  </div>
</div>
@endsection
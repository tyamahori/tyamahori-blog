@extends('layouts.admin.master')
@section('title', 'Category Editing')
@section('content')
  <section class="section">
    <div class="container">
      <h1 class="title">Category Editing</h1>
      @if ($errors->any())
        <ul class="message is-danger">
          @foreach ($errors->all() as $error)
            <li class="message-body">{{ $error }}</li>
          @endforeach
        </ul>
      @endif
      <form method="post">
        @csrf
        <div class="field">
          <label class="label">Current Category</label>
          <div class="control">
            <input class="input" type="text" name="{{ $category::getNameColumn() }}" value="{{ $category->nameColumnData }}" placeholder="new category">
            <input type="hidden" name="{{ $category::getPrimaryKeyColumnName() }}" value="{{ $category->primaryKeyData }}">
          </div>
        </div>
        <button class="button is-primary">
          Update!
        </button>
        <a class="button" href="{{ route('admin.category.index') }}">Back to Category List</a>
      </form>
    </div>
  </section>
@stop

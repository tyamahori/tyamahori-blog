@extends('layouts.admin.master')
@section('title', 'Category List')
@section('content')
  <section class="section">
    <div class="container">
      <h1 class="title">Create New Category</h1>
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
          <label class="label">New Category</label>
          <div class="control">
            <input class="input" type="text" placeholder="Wonderful Category" name="category" value="{{ old('category') }}">
          </div>
        </div>
        <button class="button is-primary">
          Create!
        </button>
      </form>
    </div>
  </section>
  <section class="section">
    <div class="container">
      <h1 class="title">All Categories</h1>
      <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
        <thead>
        <tr>
          <th>ID</th>
          <th>Category</th>
          <th>Action</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
          <th>ID</th>
          <th>Category</th>
          <th>Action</th>
        </tr>
        </tfoot>
        <tbody>
        @foreach($categories as $category)
          <tr>
            <th>{{ $category->getId()->getValue() }}</th>
            <th>{{ $category->getName()->getValue() }}</th>
            <th>
              <a class="button" href="{{ route('admin.category.edit', ['id' => $category->getId()->getValue()]) }}">Edit</a>
              <a class="button has-background-danger has-text-white-bis" href="{{ route('admin.category.destroy', ['id' => $category->getId()->getValue()]) }}">Delete</a>
            </th>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
  </section>
@stop

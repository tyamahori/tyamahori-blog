@extends('layouts.admin.master')
@section('title', 'Category Deleting')
@section('content')
<section class="section">
  <div class="container">
  <h1 class="title">Category Deleting</h1>
    <form method="post">
      @csrf
      <div class="field">
        <label class="label">Selected Category</label>
        <div class="control">
          <p>{{ $category->category }}</p>
          <input type="hidden" name="id" value="{{ $category->id }}">
        </div>
      </div>
      <button class="button has-background-danger has-text-white-bis">
        Delete!
      </button>
      <a class="button" href="{{ route('admin.category.index') }}">Back to Category List</a>
    </form>
  </div>
</section>
@stop

@extends('layouts.admin.master')
@section('title', 'Tag Deleting')
@section('content')
<section class="section">
  <div class="container">
  <h1 class="title">Tag Deleting</h1>
    <form method="post">
      @csrf
      <div class="field">
        <label class="label">Selected Tag</label>
        <div class="control">
          <p>{{ $tag->nameColumnData }}</p>
          <input type="hidden" name="id" value="{{ $tag->primaryKeyColumnData }}">
        </div>
      </div>
      <button class="button has-background-danger has-text-white-bis">
        Delete!
      </button>
      <a class="button" href="{{ route('admin.tag.index') }}">Back to Tag List</a>
    </form>
  </div>
</section>
@stop

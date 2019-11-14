@extends('layouts.admin.master')
@section('title', 'Tag Editing')
@section('content')
  <section class="section">
    <div class="container">
      <h1 class="title">Tag Editing</h1>
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
          <label class="label">Selected Tag</label>
          <div class="control">
            <input class="input" type="text" name="tag" value="{{ $tag->nameColumnData }}" placeholder="new tag">
          </div>
        </div>
        <button class="button is-primary">
          Update!
        </button>
        <a class="button" href="{{ route('admin.tag.index') }}">Back to Tag List</a>
      </form>
    </div>
  </section>
@stop

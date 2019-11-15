@extends('layouts.admin.master')

@section('title', 'Tag List')

@section('content')
  <section class="section">
    <div class="container">
      <h1 class="title">Create New Tag</h1>
      @if ($errors->any())
        <ul class="message is-danger">
          @foreach ($errors->all() as $error)
            <li class="message-body">{{ $error }}</li>
          @endforeach
        </ul>
      @endif
      <form method="post" action="{{ route('admin.tag.index') }}">
        @csrf
        <div class="field">
          <label class="label">New Tag</label>
          <div class="control">
            <input class="input" type="text" placeholder="Wonderful Tag" name="tag" value="{{ old('tag') }}">
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
      <h1 class="title">All Tags</h1>
      <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
        <thead>
        <tr>
          <th>ID</th>
          <th>Tag</th>
          <th>Action</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
          <th>ID</th>
          <th>Tag</th>
          <th>Action</th>
        </tr>
        </tfoot>
        <tbody>
        @foreach($tags as $tag)
          <tr>
            <th>{{ $tag->primary_key_data }}</th>
            <th>{{ $tag->name_data }}</th>
            <th>
              <a class="button" href="{{ route('admin.tag.edit', ['tag' => $tag->primary_key_data]) }}">Edit</a>
              <a class="button has-background-danger has-text-white-bis" href="{{ route('admin.tag.destroy', ['tag' => $tag->primary_key_data]) }}">Delete</a>
            </th>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
  </section>
@stop

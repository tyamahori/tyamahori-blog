@extends('layouts.admin.master')
@section('title', '投稿一覧')
@section('content')
  <section class="section">
    <div class="container">
      <h1 class="title">All Posts</h1>
      <h2><a href="{{ route('admin.post.create') }}" class="button is-dark">Create a New Post!</a></h2>
      <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
        <thead>
        <tr>
          <th>ID</th>
          <th>Created</th>
          <th>Updated</th>
          <th>Status</th>
          <th>Category</th>
          <th>Tags</th>
          <th>Title</th>
          <th>Description</th>
          <th>Action</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
          <th>ID</th>
          <th>Created</th>
          <th>Updated</th>
          <th>Status</th>
          <th>Category</th>
          <th>Tags</th>
          <th>Title</th>
          <th>Description</th>
          <th>Action</th>
        </tr>
        </tfoot>
        <tbody>
        @foreach($posts as $post)
          <tr>
            <th>{{ $post->getId()->getValue() }}</th>
            <th>
              {{ $post->getCreatedAt()->getValue() }}
            </th>
            <th>
              {{ $post->getUpdatedAt()->getValue() }}
            </th>
            <th>@if ($post->isPublic()->getValue()) public @else private @endif</th>
            <th>{{ $post->getCategoryName()->getValue() }}</th>
            <th>
              @foreach($post->getTags() as $tag)
                {{ $tag->getName()->getValue() }},
              @endforeach
            </th>
            <th>{{ $post->getTitle()->getValue() }}</th>
            <th>{{ $post->getDescription()->getValue() }}</th>
            <th>
              <a target=_blank class="button" href="{{ route('admin.post.id', ['id' => $post->getId()->getValue()]) }}">View</a>
              <a class="button" href="{{ route('admin.post.edit', ['id' => $post->getId()->getValue()]) }}">Edit</a>
              <a class="button has-background-danger has-text-white-bis" href="{{ route('admin.post.delete', ['id' => $post->getId()->getValue()]) }}">Delete</a>
            </th>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
  </section>
@stop



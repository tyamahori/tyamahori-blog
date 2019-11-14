@extends('layouts.admin.master')

@section('title', 'Create a Post')

@section('head')
  <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.13.1/highlight.min.js"></script>
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.13.1/styles/default.min.css">
@stop

@section('content')
  <section class="section">
    <div class="container">
      <h1 class="title is-1 is-spaced">New Post</h1>
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
          <label class="label">Title</label>
          <div class="control">
            <input class="input" type="text" placeholder="title" name="title" value="{{ old('title') }}">
          </div>
          <p class="help">Good Title</p>
        </div>
        <div class="field">
          <label class="label">Description</label>
          <div class="control">
            <input class="input" type="text" placeholder="description" name="description" value="{{ old('description') }}">
          </div>
          <p class="help">Good Description</p>
        </div>
        <div class="field">
          <label class="label">Category</label>
          <div class="control">
            <div class="select">
              <select name="category_id">
                <option>Select Category</option>
                @foreach($categories as $category)
                  <option value="{{ $category->getId()->getValue() }}" {{ $category->getId()->getValue() === (int) old('category_id') ? 'selected' : '' }}>{{ $category->getName()->getValue() }}</option>
                @endforeach
              </select>
            </div>
          </div>
        </div>
        <div class="field">
          <label class="label checkbox">Tag</label>
          <div class="control">
            @foreach($tags as $tag)
              <label for="checkbox_{{ $tag->getId()->getValue() }}">
                <input id="checkbox_{{ $tag->getId()->getValue() }}" type="checkbox" name="tags[]" value="{{ $tag->getId()->getValue() }}" {{ in_array($tag->getId()->getValue(), $selectedTags, false) ? 'checked' : '' }} >{{ $tag->getName()->getValue() }}
              </label>
            @endforeach
          </div>
          <p class="help">Select Tag</p>
        </div>
        <div class="field">
          <label class="label">Body</label>
          <div class="columns">
            <div class="control column">
              <textarea class="textarea" id="input" name="post" rows="20" placeholder="Markdown Only">{{ old('post') }}</textarea>
            </div>
            <div class="control column markdown-body" id="result">
            </div>
          </div>
        </div>
        <div class="field">
          <label class="label">Status</label>
          <div class="control">
            <div class="select">
              <select name="published">
                <option value="0" {{ old('published') === 0 ? 'checked' : '' }}>private</option>
                <option value="1" {{ old('published') === 1 ? 'checked' : '' }}>public</option>
              </select>
            </div>
          </div>
        </div>
        <button class="button is-primary">Create!</button>
      </form>
    </div>
  </section>
  <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
  <script>
    $(function () {
      marked.setOptions({
        langPrefix: ''
      });
      $('#input').keyup(function() {
        let src = $(this).val()
        let html = marked(src)
        $('#result').html(html)
        $('pre code').each(function(i, block) {
          hljs.highlightBlock(block)
        });
      });
    })
  </script>
  <script>hljs.initHighlightingOnLoad();</script>
@stop

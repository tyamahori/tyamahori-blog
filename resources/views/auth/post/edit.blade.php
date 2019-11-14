@extends('layouts.admin.master')

@section('title', 'Edit a Post')

@section('head')
  <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.13.1/highlight.min.js"></script>
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.13.1/styles/default.min.css">
@stop

@section('content')
  <section class="section">
    <div class="container">
      <h1 class="title is-1 is-spaced">Editing</h1>
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
            <input class="input" type="text" name="title" value="{{ old('title') ?? $post->getTitle()->getValue() }}">
          </div>
        </div>
        <div class="field">
          <label class="label">Description</label>
          <div class="control">
            <input class="input" type="text" name="description" value="{{ old('description') ?? $post->getDescription()->getValue() }}">
          </div>
        </div>
        <div class="field">
          <label class="label">Category</label>
          <div class="control">
            <div class="select">
              <select name="category_id">
                <option>Select Category</option>
                @foreach($categories as $category)
                  @if($selectedCategoryId->isEmpty())
                    <option value="{{ $category->getId()->getValue() }}" @if ($post->getCategoryId()->getValue() === $category->getId()->getValue()) selected @endif>{{ $category->getName()->getValue() }}</option>
                  @else
                    <option value="{{ $category->getId()->getValue() }}" @if ((int) old('category_id') === $category->getId()->getValue()) selected @endif>{{ $category->getName()->getValue() }}</option>
                  @endif
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
                @if ($selectedTagIds->isEmpty() )
                  <input type="checkbox" id="checkbox_{{ $tag->getId()->getValue() }}" name="tags[]" value="{{ $tag->getId()->getValue() }}" @if ($post->getTagIds()->contains($tag->getId()->getValue())) checked @endif>{{ $tag->getName()->getValue() }}
                @else
                  <input type="checkbox" id="checkbox_{{ $tag->getId()->getValue() }}" name="tags[]" value="{{ $tag->getId()->getValue() }}" @if ($selectedTagIds->contains($tag->getId()->getValue())) checked @endif>{{ $tag->getName()->getValue() }}
                @endif
              </label>
            @endforeach
          </div>
        </div>

        <div class="field">
          <label class="label">Body</label>
          <div class="columns">
            <div class="control column">
              <textarea name="post" id="input" class="textarea">{{ old('post') ?? $post->getMarkdownContent()->getValue() }}</textarea>
            </div>
            <div class="control column markdown-body" id="result">{!! $post->getParsedContent()->getValue() !!}</div>
          </div>
        </div>

        <div class="field">
          <label class="label">Status</label>
          <div class="control">
            <div class="select">
              <select name="published">
                <option value="0" @if (!$post->isPublic()->getValue()) selected @endif>private</option>
                <option value="1" @if ($post->isPublic()->getValue()) selected @endif>public</option>
              </select>
            </div>
          </div>
        </div>
        <input type="hidden" name="id" value="{{ $post->getId()->getValue() }}">
        <button class="button is-primary">Update</button>
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

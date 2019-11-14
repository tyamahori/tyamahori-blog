@extends('layouts.admin.master')

@section('title', 'Delete a Post')

@section('head')
<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.13.1/highlight.min.js"></script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.13.1/styles/default.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/github-markdown-css/2.10.0/github-markdown.css">
@stop

@section('content')
<section class="section">
    <div class="container">
      <h1 class="title is-1 is-spaced">Delete?</h1>
      <div class="field">
        <label class="label">タイトル</label>
        <div class="control">
          {{ $post->getTitle()->getValue() }}
        </div>
      </div>
      <div class="field">
        <label class="label">ディスクリプション</label>
        <div class="control">
          {{ $post->getDescription()->getValue() }}
        </div>
      </div>
      <div class="field">
        <label class="label">カテゴリ</label>
        <div class="control">
          {{ $post->getCategoryName()->getValue() }}
        </div>
      </div>
      <div class="field">
        <label class="label checkbox">タグ</label>
        <div class="control">
        @foreach ($post->getTags() as $tag)
        {{ $tag->getName()->getValue() }}
        @endforeach
        </div>
      </div>
    </div>
  </section>
  <section class="section">
    <div class="container">
      <div class="field">
        <div class="control">
          <div class="markdown-body">
            {!! $post->getParsedContent()->getValue() !!}
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="section">
    <div class="container">
        <form method="post">
          @csrf
          <input type="hidden" name="id" value="{{ $post->getId()->getValue() }}">
          <button class="button is-primary">削除</button>
        </form>
    </div>
  </section>
  <script>hljs.initHighlightingOnLoad();</script>
@stop

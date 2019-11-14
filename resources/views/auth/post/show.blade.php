@extends('layouts.base.master')

@section('page_title', 'tyamahori.com | ' . $content->title)

@section('page_description', 'tyamahori.com | ' . $content->description)

@section('head')
  <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.13.1/highlight.min.js"></script>
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.13.1/styles/solarized_dark.min.css">
@stop

@section('content')
  <div class="hero-body">
    <div class="container">
      <div class="columns is-multiline is-mobile is-centered">
        <div class="column is-11-mobile is-8-desktop is-centered">

          <div class="header-content">
            <div class="has-text-left">
              <h1 class="title">
                {{ $content->titleData }}
              </h1>
              <p>
                {{ $content->descriptionData }}
              </p>
            </div>
          </div>

          <div class="subheader-content has-text-left">
            <p>
              Category: {{ optional($content->category)->category }}<br>
              Tags:
              @foreach($content->tags as $tag)
                {{ $tag->nameColumnData }}
              @endforeach
              <br>
              Date: {{ $content->created_at }}
            </p>
            <hr/>
          </div>
          <div class="content">
            <div class="markdown-body">
              {!! $content->parsedContent !!}
            </div>
            <div class="sns-buttons">
              <a style="color: black;" href="http://www.facebook.com/share.php?u={{ url()->full() }}" rel="nofollow" target="_blank"><i class="fa fa-facebook-square fa-2x"></i></a>
              <a style="color: black;" href="https://twitter.com/share?url={{ url()->full() }}&via=tyamahori&related=tyamahori&hashtags=tyamahori&text={{ $content->title }}" rel="nofollow" target="_blank"><i class="fa fa-twitter fa-2x"></i></a>
              <a style="color: black;" href="http://getpocket.com/edit?url={{ url()->full() }}&title={{ $content->title }}" rel="nofollow" rel="nofollow" target="_blank"><i class="fa fa-get-pocket fa-2x"></i></a>
              <a style="color: black;" href="http://b.hatena.ne.jp/add?mode=confirm&url={{ url()->full() }}&title={{ $content->title }}" target="_blank" rel="nofollow"><i class="fa fa-hatena fa-2x"></i></a>
            </div>
          </div>
          <div class="has-text-left">
            <p><a class="button" href="{{ route('admin.post.index') }}">Home</a></p>
          </div>
        </div>
      </div>
      <script>hljs.initHighlightingOnLoad();</script>
    </div>
  </div>
@stop

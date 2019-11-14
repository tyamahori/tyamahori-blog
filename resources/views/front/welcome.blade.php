@extends('layouts.base.master')

@section('content')
  <div class="hero-body">
    <div class="container ">
      <div class="columns is-multiline is-mobile is-centered">
        <div class="column is-11-mobile is-8-desktop is-centered">
          @foreach($posts as $post)
            <div class="header-content">
              <div class="has-text-left">
                <h1 class="title">
                  {{ $post->getTitle()->getValue() }}
                </h1>
              </div>
            </div>

            <div class="content">
              <p>
                {{ $post->getDescription()->getValue() }}
              </p>
              <div class="has-text-left">
                <p><a class="button" href="{{ route('post', ['id' => $post->getId()->getValue()]) }}">Continue Reading</a></p>
              </div>
              <div class="subheader-content has-text-left">
                <p>
                  Category: {{ $post->getCategoryName()->getValue() }}<br>
                  Posted: {{ $post->getCreatedAt()->getValue() }}<br>
                  Updated: {{ $post->getUpdatedAt()->getValue() }}
                </p>
              </div>
            </div>
            <hr/>
          @endforeach
          {{ $posts->links('layouts.base.parts.pagination') }}
        </div>
      </div>
    </div>
  </div>
@stop

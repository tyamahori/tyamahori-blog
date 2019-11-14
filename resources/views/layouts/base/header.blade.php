<div class="hero-head">
  <header>
    <div class="container">
      <div class="section">
        <div class="has-text-centered">
          <h1 class="title is-1 is-spaced">
            <img class="logo" src="{{ asset('img/logo.png') }}" alt="{{ Config::get('app.name') }}">
          </h1>
          <h4 class="subtitle is-4">A Web Developer</h4>
        </div>
      </div>
      <div class="section">
        <div class="tabs is-centered">
          <ul>
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="{{ route('profile') }}">About</a></li>
          </ul>
        </div>
      </div>
    </div>
    @yield('header')
  </header>
</div>

<nav class="navbar" role="navigation" aria-label="main navigation">
  <div class="navbar-brand">
    <a class="navbar-item" href="{{ route('admin.home') }}">
      tyamahori.com
    </a>
  </div>

  <div id="navbarBasicExample" class="navbar-menu">
    <div class="navbar-start">
      <a class="navbar-item" href="{{ route('admin.post.index') }}">
        Post
      </a>

      <a class="navbar-item" href="{{ route('admin.category.index') }}">
        Category
      </a>

      <a class="navbar-item" href="{{ route('admin.tag.index') }}">
        Tag
      </a>

      <a class="navbar-item" href="{{ route('admin.files') }}" target="_blank">
        Media
      </a>
    </div>

    <div class="navbar-end">
      <div class="navbar-item">
        <div class="buttons">
          <form id="logout-form" action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="button has-background-danger has-text-white-bis">
              Log Out
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
  @yield('navigation')
</nav>

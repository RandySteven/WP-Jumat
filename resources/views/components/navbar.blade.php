<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="{{ route('post.index') }}">Post</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item {{ request()->is('post') ? 'active' : '' }}">
          <a class="nav-link" href="{{ route('post.index') }}">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item {{ request()->is('post/create') ? 'active' : '' }}">
          <a class="nav-link" href="{{ route('post.create') }}">Create</a>
        </li>
      </ul>
    </div>
</nav>

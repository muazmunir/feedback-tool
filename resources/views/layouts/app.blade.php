<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Web</title>
    @vite(['resources/js/app.js'])
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('/') }}">Feedback Tool</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav m-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('feedback.form') }}">Feedback Submission</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('feedback.all') }}">Feedback Listing</a>
            </li>
            
          </ul>
          <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button class="btn btn-outline-primary" type="submit">Logout</button> 
            
          </form>
        
        </div>
      </div>
    </nav>
    @yield('content')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    @stack('scripts') 
  </body>
</html>
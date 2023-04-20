<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion_Salles_Reunion</title>
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
</head>
<body>
<nav style="min-height: 52px" class="navbar navbar-expand-lg">
  <div class="container-fluid">
    <a href="#" title="Classroom For You"><img id="logo" style="height: 50px;"src="{{Storage::url('/imgs/logo.png')}}" alt="Classroom For You" class="img-fluid"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto me-5 mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{url('/')}}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About</a>
        </li>
      @if(session('name'))
      <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          {{session('name')}}
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#">Mon profil</a></li>
            <li><a class="dropdown-item" href="{{url('logout')}}">Se déconnecter</a></li>
          </ul>
        </li>
      @endif
      </ul>
    </div>
  </div>
</nav>
    @yield('content')
    <script src=" {{mix('js/app.js')}}"></script>
</body>
</html>
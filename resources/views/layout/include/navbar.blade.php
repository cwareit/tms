<nav class="navbar navbar-expand-sm bg-dark navbar-dark d-print-none">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
     <img src="{{ asset('images/emblem.png') }}" alt="Logo" style="height: 40px;">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav ms-auto">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="themesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          THEMES
        </a>
        <ul class="dropdown-menu" aria-labelledby="themesDropdown">

<li><a class="dropdown-item" href="{{ route('themes', ['theme' => 'cerulean']) }}">Cerulean</a></li>
<li><a class="dropdown-item" href="{{ route('themes', ['theme' => 'cosmo']) }}">Cosmo</a></li>
<li><a class="dropdown-item" href="{{ route('themes', ['theme' => 'cyborg']) }}">Cyborg</a></li>
<li><a class="dropdown-item" href="{{ route('themes', ['theme' => 'darkly']) }}">Darkly</a></li>
<li><a class="dropdown-item" href="{{ route('themes', ['theme' => 'flatly']) }}">Flatly</a></li>
<li><a class="dropdown-item" href="{{ route('themes', ['theme' => 'journal']) }}">Journal</a></li>
<li><a class="dropdown-item" href="{{ route('themes', ['theme' => 'litera']) }}">Litera</a></li>
<li><a class="dropdown-item" href="{{ route('themes', ['theme' => 'lumen']) }}">Lumen</a></li>
<li><a class="dropdown-item" href="{{ route('themes', ['theme' => 'lux']) }}">Lux</a></li>
<li><a class="dropdown-item" href="{{ route('themes', ['theme' => 'materia']) }}">Materia</a></li>
<li><a class="dropdown-item" href="{{ route('themes', ['theme' => 'minty']) }}">Minty</a></li>
<li><a class="dropdown-item" href="{{ route('themes', ['theme' => 'morph']) }}">Morph</a></li>
<li><a class="dropdown-item" href="{{ route('themes', ['theme' => 'pulse']) }}">Pulse</a></li>
<li><a class="dropdown-item" href="{{ route('themes', ['theme' => 'quartz']) }}">Quartz</a></li>
<li><a class="dropdown-item" href="{{ route('themes', ['theme' => 'sandstone']) }}">Sandstone</a></li>
<li><a class="dropdown-item" href="{{ route('themes', ['theme' => 'simplex']) }}">Simplex</a></li>
<li><a class="dropdown-item" href="{{ route('themes', ['theme' => 'sketchy']) }}">Sketchy</a></li>
<li><a class="dropdown-item" href="{{ route('themes', ['theme' => 'slate']) }}">Slate</a></li>
<li><a class="dropdown-item" href="{{ route('themes', ['theme' => 'solar']) }}">Solar</a></li>
<li><a class="dropdown-item" href="{{ route('themes', ['theme' => 'spacelab']) }}">Spacelab</a></li>
<li><a class="dropdown-item" href="{{ route('themes', ['theme' => 'superhero']) }}">Superhero</a></li>
<li><a class="dropdown-item" href="{{ route('themes', ['theme' => 'united']) }}">United</a></li>
<li><a class="dropdown-item" href="{{ route('themes', ['theme' => 'vapor']) }}">Vapor</a></li>
<li><a class="dropdown-item" href="{{ route('themes', ['theme' => 'yeti']) }}">Yeti</a></li>
<li><a class="dropdown-item" href="{{ route('themes', ['theme' => 'zephyr']) }}">Zephyr</a></li>
        </ul>
      </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('schools')}}">विद्यालय</a>
        </li>


        <li class="nav-item">
          <a class="nav-link"  href="{{route('search_teacher')}}">शिक्षक</a>
        </li>




        <li class="nav-item">
          <a class="nav-link" href="{{route('activities')}}">गतिविधिहरु</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="dropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            {{auth()->user()->name}}
          </a>
          <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <li><a class="dropdown-item" href="{{route('logout')}}">लगआउट</a></li>

          </ul>
        </li>

      </ul>
    </div>
  </div>
</nav> 
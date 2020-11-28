<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/contractors">Inżynieria Oprogramowania</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link {{ Route::is('contractors*') ? 'active' : ''}}" href="/contractors">Kontrahenci</span></a>
        <a class="nav-link {{ Route::is('departaments*') ? 'active' : ''}}" href="/departaments">Oddziały</a>
        <a class="nav-link {{ Route::is('contacts*') ? 'active' : ''}}" href="/contacts">Kontakty</a>
      </div>
    </div>
  </nav>

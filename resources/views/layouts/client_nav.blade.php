<li><a href="{{ route('dashboard')}} ">Vue d'ensemble</a></li>
<li><a data-toggle="collapse" data-target="#links" href="#">Mes annonces <span class="badge"></a></li>
<ul style="margin-left: 10px" class="nav collapse" id="links">
    <li><a href="{{ route('pending') }}">Annonces en cours</a></li>
    <li><a href="{{ route('done') }}">Annonces archivées</a></li>
</ul>
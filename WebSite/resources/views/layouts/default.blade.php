<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <meta name="language" content="fr-FR" />
    <title>@if (!empty($pageTitle)){{ $pageTitle . ' | ' }}@endif Requireris</title>

    <meta name="description" content="Requireris" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    {!! Html::style('css/bootstrap.min.css') !!}
    {!! Html::style('css/common.css') !!}
    @if (!empty($css))
        @foreach ($css as $link)
            {!! Html::style('css/' . $link . '.css') !!}
        @endforeach
    @endif

    {!! Html::script('js/jquery.min.js') !!}
    {!! Html::script('js/angular.min.js') !!}
    {!! Html::script('js/angular-bootstrap.min.js') !!}
    {!! Html::script('js/bootstrap.min.js') !!}
    {!! Html::script('js/common.js') !!}
    @if (!empty($js))
        @foreach ($js as $link)
            {!! Html::script('js/' . $link . '.js') !!}
        @endforeach
    @endif
</head>

<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{ route('app.index') }}">Requireris</a>
        </div>
        <div class="navbar-right">
            <ul class="nav navbar-nav">
                @if (Auth::check())
                <li><a href="{{ route('users.profile') }}">Votre profil</a></li>
                <li><a href="{{ route('tokens.index') }}">Vos tokens</a></li>
                <li><a href="{{ route('auth.logout') }}">Déconnexion</a></li>
                @else
                <li><a href="{{ route('auth.login') }}">Connexion</a></li>
                <li><a href="{{ route('users.create') }}">Inscription</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    {!! $content or '' !!}
</div>
</body>
</html>

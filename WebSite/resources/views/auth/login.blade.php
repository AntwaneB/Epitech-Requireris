<h2 class="page-header">Connexion</h2>

{!! Form::open(['route' => 'auth.auth']) !!}

@if (Session::has('error'))
    <div class="alert alert-danger">{{ Session::get('error') }}</div>
@endif

<div class="form-group">
    {!! Form::label('email', "Votre email") !!}
    {!! Form::text('email', NULL, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('password', "Votre mot de passe") !!}
    {!! Form::password('password', ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::submit('Connexion', ['class' => 'btn btn-primary']) !!}
    <div class="pull-right">
        <a href="{{ route('users.create') }}" class="btn btn-info">Inscription</a>
    </div>
</div>

{!! Form::close() !!}
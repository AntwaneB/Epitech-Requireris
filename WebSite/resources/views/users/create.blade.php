<h2 class="page-header">Inscription</h2>

{!! Form::open(['route' => 'users.store']) !!}

@if (Session::has('error'))
    <div class="alert alert-danger">{{ Session::get('error') }}</div>
@endif
@if (count($errors) > 0)
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
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
    {!! Form::label('password_confirmation', "Confirmation du mot de passe") !!}
    {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::submit('Inscription', ['class' => 'btn btn-primary']) !!}
    <div class="pull-right">
        <a href="{{ route('auth.login') }}" class="btn btn-info">Connexion</a>
    </div>
</div>

{!! Form::close() !!}

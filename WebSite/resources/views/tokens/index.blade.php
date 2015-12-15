<h2 class="page-header">Vos tokens</h2>

@if (empty($tokens) || count($tokens) == 0)

    <div class="alert alert-info">Vous n'avez pas encore enregistré de token sur votre compte.</div>

@else

    @foreach ($tokens as $token)
    <div class="panel panel-default">
        <div class="panel-heading">
            <strong>Token :</strong> {{ $token->token }}
            <span class="pull-right">
                <strong>Ajouté le :</strong> {{ $token->created_at }}
                -
                <em>
                    <a href="{{ route('tokens.show', $token->id) }}">» Voir le TOTP</a>
                </em>
            </span>
        </div>
    </div>
    @endforeach

@endif

<h2 class="page-header">Ajouter un token à votre compte</h2>

{!! Form::open(['route' => 'tokens.store']) !!}

<div class="form-group">
    <div class="input-group">
        {!! Form::text('token', NULL, ['class' => 'form-control', 'placeholder' => 'Token Google']) !!}
        <span class="input-group-btn">
            {!! Form::submit('Ajouter', ['class' => 'btn btn-primary']) !!}
        </span>
    </div>
    <p class="help-block">
        <em>Votre token Google sera chiffré de façon à ce que vous soyez le seul à le voir, même dans le cas où quelqu'un aurait accès à la base de donnée.</em>
    </p>
</div>

{!! Form::close() !!}

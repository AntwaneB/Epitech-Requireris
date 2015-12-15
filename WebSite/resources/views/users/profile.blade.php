<h2 class="page-header">Vos informations</h2>

<dl class="dl-horizontal">
    <dt>Votre e-mail</dt>
    <dd>{{ $user->email }}</dd>

    <dt>Votre clé de hash</dt>
    <dd>{{ Session::get('hash_key') }}</dd>
</dl>

<h2 class="page-header">Vos tokens</h2>

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

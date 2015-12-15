<h2 class="page-header">Informations du token</h2>

<dl class="dl-horizontal">
    <dt>Token</dt>
    <dd>{{ $token->token }}</dd>
    <dt>Ajouté le</dt>
    <dd>{{ $token->created_at }}</dd>
</dl>

<h2 class="page-header">TOTP généré</h2>

<div class="row">
    <div class="token-display col-md-6 col-md-offset-3">
        <div class="number">
            <!-- TOTP here -->
        </div>
        <div class="timer">
            <div class="content">
                <!-- Timer here -->
            </div>
        </div>
    </div>
</div>
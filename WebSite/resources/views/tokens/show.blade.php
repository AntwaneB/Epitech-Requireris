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
        <div id="controller" ng-app="get" ng-controller="getTotp" ng-init="init({{ $token->id }})">
        <div class="number" ng-repeat="(key, data) in totp">
            <!-- TOTP here -->
             @{{data}}
        </div>
        <div class="timer">
            <div class="content">
                <!-- Timer here -->
                 <p id="demo"></p>
            </div>
        </div>
        </div>
    </div>
</div>
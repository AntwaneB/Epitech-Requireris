<h2 class="page-header">Informations du token</h2>

<dl class="dl-horizontal">
    <dt>Service</dt>
    <dd>{{ $token->service }}</dd>
    <dt>Token</dt>
    <dd>{{ $token->token }}</dd>
    <dt>Ajouté le</dt>
    <dd>{{ $token->created_at }}</dd>
</dl>

<h2 class="page-header">TOTP généré</h2>

<div class="row text-center">
    <div class="token-display" id="controller" ng-app="get" ng-controller="getTotp" ng-init="init({{ $token->id }})">
        <div class="number" ng-repeat="(key, data) in totp">
             @{{data}}
        </div>
        <div class="timer">
             <div id="demo"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

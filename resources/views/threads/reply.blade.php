<div class="panel panel-info">
    <div class="panel-heading">
        <a href="#">
            {{ $reply->owner->name }}
        </a>
        <p style="color:gray; display: inline !important;"> said </p>{{ $reply->created_at->diffForHumans() }}...
    </div>

    <div class="panel-body">

        {{ $reply->body }}

    </div>
</div>
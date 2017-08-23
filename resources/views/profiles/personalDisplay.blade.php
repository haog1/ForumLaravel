
<div class="page-header" style="margin-top: 150px !important;">

    <h1>
        {{ $profileUser->name }}
        <small>Since: {{ $profileUser->created_at->diffForHumans() }}</small>
    </h1>



</div>

<article>
    <div class="panel panel-default" style="border:0;">
        <div class="panel-body">

            <!--title-->
            <div class="level">
                <h3 class="flex">
                    <a href="{{ $thread->path() }}" style="display:inline-block !important;">

                        @if(auth()->check() && $thread->hasUpdatesFor(auth()->user()))
                            <strong style="color: darkgray">{{ $thread->title }}</strong>
                        @else
                            {{ $thread->title }}
                        @endif
                    </a>
                </h3>
                <a href="{{ $thread->path() }}">
                    {{ $thread->replies_count }} {{ str_plural('reply', $thread->replies_count) }}
                </a>
            </div>

            <!-- subtitle -->
            <p>
                <a href="/profile/{{ $thread->creator->name }}" style="display: inline;">
                    {{ $thread->creator->name }}
                </a> posted at: {{ $thread->created_at->diffForHumans() }}
            </p>

            <!--body-->
            <div class="panel-body videowrappers">
                {!! substr($thread->body, 0, 256) !!}
            </div>

        </div>
    </div>
</article>
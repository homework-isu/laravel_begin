<div class="container">
    <div class="title">
        {{ $record['title'] }}
    </div>
    <div class="text">
        {{ $record['text'] }}
    </div>

    @isset($record['author'])
        <div class="author">
            Author: {{ $record['author'] }}
        </div>
    @endisset
</div>

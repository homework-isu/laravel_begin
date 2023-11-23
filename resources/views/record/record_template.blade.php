<div class="container record" id="{{ $record['id'] }}">
    
    <div class="author">
        Author: {{ $record['username'] }}
    </div>
	
	<div class="title">
        {{ $record['title'] }}
    </div>
    <div class="text">
        {{ $record['text'] }}
    </div>

    @isset($record['created_at'])
        <div class="author">
            {{ $record['created_at'] }}
        </div>
    @endisset
</div>


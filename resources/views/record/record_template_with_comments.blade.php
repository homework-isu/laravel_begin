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
        <div class="created_at">
            {{ $record['created_at'] }}
        </div>
    @endisset
	
	<div class="comments_block">
		<span>Комментариев</span>
		<span class="comments_count"></span>
	</div>
	<button class="show_comments", onclick="show_comments(event, {{ $record['id'] }})">показать комментарии</button>
</div>
@include('comments.add_comment', ['id' => $record['id']])



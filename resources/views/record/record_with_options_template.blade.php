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

    <div class="actions">
        {{-- Форма для удаления записи --}}
        <form action="{{ route('record.delete') }}" method="POST">
            @csrf
			@method('DELETE')
			<input type="hidden" name="id" value="{{ $record['id'] }}" />
            <button class="delete" type="submit">Удалить</button>
        </form>

		@if ($record['removed_from_publication'])
			<form action="{{ route('record.return') }}" method="POST">
				@csrf
				@method('PUT')
				<input type="hidden" name="id" value="{{ $record['id'] }}" />
				<button class="return" type="submit">Вернуть публикацию</button>
			</form>
		@else
			<form action="{{ route('record.remove') }}" method="POST">
				@csrf
				@method('PUT')
				<input type="hidden" name="id" value="{{ $record['id'] }}" />
				<button class="remove" type="submit">Снять с публикации</button>
			</form>
		@endif



        {{-- Ссылка для редактирования записи --}}
        <a href="{{ route('update_record', $record['id']) }}">
			<button class="update">
				Редактировать
			</button>
		</a>
		
    </div>


	<div class="comments_block", id="comments-{{ $record['id'] }}">
		<div class="count-line">
			<span class="icon">
				комментарии
			</span>
			<span class="comments_count">
			</span>
		</div>

		<button class="show-comments", onclick="make_comments_visibale(event, {{ $record['id'] }})">показать комментарии</button>
		<div class="comments hidden">
			@foreach ($comments as $comment)
				@include('comments.comment', ['deleteable' => true, 'comment' => $comment])
			@endforeach
		</div>
	</div>
</div>

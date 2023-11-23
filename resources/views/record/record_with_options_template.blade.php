<div class="container">
	
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
            <button type="submit">Удалить</button>
        </form>

        {{-- Ссылка для редактирования записи --}}
        <a href="{{ route('update_record', $record['id']) }}">Редактировать</a>
    </div>
</div>

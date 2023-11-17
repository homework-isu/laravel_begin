<header>
    <h1>{{ $pageTitle ?? 'Laravel-HW' }}</h1>
    <nav>
        <a href="/">home</a>
        <a href="/add_record">create record</a>
        <a href="/all_records">all records</a>
		@auth('web')
			<a href="/profile">profile</a>
		@endauth

		@guest('web')
			<a href="/login">login</a>
		@endguest
    </nav>
</header>
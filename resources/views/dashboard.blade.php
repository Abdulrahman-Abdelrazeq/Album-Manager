<x-app-layout>

    <div class="container">
        <h1>Your Albums</h1>
        <a href="{{ route('albums.create') }}" class="btn btn-primary">Create Album</a>
        <ul>
            @foreach ($albums as $album)
                <li>
                    <a href="{{ route('albums.show', $album) }}">{{ $album->name }}</a>
                    <a href="{{ route('albums.edit', $album) }}">Edit</a>
                    <form action="{{ route('albums.destroy', $album) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </li>
            @endforeach
        </ul>
    </div>

</x-app-layout>
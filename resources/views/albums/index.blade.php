<x-app-layout>

    <div class="albums container py-5">
        <h1 class="fs-1">Your Albums</h1>

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary mt-3 mb-5" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Create Album
        </button>
        
        <!-- Modal For Create Album-->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title fs-3" id="exampleModalLabel">Create Album</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form action="{{ route('albums.store') }}" method="POST">
                        <div class="modal-body">
                            @csrf
                            <div class="form-group">
                                <label class="fs-4" for="name">Album Name</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>       
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <ul class="row">
            @if ($albums)
            @foreach ($albums as $album)
            <li class="col-md-6 col-lg-4 col-xxl-3 mb-5">
                <div class="card rounded-br-full">
                    <div class="card-body">
                        <div class="card-title flex justify-content-between align-items-center">
                            <a class="fs-3" href="{{ route('albums.show', $album) }}">{{ $album->name }}</a>
                            <div class="flex gap-2">

                                <!-- Button trigger modal -->
                                <i class="edit fa-solid fa-pen-to-square cursor-pointer text-primary" data-bs-toggle="modal" data-bs-target="#edit-album-{{$album->id}}"></i>

                                <!-- Modal For Edit Album-->
                                <div class="modal fade" id="edit-album-{{$album->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title fs-3" id="exampleModalLabel">Update Album</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>

                                            <form action="{{ route('albums.update', $album) }}" method="POST">
                                                <div class="modal-body">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="form-group">
                                                        <label class="fs-4" for="name">Album Name</label>
                                                        <input type="text" name="name" class="form-control" value="{{ $album->name }}" required>
                                                    </div>       
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                

                                <!-- Button trigger modal -->
                                <i class="delete fa-solid fa-trash cursor-pointer text-danger" data-bs-toggle="modal" data-bs-target="#delete-album-{{$album->id}}"></i>

                                <!-- Modal For Delete Album-->
                                <div class="modal fade" id="delete-album-{{$album->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title fs-3" id="exampleModalLabel">Delete Album</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>

                                            <div class="modal-body">
                                                <p>Are you sure?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <form action="{{ route('albums.destroy', $album) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                                    <button type="submit" class="btn btn-danger">Yes</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('albums.show', $album) }}">
                        <img src="{{asset('images/camera-folder-6823627-5602904.webp')}}" class="card-img-bottom" alt="...">
                    </a>
                </div>
            </li>
            @endforeach
            @endif
        </ul>
    </div>

</x-app-layout>
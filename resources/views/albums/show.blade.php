<x-app-layout>

    <div class="Photos container py-5">
        <h1 class="fs-1 mb-3">{{ $album->name }}</h1>
        
        <form action="{{ route('albums.photos.store', $album) }}" method="POST" enctype="multipart/form-data" class="dropzone" id="albumDropzone">
            @csrf
            <div class="fallback">
                <input name="photos[]" type="file" multiple/>
            </div>
        </form>
        
        <ul class="row mt-4">
            @foreach ($album->photos as $photo)
                <li class="col-lg-6 col-xxl-4 mb-5">
                    <div class="card p-3">
                        <div class="card-title flex justify-content-between align-items-center ">
                            <small>{{$photo->name}}</small>

                            <!-- Button trigger modal -->
                            <i class="delete fa-solid fa-trash cursor-pointer text-danger" data-bs-toggle="modal" data-bs-target="#delete-photo-{{$photo->id}}"></i>
        
                            <!-- Modal For Delete Photo-->
                            <div class="modal fade" id="delete-photo-{{$photo->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title fs-3" id="exampleModalLabel">Delete Photo</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
        
                                        <div class="modal-body">
                                            <p>Are you sure?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <form action="{{ route('albums.photos.destroy', [$album, $photo]) }}" method="POST">
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
                        <div class="image overflow-hidden">
                            <!-- Button trigger modal -->
                            <img src="{{ asset("$photo->image_path") }}" data-bs-toggle="modal" data-bs-target="#open-photo-{{$photo->id}}"/>

                            <!-- Modal For Open Photo-->
                            <div class="modal fade" id="open-photo-{{$photo->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <img src="{{ asset("$photo->image_path") }}" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>

    <script>
        // Initialize Dropzone for images
        Dropzone.options.albumDropzone = {
            paramName: 'photos[]',
            maxFilesize: 2,
            acceptedFiles: 'image/*',
            init: function() {
                this.on("success", function(file, response) {
                    setTimeout(() => {
                        location.reload(); // Refresh the page on successful upload 
                    }, 2000);
                });
                this.on("error", function(file, response) {
                    console.error("Upload failed:", response);
                });
            }
        };
    </script>


</x-app-layout>

@php
    $languages = ['en' => 'English', 'da' => 'Dari', 'pa' => 'Pashto'];
@endphp
<div class="modal fade" id="edit-about" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Create</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.about.store') }}" method="post" id="edit-about-form"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        @foreach ($languages as $local => $label)
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="title[{{ $local }}]" class="col-form-label">Title</label>
                                    <input type="text" class="form-control" id="title[{{ $local }}]"
                                        name="title[{{ $local }}]"
                                        placeholder="Enter title in {{ $label }}">
                                </div>
                            </div>
                        @endforeach
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="image" class="col-form-label">Image</label>
                                <input type="file" class="form-control" id="image" name="image">
                                <img id="show-image" alt="about-image" width="150">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="type" class="col-form-label">Type</label>
                                <input type="text" class="form-control" id="type" name="type"
                                    placeholder="Enter type">
                            </div>
                        </div>
                        @foreach ($languages as $local => $label)
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="description[{{ $local }}]"
                                        class="col-form-label">Description</label>
                                    <textarea name="description[{{ $local }}]" id="description[{{ $local }}]"
                                        placeholder="Enter description in {{ $label }}" class="form-control"></textarea>
                                </div>
                            </div>
                        @endforeach

                    </div>


                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="update-about"><i
                        class="fas fa-file">&nbsp;</i>Update</button>
            </div>
        </div>
    </div>
</div>

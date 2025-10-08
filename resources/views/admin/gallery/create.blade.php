@php
    $languages = ['en' => 'English', 'da' => 'Dari', 'pa' => 'Pashto'];
@endphp
<div class="modal fade" id="create-gallery" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Create</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.gallery.store') }}" method="post" id="create-gallery-form"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        @foreach ($languages as $local => $lable)
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="slider-image" class="col-form-label">Select branch</label>
                                    <input type="text" class="form-control" id="branch_name[{{ $local }}]" name="branch_name[{{ $local }}]"
                                        placeholder="Enter branch name in {{ $lable }}">
                                </div>
                            </div>
                        @endforeach
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="image" class="col-form-label">Image</label>
                                <input type="file" class="form-control" id="image" name="image[]" multiple>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="store-gallery"><i
                        class="fas fa-file">&nbsp;</i>Store</button>
            </div>
        </div>
    </div>
</div>

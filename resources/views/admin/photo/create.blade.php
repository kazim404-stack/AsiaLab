<div class="modal fade" id="create-photo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Create</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.photos.store')}}" method="post" id="photo-form"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="slider-image" class="col-form-label">Image</label>
                                <input type="file" class="form-control" id="image" name="image[]" multiple>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="type" class="col-form-label">type</label>
                                <select name="type" id="type" class="form-control">
                                    <option value="" disabled selected>Select type</option>
                                    <option value="gallery">Gallery</option>
                                    <option value="machine">Machine</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="store-photo"><i
                        class="fas fa-file">&nbsp;</i>Store</button>
            </div>
        </div>
    </div>
</div>

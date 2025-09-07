<div class="modal fade" id="create-about-image" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Create</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.about.images.store',['about'=>$aboutId]) }}" method="post" id="about-image-form"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                        <div class="col-md-6">
                            <div class="mb-3">
                                <input type="hidden" class="form-control" id="about_us_id" name="about_us_id" value="{{ $about->id }}">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="slider-image" class="col-form-label">Image</label>
                                <input type="file" class="form-control" id="image" name="image[]" multiple>
                            </div>
                        </div>
                    </div>


                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="store-about-image"><i
                        class="fas fa-file">&nbsp;</i>Store</button>
            </div>
        </div>
    </div>
</div>

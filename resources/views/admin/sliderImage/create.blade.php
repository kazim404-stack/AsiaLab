<div class="modal fade" id="create-slider-image" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Create</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.slider-images.store') }}" method="post" id="slider-image-form"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="slider_id" class="col-form-label">select slider</label>
                                <select name="slider_id" id="slider_id" class="form-control">
                                    <option value="" selected disabled class="form-control">Select slider</option>
                                    @foreach ($sliders as $slider)
                                        <option value="{{ $slider->id }}">{{ $slider->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="slider-image" class="col-form-label">Type</label>
                                <select name="type" id="type" class="form-control">
                                    <option value="en">English</option>
                                    <option value="da">Dari</option>
                                    <option value="pa">Pashto</option>
                                </select>
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
                <button type="button" class="btn btn-primary" id="store-slider-image"><i
                        class="fas fa-file">&nbsp;</i>Store</button>
            </div>
        </div>
    </div>
</div>

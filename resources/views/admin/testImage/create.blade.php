@php
    $languages = ['en' => 'English', 'da' => 'Dari'];
@endphp
<div class="modal fade" id="create-test-image" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Create</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.tests.images.store', ['test' => $testId]) }}" method="post"
                    id="create-test-image-form">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="image" class="col-form-label">Select image</label>
                                <input type="file" class="form-control" id="image" name="image[]" multiple>
                                 <input type="hidden" id="test_id" name="test_id" value="{{ $testId }}">

                            </div>
                        </div>
                    </div>


                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="store-test-image"><i
                        class="fas fa-file">&nbsp;</i>Store</button>
            </div>
        </div>
    </div>
</div>

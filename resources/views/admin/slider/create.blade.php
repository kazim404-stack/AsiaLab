@php
    $languages = ['en' => 'English', 'da' => 'Dari','pa' => "Pashto"];
@endphp
<div class="modal fade" id="create-slider" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Create</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.sliders.store') }}" method="post" id="slider-form"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        @foreach ($languages as $local => $label)
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="title[{{ $local }}]" class="col-form-label">Title</label>
                                    <input type="text" placeholder="Enter title in {{ $label }}"
                                        class="form-control" id="title[{{ $local }}]"
                                        name="title[{{ $local }}]">
                                </div>
                            </div>
                        @endforeach
                        @foreach ($languages as $local => $label)
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="description-{{ $local }}"
                                        class="col-form-label">Description</label>
                                    <textarea name="description[{{ $local }}]" placeholder="Enter description in {{ $label }}"
                                        id="description-slider[{{ $local }}]" class="form-control" cols="1" rows="1"></textarea>
                                </div>
                            </div>
                        @endforeach


                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="telegram" class="col-form-label">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>

                            </div>
                        </div>

                    </div>


                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="store-slider"><i
                        class="fas fa-file">&nbsp;</i>Store</button>
            </div>
        </div>
    </div>
</div>

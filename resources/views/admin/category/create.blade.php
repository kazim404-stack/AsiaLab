@php
    $languages = ['en' => 'English', 'da' => 'Dari','pa' => "Pashto"];
@endphp
<div class="modal fade" id="create-category" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Create</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.categories.store') }}" method="post" id="create-category-form"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                        @foreach ($languages as $local => $label)
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="logo" class="col-form-label">name</label>
                                    <input type="text" class="form-control" id="name[{{ $local }}]"
                                        name="name[{{ $local }}]"
                                        placeholder="Enter name in {{ $label }}">
                                </div>
                            </div>
                        @endforeach
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="parent_id" class="col-form-label">Category Level</label>
                                <div id="parent-category-container">
                                    {{-- This select will be loaded via AJAX --}}
                                    <select name="parent_id" id="parent_id" class="form-control">
                                        <option value="0">Main Category</option>
                                    </select>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="facebook" class="col-form-label">Image</label>
                                <input type="file" class="form-control" id="image" name="image">
                            </div>
                        </div>

                        @foreach ($languages as $local => $label)
                            <div class="col-md-45Z ">
                                <div class="mb-3">
                                    <label for="logo" class="col-form-label">Description</label>
                                    <textarea name="description[{{ $local }}]" id="description[{{ $local }}]" class="form-control textarea"
                                        placeholder="Enter in description {{ $label }}" cols="3" rows="3"></textarea>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="store-category"><i
                        class="fas fa-file">&nbsp;</i>Store</button>
            </div>
        </div>
    </div>
</div>

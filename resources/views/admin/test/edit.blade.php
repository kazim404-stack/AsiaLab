@php
    $languages = ['en' => 'English', 'da' => 'Dari','pa' => "Pashto"];
@endphp
<div class="modal fade" id="edit-test" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Update</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" id="edit-test-form">
                    @csrf
                    <div class="row">
                        @foreach ($languages as $local => $label)
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name[{{ $local }}]" class="col-form-label">name</label>
                                    <input type="text" class="form-control" id="name[{{ $local }}]"
                                        name="name[{{ $local }}]"
                                        placeholder="Enter name in {{ $label }}">
                                </div>
                            </div>
                        @endforeach
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name[{{ $local }}]" class="col-form-label">Select category</label>
                                <div class="edit-product-category">

                                </div>
                            </div>
                        </div>



                        @foreach ($languages as $local => $label)
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="description[{{ $local }}]"
                                        class="col-form-label">Description</label>
                                    <textarea name="description[{{ $local }}]" id="edit-description[{{ $local }}]"
                                        placeholder="Enter description in {{ $label }}" class="form-control textarea-{{ $local }}"></textarea>
                                </div>
                            </div>
                        @endforeach

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="unite" class="col-form-label">Unite</label>
                                <input type="text" class="form-control" id="unite" name="unite"
                                    placeholder="Enter unite">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="refrence" class="col-form-label">Refrence</label>
                                <input type="text" class="form-control" id="refrence" name="refrence"
                                    placeholder="Enter refrence">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="status" class="col-form-label">Status</label>
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
                <button type="button" class="btn btn-primary" id="update-test"><i
                        class="fas fa-file">&nbsp;</i>Update</button>
            </div>
        </div>
    </div>
</div>

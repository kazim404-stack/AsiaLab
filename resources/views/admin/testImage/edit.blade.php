@php
    $languages = ['en' => 'English', 'da' => 'Dari'];
@endphp
<div class="modal fade" id="edit-machine" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Create</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="edit-machine-form">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="method_id" class="col-form-label">Select Method</label>
                                <select name="method_id" id="method_id" class="form-control select2">
                                    <option value="" selected disabled>Select method</option>
                                    @foreach ($methods as $method)
                                    <option value="{{ $method->id }}">{{ $method->name }}</option>


                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @foreach ($languages as $local => $label)
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name[{{ $local }}]" class="col-form-label">Name</label>
                                    <input type="text" class="form-control" id="name[{{ $local }}]"
                                        name="name[{{ $local }}]"
                                        placeholder="Enter name in {{ $label }}">
                                </div>
                            </div>
                        @endforeach
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="model" class="col-form-label">Model</label>
                                <input type="text" class="form-control" id="model" name="model"
                                    placeholder="Enter model">
                            </div>
                        </div>
                        @foreach ($languages as $local => $label)
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="description[{{ $local }}]"
                                        class="col-form-label">Description</label>
                                    <textarea name="description[{{ $local }}]" id="description[{{ $local }}]" class="form-control"
                                        rows="2" cols="2" placeholder="Enter description in {{ $label }}"></textarea>

                                </div>
                            </div>
                        @endforeach
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
                <button type="button" class="btn btn-primary" id="update-machine"><i
                        class="fas fa-file">&nbsp;</i>Update</button>
            </div>
        </div>
    </div>
</div>

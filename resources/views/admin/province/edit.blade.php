@php
    $languages = ['en' => 'English', 'da' => 'Dari','pa' => "Pashto"];
@endphp
<div class="modal fade" id="edit-province" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Create</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form  method="post" id="edit-province-form"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        @foreach ($languages as $local => $label)
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="province[{{ $local }}]" class="col-form-label">Province in {{ $label }}</label>
                                    <input type="text" placeholder="Enter province in {{ $label }}"
                                        class="form-control" id="province[{{ $local }}]"
                                        name="province[{{ $local }}]">
                                </div>
                            </div>
                        @endforeach
                    </div>


                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="update-province"><i
                        class="fas fa-file">&nbsp;</i>Store</button>
            </div>
        </div>
    </div>
</div>

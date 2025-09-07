@php
    $languages = ['en' => 'English', 'da' => 'Dari'];
@endphp
<div class="modal fade" id="create-general-setting" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Create</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.general-settings.store') }}" method="post" id="general-setting-form"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="site_name" class="col-form-label">Site Name</label>
                                <input type="text" placeholder="Enter site name" class="form-control" id="site_name"
                                    name="site_name">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="logo" class="col-form-label">Logo</label>
                                <input type="file" class="form-control" id="logo" name="logo">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="facebook" class="col-form-label">Facebook</label>
                                <input type="text" placeholder="Enter facebook" class="form-control" id="facebook"
                                    name="facebook">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="instagram" class="col-form-label">Instagram</label>
                                <input type="text" placeholder="Enter instagram" class="form-control" id="instagram"
                                    name="instagram">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="whatsapp" class="col-form-label">Whatsapp</label>
                                <input type="text" placeholder="Enter whatsapp" class="form-control" id="whatsapp"
                                    name="whatsapp">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="youtube" class="col-form-label">Youtube</label>
                                <input type="text" placeholder="Enter youtube" class="form-control" id="youtube"
                                    name="youtube">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="telegram" class="col-form-label">Telegram</label>
                                <input type="text" placeholder="Enter telegram" class="form-control" id="telegram"
                                    name="telegram">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="x" class="col-form-label">X</label>
                                <input type="text" placeholder="Enter x" class="form-control" id="x"
                                    name="x">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="linkedin" class="col-form-label">Linedin</label>
                                <input type="text" placeholder="Enter linkedin" class="form-control" id="linkedin"
                                    name="linkedin">
                            </div>
                        </div>
                    </div>


                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="store-general-setting"><i
                        class="fas fa-file">&nbsp;</i>Store</button>
            </div>
        </div>
    </div>
</div>

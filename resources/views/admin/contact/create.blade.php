@php
    $languages = ['en' => 'English', 'da' => 'Dari', 'pa' => 'Pashto'];

@endphp
<div class="modal fade" id="create-contact" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Create</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.contacts.store') }}" method="post" id="contact-form">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="site_name" class="col-form-label">Site name</label>
                                <input type="hidden"
                                    value="{{ !empty($generalSetting->id) ? $generalSetting->id : '' }}"
                                    name="general_setting_id">
                                <p class="form-control-plaintext">
                                    {{ !empty($generalSetting->site_name) ? $generalSetting->site_name : '' }}</p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="province" class="col-form-label">Province</label>
                                <select name="province_id" id="province_id" class="form-control">
                                    @foreach ($provinces as $province)
                                        <option value="{{ $province->id }}">{{ $province->province }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="email" class="col-form-label">Email</label>
                                <input type="text" class="form-control" id="email" name="email"
                                    placeholder="Enter email">
                            </div>
                        </div>


                        @foreach ($languages as $local => $label)
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="address[{{ $local }}]" class="col-form-label">Address</label>
                                    <textarea class="form-control" name="address[{{ $local }}]" id="address[{{ $local }}]"
                                        placeholder="Enter address in {{ $label }}"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="state[{{ $local }}]" class="col-form-label">State</label>
                                    <textarea class="form-control" name="state[{{ $local }}]" id="state[{{ $local }}]"
                                        placeholder="Enter state in {{ $label }}"></textarea>
                                </div>
                            </div>
                        @endforeach
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="video_links" class="col-form-label">Video link</label>
                                <input type="url" class="form-control" id="video_links" name="video_links"
                                    placeholder="Enter video links">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="status" class="col-form-label">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>

                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="store-contact"><i
                        class="fas fa-file">&nbsp;</i>Store</button>
            </div>
        </div>
    </div>
</div>

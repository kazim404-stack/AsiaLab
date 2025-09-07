
<div class="modal fade" id="create-phone" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Create</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.phones.store') }}" method="post" id="phone-form">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="contact" class="col-form-label">Contact</label>
                                <select name="contact_id" id="contact_id" class="form-control">
                                    @foreach ($contacts as $contact)
                                    <option value="{{ $contact->id }}">{{ $contact->getTranslation('address','en') }}</option>
                                    @endforeach

                                </select>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="email" class="col-form-label">Phone number</label>
                                <input type="text" class="form-control" id="phone_number"
                                    name="phone_number" placeholder="Enter phone number">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="store-phone"><i
                        class="fas fa-file">&nbsp;</i>Store</button>
            </div>
        </div>
    </div>
</div>

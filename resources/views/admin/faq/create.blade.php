@php
    $languages = ['en' => 'English', 'da' => 'Dari', 'pa' => 'Pashto'];
@endphp
<div class="modal fade" id="create-faq" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Create</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.faqs.store') }}" method="post" id="faq-form">
                    @csrf
                    <div class="row">
                        @foreach ($languages as $local => $label)
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="contact" class="col-form-label">Question</label>
                                    <textarea name="question[{{ $local }}]" id="question[{{ $local }}]"
                                        placeholder="Enter question in {{ $label }}" class="form-control"></textarea>
                                </div>
                            </div>
                        @endforeach

                        @foreach ($languages as $local => $label)
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="contact" class="col-form-label">Answear</label>
                                    <textarea name="answear[{{ $local }}]" id="answear[{{ $local }}]"
                                        placeholder="Enter answear in {{ $label }}" class="form-control"></textarea>
                                </div>
                            </div>
                        @endforeach
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="contact" class="col-form-label">Status</label>
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
                <button type="button" class="btn btn-primary" id="store-faq"><i
                        class="fas fa-file">&nbsp;</i>Store</button>
            </div>
        </div>
    </div>
</div>

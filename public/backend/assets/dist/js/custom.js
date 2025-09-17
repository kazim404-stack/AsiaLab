$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    window.availableLanguages.forEach(lang => {
        initTinyMCE(`#description\\[${lang}\\]`, '', lang);
    });

    // Edit mode initialization
    function loadEditEditors(response, selector) {
        window.availableLanguages.forEach(lang => {
            if ($(`${selector}\\[${lang}\\]`).length) {
                const content = response?.data?.description?.[lang] || '';

                initTinyMCE(`${selector}\\[${lang}\\]`, content, lang);
            }
        });
    }
    function initTinyMCE(selector, content = '', lang = 'en') {
        const fonts = { en: "Inter, sans-serif", da: "Vazirmatn, sans-serif", pa: "Noto Naskh Arabic, serif" };
        const dirs = { en: "ltr", da: "rtl", pa: "rtl" };

        const existingEditor = tinymce.get($(selector).attr('id'));
        if (existingEditor) {
            existingEditor.remove();
        }


        tinymce.init({
            selector: selector,
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
            font_family_formats: `Inter=Inter, sans-serif; Vazirmatn=Vazirmatn, sans-serif; Noto Naskh Arabic=Noto Naskh Arabic, serif; Arial=Arial,Helvetica,sans-serif`,
            content_style: `body { font-family: ${fonts[lang]}; direction: ${dirs[lang]}; }`,
            directionality: dirs[lang],
            setup: function (editor) {
                editor.on('init', function () {
                    editor.setContent(content || '');
                });
            }
        });
    }
    $(document).on('click', '#confirmation', function (e) {
        e.preventDefault();
        let getHref = $(this).attr('href');
        let dataTableId = $(this).data('datatable_id');
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: '#0d6efd',
            cancelButtonColor: '#6c757d',
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: getHref,
                    method: 'DELETE',
                    success: function (response) {
                        if (response['status'] == 'success') {
                            toastr.success(response.message);
                            $(dataTableId).DataTable().ajax.reload(null, false);
                        }
                    },
                    error: function () {
                        toastr.error("Some issue occured");
                    }
                });
            }
        });
    });
    // store general setting
    $(document).on('click', '#store-general-setting', function (e) {
        e.preventDefault();
        let form = $('#general-setting-form');
        let data = new FormData(form[0]);
        let btn = $(this);
        let getUrl = form.attr('action');
        let modal = $('#create-general-setting');
        btn.prop('disabled', true);
        $.ajax({
            url: getUrl,
            type: 'post',
            processData: false,
            contentType: false,
            data: data,
            success: function (response) {
                if (response.status == "success") {

                    btn.prop('disabled', false);
                    form[0].reset();
                    modal.modal('hide');
                    toastr.success(response.message);
                    $("#generalsettings-table").DataTable().ajax.reload(null, false);
                }

            }, error: function (xhr) {
                btn.prop('disabled', false);

                if (xhr.status === 422) {
                    modal.modal('show');
                    $('.text-danger').remove(); // Clear all old error messages

                    let errors = xhr.responseJSON.errors;

                    $.each(errors, function (key, value) {
                        let fieldName;

                        // Convert dot notation to array format: address.en => address[en]
                        if (key.includes('.')) {
                            const parts = key.split('.');
                            fieldName = parts.shift() + '[' + parts.join('][') + ']';
                        } else {
                            fieldName = key;
                        }

                        // Select by name attribute
                        const inputField = $(`[name="${fieldName}"]`);

                        if (inputField.length > 0) {
                            inputField.next('.text-danger').remove();
                            inputField.after(`<p class="text-danger">${value[0]}</p>`);
                        } else {
                            console.warn('Field not found:', fieldName);
                        }
                    });
                }
            }
        });
    });
    // Edit general setting
    $(document).on('click', '.edit-general-setting-btn', function (e) {
        e.preventDefault();
        let getUrl = $(this).attr("href");
        $.ajax({
            url: getUrl,
            type: 'get',
            success: function (response) {
                if (response.status == "success") {


                    $("#edit-general-setting-form [name='site_name']").val(response.data.site_name);
                    $("#edit-general-setting-form [name='facebook']").val(response.data.facebook);
                    $("#edit-general-setting-form [name='instagram']").val(response.data.instagram);
                    $("#edit-general-setting-form [name='telegram']").val(response.data.telegram);
                    $("#edit-general-setting-form [name='whatsapp']").val(response.data.whatsapp);
                    $("#edit-general-setting-form [name='youtube']").val(response.data.youtube);
                    $("#edit-general-setting-form [name='x']").val(response.data.x);
                    $("#edit-general-setting-form [name='linkedin']").val(response.data.linkedin);

                    $("#show-logo").attr('src', response.data.logo);
                    let actionUrl = `general-settings/${response.data.id}`;
                    $("#edit-general-setting-form").attr('action', actionUrl);
                }
            },
            error: function (xhr) {
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    toastr.error(xhr.responseJSON.message);
                } else {
                    toastr.error("An unexpected error occurred.");
                }
            }
        });
    });
    // update general setting
    $(document).on('click', '#update-general-setting', function (e) {
        e.preventDefault();
        let form = $('#edit-general-setting-form');
        let getUrl = form.attr('action');
        let data = new FormData(form[0]);
        data.append('_method', 'PUT');
        let modal = $('#edit-general-setting');
        $.ajax({
            url: getUrl,
            type: 'post',
            data: data,
            processData: false,
            contentType: false,

            success: function (response) {
                if (response.status == "success") {
                    toastr.success(response.message);
                    $('#generalsettings-table').DataTable().ajax.reload(null, false);
                    modal.modal('hide');
                }
            },
            error: function (xhr) {


                if (xhr.status === 422) {
                    modal.modal('show');
                    $('.text-danger').remove(); // Clear all old error messages

                    let errors = xhr.responseJSON.errors;

                    $.each(errors, function (key, value) {
                        let fieldName;

                        // Convert dot notation to array format: address.en => address[en]
                        if (key.includes('.')) {
                            const parts = key.split('.');
                            fieldName = parts.shift() + '[' + parts.join('][') + ']';
                        } else {
                            fieldName = key;
                        }

                        // Select by name attribute
                        const inputField = $(`[name="${fieldName}"]`);

                        if (inputField.length > 0) {
                            inputField.next('.text-danger').remove();
                            inputField.after(`<p class="text-danger">${value[0]}</p>`);
                        } else {
                            console.warn('Field not found:', fieldName);
                        }
                    });
                }
            }
        })
    });
    // store contact
    $(document).on('click', '#store-contact', function (e) {
        e.preventDefault();
        let form = $('#contact-form');
        let data = new FormData(form[0]);
        let btn = $(this);
        let getUrl = form.attr('action');
        let modal = $('#create-contact');
        btn.prop('disabled', true);
        $.ajax({
            url: getUrl,
            type: 'post',
            processData: false,
            contentType: false,
            data: data,
            success: function (response) {
                if (response.status == "success") {

                    btn.prop('disabled', false);
                    form[0].reset();
                    modal.modal('hide');
                    toastr.success(response.message);
                    $("#contacts-table").DataTable().ajax.reload(null, false);
                }

            }, error: function (xhr) {
                btn.prop('disabled', false);

                if (xhr.status === 422) {
                    modal.modal('show');
                    $('.text-danger').remove(); // Clear all old error messages

                    let errors = xhr.responseJSON.errors;

                    $.each(errors, function (key, value) {
                        let fieldName;

                        // Convert dot notation to array format: address.en => address[en]
                        if (key.includes('.')) {
                            const parts = key.split('.');
                            fieldName = parts.shift() + '[' + parts.join('][') + ']';
                        } else {
                            fieldName = key;
                        }

                        // Select by name attribute
                        const inputField = $(`#contact-form [name="${fieldName}"]`);

                        if (inputField.length > 0) {
                            inputField.next('.text-danger').remove();
                            inputField.after(`<p class="text-danger">${value[0]}</p>`);
                        } else {
                            console.warn('Field not found:', fieldName);
                        }
                    });
                }
            }
        });
    });
    // Edit contact

    $(document).on('click', '.edit-contact-btn', function (e) {
        e.preventDefault();
        let getUrl = $(this).attr("href");
        $.ajax({
            url: getUrl,
            type: 'get',
            success: function (response) {
                if (response.status == "success") {
                    window.availableLanguages.forEach(lang => {
                        $("#edit-contact-form [name='address[" + lang + "]']").val(response.data.address?.[lang] ?? '');
                    });
                    let select = $("#edit-contact-form [name='province_id']");
                    select.empty();
                    response.provinces.forEach(province => {
                        let selected = province.id == response.data.province_id ? 'selected' : '';
                        select.append(`<option value="${province.id}" ${selected}>${province.province.en}</option>`)

                    });
                    $("#edit-contact-form [name='email']").val(response.data.email);
                    $("#edit-contact-form [name='general_setting_id']").val(response.generalSetting.id);
                    $('#edit-contact-form p.form-control-plaintext').text(response.generalSetting.site_name);
                    $("#edit-contact-form [name='status']").val(response.data.status).trigger('change');
                    let actionUrl = `contacts/${response.data.id}`;
                    $("#edit-contact-form").attr('action', actionUrl);
                }
            },
            error: function (xhr) {
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    toastr.error(xhr.responseJSON.message);
                } else {
                    toastr.error("An unexpected error occurred.");
                }
            }
        });
    });
    // update contact
    $(document).on('click', '#update-contact', function (e) {
        e.preventDefault();
        let form = $('#edit-contact-form');
        let getUrl = form.attr('action');
        let data = new FormData(form[0]);
        data.append('_method', 'PUT');
        let modal = $('#edit-contact');
        $.ajax({
            url: getUrl,
            type: 'post',
            data: data,
            processData: false,
            contentType: false,

            success: function (response) {
                if (response.status == "success") {
                    toastr.success(response.message);
                    $('#contacts-table').DataTable().ajax.reload(null, false);
                    modal.modal('hide');
                }
            },
            error: function (xhr) {


                if (xhr.status === 422) {
                    modal.modal('show');
                    $('.text-danger').remove(); // Clear all old error messages

                    let errors = xhr.responseJSON.errors;

                    $.each(errors, function (key, value) {
                        let fieldName;

                        // Convert dot notation to array format: address.en => address[en]
                        if (key.includes('.')) {
                            const parts = key.split('.');
                            fieldName = parts.shift() + '[' + parts.join('][') + ']';
                        } else {
                            fieldName = key;
                        }

                        // Select by name attribute
                        const inputField = $(`#edit-contact-form [name="${fieldName}"]`);

                        if (inputField.length > 0) {
                            inputField.next('.text-danger').remove();
                            inputField.after(`<p class="text-danger">${value[0]}</p>`);
                        } else {
                            console.warn('Field not found:', fieldName);
                        }
                    });
                }
            }
        })
    });
    // store phone
    $(document).on('click', '#store-phone', function (e) {
        e.preventDefault();
        let form = $('#phone-form');
        let data = new FormData(form[0]);
        let btn = $(this);
        let getUrl = form.attr('action');
        let modal = $('#create-phone');
        btn.prop('disabled', true);
        $.ajax({
            url: getUrl,
            type: 'post',
            processData: false,
            contentType: false,
            data: data,
            success: function (response) {
                if (response.status == "success") {

                    btn.prop('disabled', false);
                    form[0].reset();
                    modal.modal('hide');
                    toastr.success(response.message);
                    $("#phones-table").DataTable().ajax.reload(null, false);
                }

            }, error: function (xhr) {
                btn.prop('disabled', false);

                if (xhr.status === 422) {
                    modal.modal('show');
                    $('.text-danger').remove(); // Clear all old error messages

                    let errors = xhr.responseJSON.errors;

                    $.each(errors, function (key, value) {
                        let fieldName;

                        // Convert dot notation to array format: address.en => address[en]
                        if (key.includes('.')) {
                            const parts = key.split('.');
                            fieldName = parts.shift() + '[' + parts.join('][') + ']';
                        } else {
                            fieldName = key;
                        }

                        // Select by name attribute
                        const inputField = $(`[name="${fieldName}"]`);

                        if (inputField.length > 0) {
                            inputField.next('.text-danger').remove();
                            inputField.after(`<p class="text-danger">${value[0]}</p>`);
                        } else {
                            console.warn('Field not found:', fieldName);
                        }
                    });
                }
            }
        });
    });
    // edit phone
    $(document).on('click', '.edit-phone-btn', function (e) {
        e.preventDefault();


        let getUrl = $(this).attr("href");
        $.ajax({
            url: getUrl,
            type: 'get',
            success: function (response) {
                if (response.status == "success") {
                    let select = $("#edit-phone-form [name='contact_id']");
                    select.empty();
                    response.contacts.forEach((item, index) => {
                        let selected = item.id == response.data.contact_id ? 'selected' : '';
                        select.append(`<option value="${item.id}" ${selected}>${item.state.en}</option>`)
                    });

                    $("#edit-phone-form [name='phone_number']").val(response.data.phone_number);
                    let actionUrl = `phones/${response.data.id}`;
                    $("#edit-phone-form").attr('action', actionUrl);
                }
            },
            error: function (xhr) {
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    toastr.error(xhr.responseJSON.message);
                } else {
                    toastr.error("An unexpected error occurred.");
                }
            }
        });
    });
    // Update phone
    $(document).on('click', '#update-phone', function (e) {
        e.preventDefault();
        let form = $('#edit-phone-form');
        let getUrl = form.attr('action');
        let data = new FormData(form[0]);
        data.append('_method', 'PUT');
        let modal = $('#edit-phone');
        $.ajax({
            url: getUrl,
            type: 'post',
            data: data,
            processData: false,
            contentType: false,

            success: function (response) {
                if (response.status == "success") {
                    toastr.success(response.message);
                    $('#phones-table').DataTable().ajax.reload(null, false);
                    modal.modal('hide');
                }
            },
            error: function (xhr) {


                if (xhr.status === 422) {
                    modal.modal('show');
                    $('.text-danger').remove(); // Clear all old error messages

                    let errors = xhr.responseJSON.errors;

                    $.each(errors, function (key, value) {
                        let fieldName;

                        // Convert dot notation to array format: address.en => address[en]
                        if (key.includes('.')) {
                            const parts = key.split('.');
                            fieldName = parts.shift() + '[' + parts.join('][') + ']';
                        } else {
                            fieldName = key;
                        }

                        // Select by name attribute
                        const inputField = $(`#edit-phone-form [name="${fieldName}"]`);

                        if (inputField.length > 0) {
                            inputField.next('.text-danger').remove();
                            inputField.after(`<p class="text-danger">${value[0]}</p>`);
                        } else {
                            console.warn('Field not found:', fieldName);
                        }
                    });
                }
            }
        })
    });
    // store faq
    $(document).on('click', '#store-faq', function (e) {
        e.preventDefault();
        let form = $('#faq-form');
        let data = new FormData(form[0]);
        let btn = $(this);
        let getUrl = form.attr('action');
        let modal = $('#create-faq');
        btn.prop('disabled', true);
        $.ajax({
            url: getUrl,
            type: 'post',
            processData: false,
            contentType: false,
            data: data,
            success: function (response) {
                if (response.status == "success") {

                    btn.prop('disabled', false);
                    form[0].reset();
                    modal.modal('hide');
                    toastr.success(response.message);
                    $("#faqs-table").DataTable().ajax.reload(null, false);
                }

            }, error: function (xhr) {
                btn.prop('disabled', false);

                if (xhr.status === 422) {
                    modal.modal('show');
                    $('.text-danger').remove(); // Clear all old error messages

                    let errors = xhr.responseJSON.errors;

                    $.each(errors, function (key, value) {
                        let fieldName;

                        // Convert dot notation to array format: address.en => address[en]
                        if (key.includes('.')) {
                            const parts = key.split('.');
                            fieldName = parts.shift() + '[' + parts.join('][') + ']';
                        } else {
                            fieldName = key;
                        }

                        // Select by name attribute
                        const inputField = $(`[name="${fieldName}"]`);

                        if (inputField.length > 0) {
                            inputField.next('.text-danger').remove();
                            inputField.after(`<p class="text-danger">${value[0]}</p>`);
                        } else {
                            console.warn('Field not found:', fieldName);
                        }
                    });
                }
            }
        });
    });
    // edit faq
    $(document).on('click', '.edit-faq-btn', function (e) {
        e.preventDefault();
        let getUrl = $(this).attr("href");
        $.ajax({
            url: getUrl,
            type: 'get',
            success: function (response) {
                if (response.status == "success") {
                    window.availableLanguages.forEach(lang => {
                        $("#edit-faq-form [name='question[" + lang + "]']").val(response.data.question?.[lang] ?? '');
                        $("#edit-faq-form [name='answear[" + lang + "]']").val(response.data.answear?.[lang] ?? '');
                    });

                    $("#edit-faq-form [name='status']").val(response.data.status).trigger('change');
                    let actionUrl = `faqs/${response.data.id}`;
                    $("#edit-faq-form").attr('action', actionUrl);
                }
            },
            error: function (xhr) {
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    toastr.error(xhr.responseJSON.message);
                } else {
                    toastr.error("An unexpected error occurred.");
                }
            }
        });
    });
    // update faq
    $(document).on('click', '#update-faq', function (e) {
        e.preventDefault();
        let form = $('#edit-faq-form');
        let getUrl = form.attr('action');
        let data = new FormData(form[0]);
        data.append('_method', 'PUT');
        let modal = $('#edit-faq');
        $.ajax({
            url: getUrl,
            type: 'post',
            data: data,
            processData: false,
            contentType: false,

            success: function (response) {
                if (response.status == "success") {
                    toastr.success(response.message);
                    $('#faqs-table').DataTable().ajax.reload(null, false);
                    modal.modal('hide');
                }
            },
            error: function (xhr) {


                if (xhr.status === 422) {
                    modal.modal('show');
                    $('.text-danger').remove(); // Clear all old error messages

                    let errors = xhr.responseJSON.errors;

                    $.each(errors, function (key, value) {
                        let fieldName;

                        // Convert dot notation to array format: address.en => address[en]
                        if (key.includes('.')) {
                            const parts = key.split('.');
                            fieldName = parts.shift() + '[' + parts.join('][') + ']';
                        } else {
                            fieldName = key;
                        }

                        // Select by name attribute
                        const inputField = $(`#edit-faq-form [name="${fieldName}"]`);

                        if (inputField.length > 0) {
                            inputField.next('.text-danger').remove();
                            inputField.after(`<p class="text-danger">${value[0]}</p>`);
                        } else {
                            console.warn('Field not found:', fieldName);
                        }
                    });
                }
            }
        })
    });
    // store about
    $(document).on('click', '#store-about', function (e) {
        e.preventDefault();
        let form = $('#about-form');
        let data = new FormData(form[0]);
        let btn = $(this);
        let getUrl = form.attr('action');
        let modal = $('#create-about');
        btn.prop('disabled', true);
        $.ajax({
            url: getUrl,
            type: 'post',
            processData: false,
            contentType: false,
            data: data,
            success: function (response) {
                if (response.status == "success") {

                    btn.prop('disabled', false);
                    form[0].reset();
                    modal.modal('hide');
                    toastr.success(response.message);
                    $("#aboutus-table").DataTable().ajax.reload(null, false);
                }

            }, error: function (xhr) {
                btn.prop('disabled', false);

                if (xhr.status === 422) {
                    modal.modal('show');
                    $('.text-danger').remove(); // Clear all old error messages

                    let errors = xhr.responseJSON.errors;

                    $.each(errors, function (key, value) {
                        let fieldName;

                        // Convert dot notation to array format: address.en => address[en]
                        if (key.includes('.')) {
                            const parts = key.split('.');
                            fieldName = parts.shift() + '[' + parts.join('][') + ']';
                        } else {
                            fieldName = key;
                        }

                        // Select by name attribute
                        const inputField = $(`[name="${fieldName}"]`);

                        if (inputField.length > 0) {
                            inputField.next('.text-danger').remove();
                            inputField.after(`<p class="text-danger">${value[0]}</p>`);
                        } else {
                            console.warn('Field not found:', fieldName);
                        }
                    });
                }
            }
        });
    });
    // edit about
    $(document).on('click', '.edit-about-btn', function (e) {
        e.preventDefault();
        let getUrl = $(this).attr("href");
        $.ajax({
            url: getUrl,
            type: 'get',
            success: function (response) {
                if (response.status == "success") {
                    window.availableLanguages.forEach(lang => {
                        $("#edit-about-form [name='title[" + lang + "]']").val(response.data.title?.[lang] ?? '');
                        $("#edit-about-form [name='description[" + lang + "]']").val(response.data.description?.[lang] ?? '');

                    });
                    $("#edit-about-form [name='type']").val(response.data.type);
                    let actionUrl = `about/${response.data.id}`;
                    $("#edit-about-form").attr('action', actionUrl);
                }
            },
            error: function (xhr) {
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    toastr.error(xhr.responseJSON.message);
                } else {
                    toastr.error("An unexpected error occurred.");
                }
            }
        });
    });
    // update about
    $(document).on('click', '#update-about', function (e) {
        e.preventDefault();
        let form = $('#edit-about-form');
        let getUrl = form.attr('action');
        let data = new FormData(form[0]);
        data.append('_method', 'PUT');
        let modal = $('#edit-about');
        $.ajax({
            url: getUrl,
            type: 'post',
            data: data,
            processData: false,
            contentType: false,

            success: function (response) {
                if (response.status == "success") {
                    toastr.success(response.message);
                    $('#aboutus-table').DataTable().ajax.reload(null, false);
                    modal.modal('hide');
                }
            },
            error: function (xhr) {


                if (xhr.status === 422) {
                    modal.modal('show');
                    $('.text-danger').remove(); // Clear all old error messages

                    let errors = xhr.responseJSON.errors;

                    $.each(errors, function (key, value) {
                        let fieldName;

                        // Convert dot notation to array format: address.en => address[en]
                        if (key.includes('.')) {
                            const parts = key.split('.');
                            fieldName = parts.shift() + '[' + parts.join('][') + ']';
                        } else {
                            fieldName = key;
                        }

                        // Select by name attribute
                        const inputField = $(`[name="${fieldName}"]`);

                        if (inputField.length > 0) {
                            inputField.next('.text-danger').remove();
                            inputField.after(`<p class="text-danger">${value[0]}</p>`);
                        } else {
                            console.warn('Field not found:', fieldName);
                        }
                    });
                }
            }
        })
    });
    // get category for product
    $(document).on('click', '#get-category', function (e) {
        e.preventDefault();
        let getUrl = $(this).data('get-category-url');

        $.ajax({
            url: getUrl,
            type: 'GET',
            success: function (response) {
                if (response.status === 'success') {
                    $('#parent-category-container').html(response.html);
                }
            },
            error: function () {
                alert('Failed to load category list.');
            }
        });
    })

    // store category
    $(document).on('click', '#store-category', function (e) {
        e.preventDefault();
        let btn = $(this);
        let modal = $("#create-category");
        window.availableLanguages.forEach(lang => {
            // Remove old editors if they exist
            const description = tinymce.get(`descripiton\\[${lang}\\]`);
            if (description) {
                description.remove();
            }
        });
        tinymce.triggerSave();
        let form = $("#create-category-form");
        let getUrl = form.attr('action');
        let data = new FormData(form[0]);
        btn.prop('disabled', true);
        $.ajax({
            url: getUrl,
            type: "post",
            processData: false,
            contentType: false,
            data: data,
            success: function (response) {
                if (response.status == "success") {
                    btn.prop('disabled', false);
                    form[0].reset();
                    modal.modal('hide');
                    toastr.success(response.message);
                    $("#categories-table").DataTable().ajax.reload(null, false);

                }
            },
            error: function (xhr) {
                btn.prop('disabled', false);

                if (xhr.status === 422) {
                    modal.modal('show');
                    $('.text-danger').remove(); // Clear all old error messages

                    let errors = xhr.responseJSON.errors;

                    $.each(errors, function (key, value) {
                        let fieldName;

                        // Convert dot notation to array format: address.en => address[en]
                        if (key.includes('.')) {
                            const parts = key.split('.');
                            fieldName = parts.shift() + '[' + parts.join('][') + ']';
                        } else {
                            fieldName = key;
                        }

                        // Select by name attribute
                        const inputField = $(`[name="${fieldName}"]`);

                        if (inputField.length > 0) {
                            inputField.next('.text-danger').remove();
                            inputField.after(`<p class="text-danger">${value[0]}</p>`);
                        } else {
                            console.warn('Field not found:', fieldName);
                        }
                    });
                }
            }
        });
    });
    // edit category
    $(document).on('click', '.edit-category-btn', function (e) {
        e.preventDefault();
        let getUrl = $(this).attr("href");
        $.ajax({
            url: getUrl,
            type: 'get',
            success: function (response) {
                if (response.status == "success") {
                    window.availableLanguages.forEach(function (lang) {
                        $("#edit-category-form  [name='name[" + lang + "]']").val(response.data.name[lang] ?? '');
                        // $("#edit-category-form  [name='description[" + lang + "]']").val(description[lang] ?? '');
                    });

                    $("#edit-category-form [name='status']").val(response.data.status).trigger('change');
                    $("#edit-category-form [name='fa_icon']").val(response.data.fa_icon);
                    $('#show-category-image').attr('src', response.data.image);
                    let form = $("#edit-category-form");
                    let parentCateCont = form.find("#parent-category-container");
                    parentCateCont.html(response.html);
                    let actionUrl = `categories/${response.data.id}`;
                    $("#edit-category-form").attr('action', actionUrl);
                    let selector = "#edit-description";
                    setTimeout(() => {
                        loadEditEditors(response, selector);
                    }, 400);

                }
            },
            error: function (xhr) {
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    toastr.error(xhr.responseJSON.message);
                } else {
                    toastr.error("An unexpected error occurred.");
                }
            }
        });
    });
    // update category

    $(document).on('click', '#update-category', function (e) {
        e.preventDefault();
        let form = $('#edit-category-form');
        let getUrl = form.attr('action');
        tinymce.triggerSave();
        let data = new FormData(form[0]);
        data.append('_method', 'PUT');
        let modal = $('#edit-category');
        $.ajax({
            url: getUrl,
            type: 'post',
            data: data,
            processData: false,
            contentType: false,

            success: function (response) {
                if (response.status == "success") {
                    toastr.success(response.message);
                    $('#categories-table').DataTable().ajax.reload(null, false);
                    modal.modal('hide');
                }
            },
            error: function (xhr) {


                if (xhr.status === 422) {
                    modal.modal('show');
                    $('.text-danger').remove(); // Clear all old error messages

                    let errors = xhr.responseJSON.errors;

                    $.each(errors, function (key, value) {
                        let fieldName;

                        // Convert dot notation to array format: address.en => address[en]
                        if (key.includes('.')) {
                            const parts = key.split('.');
                            fieldName = parts.shift() + '[' + parts.join('][') + ']';
                        } else {
                            fieldName = key;
                        }

                        // Select by name attribute
                        const inputField = $(`[name="${fieldName}"]`);

                        if (inputField.length > 0) {
                            inputField.next('.text-danger').remove();
                            inputField.after(`<p class="text-danger">${value[0]}</p>`);
                        } else {
                            console.warn('Field not found:', fieldName);
                        }
                    });
                }
            }
        })
    });
    // store method
    $(document).on('click', '#store-method', function (e) {
        e.preventDefault();
        let form = $('#method-form');
        let data = new FormData(form[0]);
        let btn = $(this);
        let getUrl = form.attr('action');
        let modal = $('#create-method');
        btn.prop('disabled', true);
        $.ajax({
            url: getUrl,
            type: 'post',
            processData: false,
            contentType: false,
            data: data,
            success: function (response) {
                if (response.status == "success") {

                    btn.prop('disabled', false);
                    form[0].reset();
                    modal.modal('hide');
                    toastr.success(response.message);
                    $("#methods-table").DataTable().ajax.reload(null, false);
                }

            }, error: function (xhr) {
                btn.prop('disabled', false);

                if (xhr.status === 422) {
                    modal.modal('show');
                    $('.text-danger').remove(); // Clear all old error messages

                    let errors = xhr.responseJSON.errors;

                    $.each(errors, function (key, value) {
                        let fieldName;

                        // Convert dot notation to array format: address.en => address[en]
                        if (key.includes('.')) {
                            const parts = key.split('.');
                            fieldName = parts.shift() + '[' + parts.join('][') + ']';
                        } else {
                            fieldName = key;
                        }

                        // Select by name attribute
                        const inputField = $(`[name="${fieldName}"]`);

                        if (inputField.length > 0) {
                            inputField.next('.text-danger').remove();
                            inputField.after(`<p class="text-danger">${value[0]}</p>`);
                        } else {
                            console.warn('Field not found:', fieldName);
                        }
                    });
                }
            }
        });
    });
    // Edit method
    $(document).on('click', '.edit-method-btn', function (e) {
        e.preventDefault();
        let getUrl = $(this).attr("href");
        $.ajax({
            url: getUrl,
            type: 'get',
            success: function (response) {
                if (response.status == "success") {
                    window.availableLanguages.forEach(lang => {
                        $("#edit-method-form [name='name[" + lang + "]']").val(response.data.name?.[lang] ?? '');

                    });
                    let actionUrl = `methods/${response.data.id}`;
                    $("#edit-method-form").attr('action', actionUrl);
                }
            },
            error: function (xhr) {
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    toastr.error(xhr.responseJSON.message);
                } else {
                    toastr.error("An unexpected error occurred.");
                }
            }
        });
    });
    // Update method
    $(document).on('click', '#update-method', function (e) {
        e.preventDefault();
        let form = $('#edit-method-form');
        let getUrl = form.attr('action');
        let data = new FormData(form[0]);
        data.append('_method', 'PUT');
        let modal = $('#edit-method');
        $.ajax({
            url: getUrl,
            type: 'post',
            data: data,
            processData: false,
            contentType: false,
            success: function (response) {
                if (response.status == "success") {
                    toastr.success(response.message);
                    $('#methods-table').DataTable().ajax.reload(null, false);
                    modal.modal('hide');
                }
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    modal.modal('show');
                    $('.text-danger').remove(); // Clear all old error messages

                    let errors = xhr.responseJSON.errors;

                    $.each(errors, function (key, value) {
                        let fieldName;

                        // Convert dot notation to array format: address.en => address[en]
                        if (key.includes('.')) {
                            const parts = key.split('.');
                            fieldName = parts.shift() + '[' + parts.join('][') + ']';
                        } else {
                            fieldName = key;
                        }

                        // Select by name attribute
                        const inputField = $(`[name="${fieldName}"]`);

                        if (inputField.length > 0) {
                            inputField.next('.text-danger').remove();
                            inputField.after(`<p class="text-danger">${value[0]}</p>`);
                        } else {
                            console.warn('Field not found:', fieldName);
                        }
                    });
                }
            }
        })
    });
    // store machine
    $(document).on('click', '#store-machine', function (e) {
        e.preventDefault();
        let form = $('#machine-form');
        let data = new FormData(form[0]);
        let btn = $(this);
        let getUrl = form.attr('action');
        let modal = $('#create-machine');
        btn.prop('disabled', true);
        $.ajax({
            url: getUrl,
            type: 'post',
            processData: false,
            contentType: false,
            data: data,
            success: function (response) {
                if (response.status == "success") {

                    btn.prop('disabled', false);
                    form[0].reset();
                    modal.modal('hide');
                    toastr.success(response.message);
                    $("#machines-table").DataTable().ajax.reload(null, false);
                }

            }, error: function (xhr) {
                btn.prop('disabled', false);

                if (xhr.status === 422) {
                    modal.modal('show');
                    $('.text-danger').remove(); // Clear all old error messages

                    let errors = xhr.responseJSON.errors;

                    $.each(errors, function (key, value) {
                        let fieldName;

                        // Convert dot notation to array format: address.en => address[en]
                        if (key.includes('.')) {
                            const parts = key.split('.');
                            fieldName = parts.shift() + '[' + parts.join('][') + ']';
                        } else {
                            fieldName = key;
                        }

                        // Select by name attribute
                        const inputField = $(`[name="${fieldName}"]`);

                        if (inputField.length > 0) {
                            inputField.next('.text-danger').remove();
                            inputField.after(`<p class="text-danger">${value[0]}</p>`);
                        } else {
                            console.warn('Field not found:', fieldName);
                        }
                    });
                }
            }
        });
    });
    // edit machine
    $(document).on('click', '.edit-machine-btn', function (e) {
        e.preventDefault();
        let getUrl = $(this).attr("href");
        $.ajax({
            url: getUrl,
            type: 'get',
            success: function (response) {
                if (response.status == "success") {
                    window.availableLanguages.forEach(lang => {
                        $("#edit-machine-form [name='name[" + lang + "]']").val(response.data.name?.[lang] ?? '');
                        $("#edit-machine-form [name='description[" + lang + "]']").val(response.data.description?.[lang] ?? '');
                    });
                    let select = $("#edit-machine-form [name='method_id']");
                    select.empty();
                    response.methods.forEach($method => {
                        let selected = $method.id == response.data.method_id ? 'selected' : '';
                        select.append(`<option value="${$method.id}" ${selected}>${$method.name.en}</option>`);
                    });
                    $("#edit-machine-form [name='status']").val(response.data.status).trigger('change');
                    $("#edit-machine-form [name='model']").val(response.data.model);
                    let actionUrl = `machines/${response.data.id}`;
                    $("#edit-machine-form").attr('action', actionUrl);
                }
            },
            error: function (xhr) {
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    toastr.error(xhr.responseJSON.message);
                } else {
                    toastr.error("An unexpected error occurred.");
                }
            }
        });
    });
    // Update machine
    $(document).on('click', '#update-machine', function (e) {
        e.preventDefault();
        let form = $('#edit-machine-form');
        let getUrl = form.attr('action');
        let data = new FormData(form[0]);
        data.append('_method', 'PUT');
        let modal = $('#edit-machine');
        $.ajax({
            url: getUrl,
            type: 'post',
            data: data,
            processData: false,
            contentType: false,

            success: function (response) {
                if (response.status == "success") {
                    toastr.success(response.message);
                    $('#machines-table').DataTable().ajax.reload(null, false);
                    modal.modal('hide');
                }
            },
            error: function (xhr) {


                if (xhr.status === 422) {
                    modal.modal('show');
                    $('.text-danger').remove(); // Clear all old error messages

                    let errors = xhr.responseJSON.errors;

                    $.each(errors, function (key, value) {
                        let fieldName;

                        // Convert dot notation to array format: address.en => address[en]
                        if (key.includes('.')) {
                            const parts = key.split('.');
                            fieldName = parts.shift() + '[' + parts.join('][') + ']';
                        } else {
                            fieldName = key;
                        }

                        // Select by name attribute
                        const inputField = $(`[name="${fieldName}"]`);

                        if (inputField.length > 0) {
                            inputField.next('.text-danger').remove();
                            inputField.after(`<p class="text-danger">${value[0]}</p>`);
                        } else {
                            console.warn('Field not found:', fieldName);
                        }
                    });
                }
            }
        })
    });
    // Store machine Image
    $(document).on('click', '#store-machine-image', function (e) {


        e.preventDefault();
        let btn = $(this);
        let modal = $("#create-machine-image");
        let form = $("#create-machine-image-form");
        let getUrl = form.attr('action');
        let data = new FormData(form[0]);
        btn.prop('disabled', true);
        $.ajax({
            url: getUrl,
            type: "post",
            processData: false,
            contentType: false,
            data: data,
            success: function (response) {
                if (response.status == "success") {
                    btn.prop('disabled', false);
                    form[0].reset();
                    modal.modal('hide');
                    toastr.success(response.message);
                    window.location.reload();

                }
            },
            error: function (xhr) {
                btn.prop('disabled', false);
                if (xhr.status == 422) {
                    modal.modal('show');

                    let errors = xhr.responseJSON.errors;
                    form.find('.text-danger').remove();

                    $.each(errors, function (key, value) {
                        // Normalize keys like 'image.0' to 'image'

                        let normalizedKey = key.replace(/\.\d+$/, '');

                        let inputField = $("#" + normalizedKey);

                        // Fallback: try name selector in case ID is missing
                        if (inputField.length === 0) {
                            inputField = $('[name="' + normalizedKey + '[]"]');
                        }
                        inputField.next('.text-danger').remove();
                        inputField.after('<p class="text-danger">' + value[0] + '</p>');
                    });
                }
            }

        });
    });
    // delete machine image
    $(document).on('click', '#machine-image-delete', function (e) {
        e.preventDefault();
        let getHref = $(this).attr('href');
        let imageId = $(this).data('image-id');
        $.ajax({
            url: getHref,
            type: 'delete',
            success: function (response) {
                if (response.status == "success") {
                    $('#image-' + imageId).remove();
                    toastr.success(response.message);
                }
            },
            error: function (xhr) {
                toastr.error("Some Issue");
            }
        });
    });
    // store test
    $(document).on('click', '#store-test', function (e) {
        e.preventDefault();
        window.availableLanguages.forEach(lang => {
            // Remove old editors if they exist
            const editorDescription = tinymce.get(`descritpion[${lang}]`);
            if (editorDescription) {
                editorDescription.remove();
            }
            setTimeout(() => {
                initTinyMCE(`#description\\[${lang}\\]`);
            }, 200);
        });
        tinymce.triggerSave();
        let form = $('#test-form');
        let data = new FormData(form[0]);
        data.forEach((value, key) => {
            console.log(key, value);

        });
        let btn = $(this);
        let getUrl = form.attr('action');
        let modal = $('#create-test');
        btn.prop('disabled', true);
        $.ajax({
            url: getUrl,
            type: 'post',
            processData: false,
            contentType: false,
            data: data,
            success: function (response) {
                if (response.status == "success") {
                    btn.prop('disabled', false);
                    form[0].reset();
                    modal.modal('hide');
                    toastr.success(response.message);
                    $("#tests-table").DataTable().ajax.reload(null, false);
                }

            }, error: function (xhr) {
                btn.prop('disabled', false);

                if (xhr.status === 422) {
                    modal.modal('show');
                    $('.text-danger').remove(); // Clear all old error messages

                    let errors = xhr.responseJSON.errors;

                    $.each(errors, function (key, value) {
                        let fieldName;
                        // Convert dot notation to array format: address.en => address[en]
                        if (key.includes('.')) {
                            const parts = key.split('.');
                            fieldName = parts.shift() + '[' + parts.join('][') + ']';
                        } else {
                            fieldName = key;
                        }

                        // Select by name attribute
                        const inputField = $(`[name="${fieldName}"]`);

                        if (inputField.length > 0) {
                            inputField.next('.text-danger').remove();
                            inputField.after(`<p class="text-danger">${value[0]}</p>`);
                        } else {
                            console.warn('Field not found:', fieldName);
                        }
                    });
                }
            }
        });
    });
    // get product cateogry
    $(document).on('click', '#get-product-category', function (e) {
        e.preventDefault();
        let getHref = $(this).data('href');
        $.ajax({
            url: getHref,
            typ: 'get',
            success: function (response) {
                if (response.status == "success") {
                    $('.product-category').html(response.html);
                }
            },
            error: function () {
                alert("Error");

            }
        })
    });
    // edit test
    $(document).on('click', '.edit-test-btn', function (e) {
        e.preventDefault();
        let getUrl = $(this).attr("href");
        $.ajax({
            url: getUrl,
            type: 'GET',
            success: function (response) {
                if (response.status === "success") {

                    window.availableLanguages.forEach(lang => {
                        $("#edit-test-form [name='name[" + lang + "]']").val(response.data.name?.[lang] ?? '');
                    });
                    $("#edit-test-form [name='status']").val(response.data.status).trigger('change');
                    $("#edit-test-form [name='refrence']").val(response.data.refrence);
                    $("#edit-test-form [name='unite']").val(response.data.unite);
                    $("#edit-test-form").attr('action', `tests/${response.data.id}`);
                    $('.edit-product-category').html(response.html);

                    // window.availableLanguages.forEach(lang => {
                    //     const editor = tinymce.get(`edit-description[${lang}]`);
                    //     if (editor) {
                    //         editor.remove();
                    //     }
                    //     setTimeout(() => {
                    //         const content = response.data.description?.[lang] || '';
                    //         initTinyMCE(`#edit-description\\[${lang}\\]`, content);
                    //     }, 400);

                    // });
                    let selector = "#edit-description";
                    setTimeout(() => {
                        loadEditEditors(response, selector);
                    }, 400);
                }
            },
            error: function (xhr) {
                toastr.error(xhr.responseJSON?.message || 'Something went wrong!');
            }
        });
    });
    // update test
    $(document).on('click', '#update-test', function (e) {
        e.preventDefault();
        let form = $('#edit-test-form');
        let getUrl = form.attr('action');
        tinymce.triggerSave();
        let data = new FormData(form[0]);
        data.append('_method', 'PUT');
        let modal = $('#edit-test');
        $.ajax({
            url: getUrl,
            type: 'post',
            data: data,
            processData: false,
            contentType: false,

            success: function (response) {
                if (response.status == "success") {
                    toastr.success(response.message);
                    $('#tests-table').DataTable().ajax.reload(null, false);
                    modal.modal('hide');
                }
            },
            error: function (xhr) {


                if (xhr.status === 422) {
                    modal.modal('show');
                    $('.text-danger').remove(); // Clear all old error messages

                    let errors = xhr.responseJSON.errors;

                    $.each(errors, function (key, value) {
                        let fieldName;

                        // Convert dot notation to array format: address.en => address[en]
                        if (key.includes('.')) {
                            const parts = key.split('.');
                            fieldName = parts.shift() + '[' + parts.join('][') + ']';
                        } else {
                            fieldName = key;
                        }

                        // Select by name attribute
                        const inputField = $(`[name="${fieldName}"]`);

                        if (inputField.length > 0) {
                            inputField.next('.text-danger').remove();
                            inputField.after(`<p class="text-danger">${value[0]}</p>`);
                        } else {
                            console.warn('Field not found:', fieldName);
                        }
                    });
                }
            }
        })
    });
    // store test image
    $(document).on('click', '#store-test-image', function (e) {
        e.preventDefault();
        let btn = $(this);
        let modal = $("#create-test-image");
        let form = $("#create-test-image-form");
        let getUrl = form.attr('action');
        let data = new FormData(form[0]);
        btn.prop('disabled', true);
        $.ajax({
            url: getUrl,
            type: "post",
            processData: false,
            contentType: false,
            data: data,
            success: function (response) {
                if (response.status == "success") {
                    btn.prop('disabled', false);
                    form[0].reset();
                    modal.modal('hide');
                    toastr.success(response.message);
                    window.location.reload();

                }
            },
            error: function (xhr) {
                btn.prop('disabled', false);
                if (xhr.status == 422) {
                    modal.modal('show');

                    let errors = xhr.responseJSON.errors;
                    form.find('.text-danger').remove();

                    $.each(errors, function (key, value) {
                        // Normalize keys like 'image.0' to 'image'

                        let normalizedKey = key.replace(/\.\d+$/, '');

                        let inputField = $("#" + normalizedKey);

                        // Fallback: try name selector in case ID is missing
                        if (inputField.length === 0) {
                            inputField = $('[name="' + normalizedKey + '[]"]');
                        }
                        inputField.next('.text-danger').remove();
                        inputField.after('<p class="text-danger">' + value[0] + '</p>');
                    });
                }
            }

        });
    });
    // Store slider
    $(document).on('click', '#store-slider', function (e) {
        e.preventDefault();
        let form = $('#slider-form');
        let data = new FormData(form[0]);
        let btn = $(this);
        let getUrl = form.attr('action');
        let modal = $('#create-slider');
        btn.prop('disabled', true);
        $.ajax({
            url: getUrl,
            type: 'post',
            processData: false,
            contentType: false,
            data: data,
            success: function (response) {
                if (response.status == "success") {

                    btn.prop('disabled', false);
                    form[0].reset();
                    modal.modal('hide');
                    toastr.success(response.message);
                    $("#sliders-table").DataTable().ajax.reload(null, false);
                }

            }, error: function (xhr) {
                btn.prop('disabled', false);

                if (xhr.status === 422) {
                    modal.modal('show');
                    $('.text-danger').remove(); // Clear all old error messages

                    let errors = xhr.responseJSON.errors;

                    $.each(errors, function (key, value) {
                        let fieldName;

                        // Convert dot notation to array format: address.en => address[en]
                        if (key.includes('.')) {
                            const parts = key.split('.');
                            fieldName = parts.shift() + '[' + parts.join('][') + ']';
                        } else {
                            fieldName = key;
                        }

                        // Select by name attribute
                        const inputField = $(`[name="${fieldName}"]`);

                        if (inputField.length > 0) {
                            inputField.next('.text-danger').remove();
                            inputField.after(`<p class="text-danger">${value[0]}</p>`);
                        } else {
                            console.warn('Field not found:', fieldName);
                        }
                    });
                }
            }
        });
    });
    // Edit slider
    $(document).on('click', '.edit-slider-btn', function (e) {
        e.preventDefault();
        let getUrl = $(this).attr("href");
        $.ajax({
            url: getUrl,
            type: 'get',
            success: function (response) {
                if (response.status == "success") {
                    window.availableLanguages.forEach(lang => {
                        $("#edit-slider-form [name='description[" + lang + "]']").val(response.data.description?.[lang] ?? '');
                        $("#edit-slider-form [name='title[" + lang + "]']").val(response.data.title?.[lang] ?? '');
                    });
                    $("#edit-slider-form [name='status']").val(response.data.status).trigger('change');
                    $("#show-slider").attr('src', response.data.image);
                    let actionUrl = `sliders/${response.data.id}`;
                    $("#edit-slider-form").attr('action', actionUrl);
                }
            },
            error: function (xhr) {
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    toastr.error(xhr.responseJSON.message);
                } else {
                    toastr.error("An unexpected error occurred.");
                }
            }
        });
    });
    // update slider
    $(document).on('click', '#update-slider', function (e) {
        e.preventDefault();
        let form = $('#edit-slider-form');
        let getUrl = form.attr('action');
        let data = new FormData(form[0]);
        data.append('_method', 'PUT');
        let modal = $('#edit-slider');
        $.ajax({
            url: getUrl,
            type: 'post',
            data: data,
            processData: false,
            contentType: false,

            success: function (response) {
                if (response.status == "success") {
                    toastr.success(response.message);
                    $('#sliders-table').DataTable().ajax.reload(null, false);
                    modal.modal('hide');
                }
            },
            error: function (xhr) {


                if (xhr.status === 422) {
                    modal.modal('show');
                    $('.text-danger').remove(); // Clear all old error messages

                    let errors = xhr.responseJSON.errors;

                    $.each(errors, function (key, value) {
                        let fieldName;

                        // Convert dot notation to array format: address.en => address[en]
                        if (key.includes('.')) {
                            const parts = key.split('.');
                            fieldName = parts.shift() + '[' + parts.join('][') + ']';
                        } else {
                            fieldName = key;
                        }

                        // Select by name attribute
                        const inputField = $(`[name="${fieldName}"]`);

                        if (inputField.length > 0) {
                            inputField.next('.text-danger').remove();
                            inputField.after(`<p class="text-danger">${value[0]}</p>`);
                        } else {
                            console.warn('Field not found:', fieldName);
                        }
                    });
                }
            }
        })
    });
    // store keyvalue
    $(document).on('click', '#store-keyValue', function (e) {
        e.preventDefault();
        let form = $('#keyValue-form');
        let data = new FormData(form[0]);
        let btn = $(this);
        let getUrl = form.attr('action');
        let modal = $('#create-keyValue');
        btn.prop('disabled', true);
        $.ajax({
            url: getUrl,
            type: 'post',
            processData: false,
            contentType: false,
            data: data,
            success: function (response) {
                if (response.status == "success") {

                    btn.prop('disabled', false);
                    form[0].reset();
                    modal.modal('hide');
                    toastr.success(response.message);
                    $("#keyvalues-table").DataTable().ajax.reload(null, false);
                }

            }, error: function (xhr) {
                btn.prop('disabled', false);

                if (xhr.status === 422) {
                    modal.modal('show');
                    $('.text-danger').remove(); // Clear all old error messages

                    let errors = xhr.responseJSON.errors;

                    $.each(errors, function (key, value) {
                        let fieldName;

                        // Convert dot notation to array format: address.en => address[en]
                        if (key.includes('.')) {
                            const parts = key.split('.');
                            fieldName = parts.shift() + '[' + parts.join('][') + ']';
                        } else {
                            fieldName = key;
                        }

                        // Select by name attribute
                        const inputField = $(`[name="${fieldName}"]`);

                        if (inputField.length > 0) {
                            inputField.next('.text-danger').remove();
                            inputField.after(`<p class="text-danger">${value[0]}</p>`);
                        } else {
                            console.warn('Field not found:', fieldName);
                        }
                    });
                }
            }
        });
    });
    // update keyValue
    $(document).on('click', '.edit-keyValue-btn', function (e) {
        e.preventDefault();
        let getUrl = $(this).attr("href");
        $.ajax({
            url: getUrl,
            type: 'get',
            success: function (response) {
                if (response.status == "success") {
                    window.availableLanguages.forEach(lang => {
                        $("#edit-keyValue-form [name='description[" + lang + "]']").val(response.data.description?.[lang] ?? '');
                        $("#edit-keyValue-form [name='title[" + lang + "]']").val(response.data.title?.[lang] ?? '');
                    });
                    $("#show-keyValue").attr('src', response.data.image);
                    let actionUrl = `key-values/${response.data.id}`;
                    $("#edit-keyValue-form").attr('action', actionUrl);
                }
            },
            error: function (xhr) {
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    toastr.error(xhr.responseJSON.message);
                } else {
                    toastr.error("An unexpected error occurred.");
                }
            }
        });
    });
    // update keyValue
    $(document).on('click', '#update-keyValue', function (e) {
        e.preventDefault();
        let form = $('#edit-keyValue-form');
        let getUrl = form.attr('action');
        let data = new FormData(form[0]);
        data.append('_method', 'PUT');
        let modal = $('#edit-keyValue');
        $.ajax({
            url: getUrl,
            type: 'post',
            data: data,
            processData: false,
            contentType: false,

            success: function (response) {
                if (response.status == "success") {
                    toastr.success(response.message);
                    $('#keyvalues-table').DataTable().ajax.reload(null, false);
                    modal.modal('hide');
                }
            },
            error: function (xhr) {


                if (xhr.status === 422) {
                    modal.modal('show');
                    $('.text-danger').remove(); // Clear all old error messages

                    let errors = xhr.responseJSON.errors;

                    $.each(errors, function (key, value) {
                        let fieldName;

                        // Convert dot notation to array format: address.en => address[en]
                        if (key.includes('.')) {
                            const parts = key.split('.');
                            fieldName = parts.shift() + '[' + parts.join('][') + ']';
                        } else {
                            fieldName = key;
                        }

                        // Select by name attribute
                        const inputField = $(`[name="${fieldName}"]`);

                        if (inputField.length > 0) {
                            inputField.next('.text-danger').remove();
                            inputField.after(`<p class="text-danger">${value[0]}</p>`);
                        } else {
                            console.warn('Field not found:', fieldName);
                        }
                    });
                }
            }
        })
    });
    // store testimonail
    $(document).on('click', '#store-testimonail', function (e) {
        e.preventDefault();
        let form = $('#testimonail-form');
        let data = new FormData(form[0]);
        let btn = $(this);
        let getUrl = form.attr('action');
        let modal = $('#create-testimonail');
        btn.prop('disabled', true);
        $.ajax({
            url: getUrl,
            type: 'post',
            processData: false,
            contentType: false,
            data: data,
            success: function (response) {
                if (response.status == "success") {

                    btn.prop('disabled', false);
                    form[0].reset();
                    modal.modal('hide');
                    toastr.success(response.message);
                    $("#testimonails-table").DataTable().ajax.reload(null, false);
                }

            }, error: function (xhr) {
                btn.prop('disabled', false);

                if (xhr.status === 422) {
                    modal.modal('show');
                    $('.text-danger').remove(); // Clear all old error messages

                    let errors = xhr.responseJSON.errors;

                    $.each(errors, function (key, value) {
                        let fieldName;

                        // Convert dot notation to array format: address.en => address[en]
                        if (key.includes('.')) {
                            const parts = key.split('.');
                            fieldName = parts.shift() + '[' + parts.join('][') + ']';
                        } else {
                            fieldName = key;
                        }

                        // Select by name attribute
                        const inputField = $(`[name="${fieldName}"]`);

                        if (inputField.length > 0) {
                            inputField.next('.text-danger').remove();
                            inputField.after(`<p class="text-danger">${value[0]}</p>`);
                        } else {
                            console.warn('Field not found:', fieldName);
                        }
                    });
                }
            }
        });
    });
    // edit testimonail
    $(document).on('click', '.edit-testimonail-btn', function (e) {
        e.preventDefault();
        let getUrl = $(this).attr("href");
        $.ajax({
            url: getUrl,
            type: 'get',
            success: function (response) {
                if (response.status == "success") {
                    window.availableLanguages.forEach(lang => {
                        $("#edit-testimonail-form [name='description[" + lang + "]']").val(response.data.description?.[lang] ?? '');
                        $("#edit-testimonail-form [name='name[" + lang + "]']").val(response.data.name?.[lang] ?? '');
                        $("#edit-testimonail-form [name='position[" + lang + "]']").val(response.data.position?.[lang] ?? '');
                    });
                    $("#edit-testimonail-form [name='status']").val(response.data.status).trigger('change');
                    $("#edit-testimonail-form [name='rate']").val(response.data.rate).trigger('change');
                    $("#show-testimonail").attr('src', response.data.image);
                    let actionUrl = `testimonails/${response.data.id}`;
                    $("#edit-testimonail-form").attr('action', actionUrl);
                }
            },
            error: function (xhr) {
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    toastr.error(xhr.responseJSON.message);
                } else {
                    toastr.error("An unexpected error occurred.");
                }
            }
        });
    });
    // update testimonail
    $(document).on('click', '#update-testimonail', function (e) {
        e.preventDefault();
        let form = $('#edit-testimonail-form');
        let getUrl = form.attr('action');
        let data = new FormData(form[0]);
        data.append('_method', 'PUT');
        let modal = $('#edit-testimonail');
        $.ajax({
            url: getUrl,
            type: 'post',
            data: data,
            processData: false,
            contentType: false,

            success: function (response) {
                if (response.status == "success") {
                    toastr.success(response.message);
                    $('#testimonails-table').DataTable().ajax.reload(null, false);
                    modal.modal('hide');
                }
            },
            error: function (xhr) {


                if (xhr.status === 422) {
                    modal.modal('show');
                    $('.text-danger').remove(); // Clear all old error messages

                    let errors = xhr.responseJSON.errors;

                    $.each(errors, function (key, value) {
                        let fieldName;

                        // Convert dot notation to array format: address.en => address[en]
                        if (key.includes('.')) {
                            const parts = key.split('.');
                            fieldName = parts.shift() + '[' + parts.join('][') + ']';
                        } else {
                            fieldName = key;
                        }

                        // Select by name attribute
                        const inputField = $(`[name="${fieldName}"]`);

                        if (inputField.length > 0) {
                            inputField.next('.text-danger').remove();
                            inputField.after(`<p class="text-danger">${value[0]}</p>`);
                        } else {
                            console.warn('Field not found:', fieldName);
                        }
                    });
                }
            }
        })
    });
    // store slider image
    $(document).on('click', '#store-slider-image', function (e) {
        e.preventDefault();
        let form = $('#slider-image-form');
        let data = new FormData(form[0]);
        let btn = $(this);
        let getUrl = form.attr('action');
        let modal = $('#create-slider-image');
        btn.prop('disabled', true);
        $.ajax({
            url: getUrl,
            type: 'post',
            processData: false,
            contentType: false,
            data: data,
            success: function (response) {
                if (response.status == "success") {

                    btn.prop('disabled', false);
                    form[0].reset();
                    modal.modal('hide');
                    toastr.success(response.message);
                    window.location.reload();
                }

            }, error: function (xhr) {
                btn.prop('disabled', false);

                if (xhr.status === 422) {
                    modal.modal('show');
                    $('.text-danger').remove(); // Clear all old error messages

                    let errors = xhr.responseJSON.errors;

                    $.each(errors, function (key, value) {
                        let fieldName;

                        if (key.includes('.')) {
                            const parts = key.split('.');
                            fieldName = parts.shift() + '[' + parts.join('][') + ']';
                        } else {
                            fieldName = key;
                        }

                        // ✅ Fix for image[]
                        if (fieldName === 'image') {
                            fieldName = 'image[]';
                        }

                        const inputField = $(`[name="${fieldName}"]`);

                        if (inputField.length > 0) {
                            inputField.next('.text-danger').remove();
                            inputField.after(`<p class="text-danger">${value[0]}</p>`);
                        } else {
                            console.warn('Field not found:', fieldName);
                        }
                    });
                }
            }
        });
    });
    // Store photo
    $(document).on('click', '#store-photo', function (e) {
        e.preventDefault();
        let form = $('#photo-form');
        let data = new FormData(form[0]);
        let btn = $(this);
        let getUrl = form.attr('action');
        let modal = $('#create-photo');
        btn.prop('disabled', true);
        $.ajax({
            url: getUrl,
            type: 'post',
            processData: false,
            contentType: false,
            data: data,
            success: function (response) {
                if (response.status == "success") {

                    btn.prop('disabled', false);
                    form[0].reset();
                    modal.modal('hide');
                    toastr.success(response.message);
                    window.location.reload();
                }

            }, error: function (xhr) {
                btn.prop('disabled', false);

                if (xhr.status === 422) {
                    modal.modal('show');
                    $('.text-danger').remove(); // Clear all old error messages

                    let errors = xhr.responseJSON.errors;

                    $.each(errors, function (key, value) {
                        let fieldName;

                        if (key.includes('.')) {
                            const parts = key.split('.');
                            fieldName = parts.shift() + '[' + parts.join('][') + ']';
                        } else {
                            fieldName = key;
                        }

                        // ✅ Fix for image[]
                        if (fieldName === 'image') {
                            fieldName = 'image[]';
                        }

                        const inputField = $(`[name="${fieldName}"]`);

                        if (inputField.length > 0) {
                            inputField.next('.text-danger').remove();
                            inputField.after(`<p class="text-danger">${value[0]}</p>`);
                        } else {
                            console.warn('Field not found:', fieldName);
                        }
                    });

                }
            }
        });
    });
    // store province
    $(document).on('click', '#store-province', function (e) {
        e.preventDefault();
        let form = $('#province-form');
        let data = new FormData(form[0]);
        let btn = $(this);
        let getUrl = form.attr('action');
        let modal = $('#create-province');
        btn.prop('disabled', true);
        $.ajax({
            url: getUrl,
            type: 'post',
            processData: false,
            contentType: false,
            data: data,
            success: function (response) {
                if (response.status == "success") {

                    btn.prop('disabled', false);
                    form[0].reset();
                    modal.modal('hide');
                    toastr.success(response.message);
                    $("#provinces-table").DataTable().ajax.reload(null, false);
                }

            }, error: function (xhr) {
                btn.prop('disabled', false);

                if (xhr.status === 422) {
                    modal.modal('show');
                    $('.text-danger').remove(); // Clear all old error messages

                    let errors = xhr.responseJSON.errors;

                    $.each(errors, function (key, value) {
                        let fieldName;

                        // Convert dot notation to array format: address.en => address[en]
                        if (key.includes('.')) {
                            const parts = key.split('.');
                            fieldName = parts.shift() + '[' + parts.join('][') + ']';
                        } else {
                            fieldName = key;
                        }

                        // Select by name attribute
                        const inputField = $(`[name="${fieldName}"]`);

                        if (inputField.length > 0) {
                            inputField.next('.text-danger').remove();
                            inputField.after(`<p class="text-danger">${value[0]}</p>`);
                        } else {
                            console.warn('Field not found:', fieldName);
                        }
                    });
                }
            }
        });
    });
    // edit province
    $(document).on('click', '.edit-province-btn', function (e) {
        e.preventDefault();
        let getUrl = $(this).attr("href");
        $.ajax({
            url: getUrl,
            type: 'get',
            success: function (response) {
                if (response.status == "success") {
                    window.availableLanguages.forEach(lang => {
                        $("#edit-province-form [name='province[" + lang + "]']").val(response.data.province?.[lang] ?? '');
                    });
                    let actionUrl = `provinces/${response.data.id}`;
                    $("#edit-province-form").attr('action', actionUrl);
                }
            },
            error: function (xhr) {
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    toastr.error(xhr.responseJSON.message);
                } else {
                    toastr.error("An unexpected error occurred.");
                }
            }
        });
    });


    // update province
    $(document).on('click', '#update-province', function (e) {
        e.preventDefault();
        let form = $('#edit-province-form');
        let getUrl = form.attr('action');
        let data = new FormData(form[0]);
        data.append('_method', 'PUT');
        let modal = $('#edit-province');
        $.ajax({
            url: getUrl,
            type: 'post',
            data: data,
            processData: false,
            contentType: false,

            success: function (response) {
                if (response.status == "success") {
                    toastr.success(response.message);
                    $('#provinces-table').DataTable().ajax.reload(null, false);
                    modal.modal('hide');
                }
            },
            error: function (xhr) {


                if (xhr.status === 422) {
                    modal.modal('show');
                    $('.text-danger').remove(); // Clear all old error messages

                    let errors = xhr.responseJSON.errors;

                    $.each(errors, function (key, value) {
                        let fieldName;

                        // Convert dot notation to array format: address.en => address[en]
                        if (key.includes('.')) {
                            const parts = key.split('.');
                            fieldName = parts.shift() + '[' + parts.join('][') + ']';
                        } else {
                            fieldName = key;
                        }

                        // Select by name attribute
                        const inputField = $(`[name="${fieldName}"]`);

                        if (inputField.length > 0) {
                            inputField.next('.text-danger').remove();
                            inputField.after(`<p class="text-danger">${value[0]}</p>`);
                        } else {
                            console.warn('Field not found:', fieldName);
                        }
                    });
                }
            }
        })
    });

    // Store about image
    $(document).on('click', '#store-about-image', function (e) {
        e.preventDefault();
        let form = $('#about-image-form');
        let data = new FormData(form[0]);
        let btn = $(this);
        let getUrl = form.attr('action');
        let modal = $('#create-about-image');
        btn.prop('disabled', true);
        $.ajax({
            url: getUrl,
            type: 'post',
            processData: false,
            contentType: false,
            data: data,
            success: function (response) {
                if (response.status == "success") {

                    btn.prop('disabled', false);
                    form[0].reset();
                    modal.modal('hide');
                    toastr.success(response.message);
                    window.location.reload();
                }

            }, error: function (xhr) {
                btn.prop('disabled', false);

                if (xhr.status === 422) {
                    modal.modal('show');
                    $('.text-danger').remove(); // Clear all old error messages

                    let errors = xhr.responseJSON.errors;

                    $.each(errors, function (key, value) {
                        let fieldName;

                        // Convert dot notation to array format: address.en => address[en]
                        if (key.includes('.')) {
                            const parts = key.split('.');
                            fieldName = parts.shift() + '[' + parts.join('][') + ']';
                        } else {
                            fieldName = key;
                        }

                        if (fieldName === 'image' || fieldName.startsWith('image[')) {
                            fieldName = 'image[]';
                        }




                        // Select by name attribute
                        const inputField = $(`[name="${fieldName}"]`);

                        if (inputField.length > 0) {
                            inputField.next('.text-danger').remove();
                            inputField.after(`<p class="text-danger">${value[0]}</p>`);
                        } else {
                            console.warn('Field not found:', fieldName);
                        }
                    });
                }
            }
        });
    });



































    // initializeSelect2 globaly
    function initializeSelect2(container = document) {
        const $selects = $(container).find('.select2');

        $selects.each(function () {
            if ($(this).hasClass("select2-hidden-accessible")) {
                $(this).select2('destroy');
            }

            $(this).select2({
                width: '100%',
                dropdownParent: $(container),
                placeholder: 'Select an option',
                allowClear: true
            });
        });
    }




});

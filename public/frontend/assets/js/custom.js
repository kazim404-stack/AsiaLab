$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).on('submit', '#contact-form', function (e) {
        e.preventDefault();
        let btn = $("#contact-send-btn");
        let form = $(this);
        let getUrl = form.attr('action');
        let data = form.serialize();
        btn.prop('disabled', true);
        $("#contact-btn-text").hide();
        $("#contact-ajax-loading-btn").removeClass('d-none');
        $.ajax({
            url: getUrl,
            type: 'POST',
            data: data,
            success: function (response) {
                if (response.status == "success") {
                    btn.prop('disabled', false);
                    form[0].reset();
                    toastr.success(response.message)
                    $("#contact-btn-text").show();
                    $("#contact-ajax-loading-btn").addClass('d-none');
                }
            },
            error: function (xhr) {
                btn.prop('disabled', false);
                if (xhr.status == 422) {
                    $("#contact-ajax-loading-btn").addClass('d-none');
                    $("#contact-btn-text").show();

                    let errors = xhr.responseJSON.errors;
                    $.each(errors, function (key, value) {
                        let inputField = $("#" + key);
                        inputField.next('.text-danger').remove();
                        $("#" + key).after('<p class="text-danger">' + value[0] + '</p>');
                    });

                }

            }
        });
    });
    // add and remove col from category dropdown
    function updateCategoryCols() {
        const cols = document.querySelectorAll('.category-col');
        cols.forEach(div => {

            div.classList.remove('col-md-3', 'col-md-12');


            if (window.innerWidth > 1200) {
                div.classList.add('col-md-3');
            } else {
                div.classList.add('col-md-12');
            }
        });
    }

    updateCategoryCols();
    window.addEventListener('resize', updateCategoryCols);
    // year of experience
    let startYear = 2017;
    let currentYear = new Date().getFullYear();
    let yearsOfExperience = currentYear - startYear;
    document.getElementById("years-of-experience").innerHTML = yearsOfExperience + " <span>Years</span>";


});

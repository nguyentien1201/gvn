$(document).ready(function () {
    // Select2 all customers on promotion
    $("#cb-all-customer").click(function () {
        if ($(this).prop('checked') === true) {
            $('select#customer_ids option').prop("selected", "selected");
            $('select#customer_ids').trigger("change");
        } else {
            $("select#customer_ids option").removeAttr("selected");
            $("select#customer_ids").val(null).trigger("change");
        }
    });
    // Show url when choose file
    $('input[type="file"]').on('change', function () {
        //get the file name
        var fileName = $(this).val();
        //replace the "Choose a file" label
        $(this).next('.custom-file-label').html(fileName);
    })
resources
    $('.select2').select2();
    $('[data-mask]').inputmask();
    $('.date').datetimepicker({
        format: 'MM/DD/YYYY',
        locale: 'en',
    });
    $('.date-month').datetimepicker({
        format: 'MM/DD',
        locale: 'en',
    });
    $('.date-time').datetimepicker({
        format: 'MM/DD/YYYY HH:mm',
        locale: 'en',
    });
    $('.select2.is-invalid').map(function () {
        addInvalid($(this));
    });
    let th = $('.table-responsive-fixed').find('thead th');
    $('.table-responsive-fixed').on('scroll', function () {
        th.css('transform', 'translateY(' + this.scrollTop + 'px)');
    });
    $('.numeric').on("keyup blur", function (event) {
        $(this).val($(this).val().replace(/[^0-9]/g, ''));
        let key = event.which;
        if (key >= 48 && key <= 57 || key === 45 || key === 8 || key === 46 || key === 189 || key === 44) {
            return true;
        } else {
            event.preventDefault();
        }
    });
});

$(".btn-reset-search").click(function (e) {
    e.preventDefault();
    $('.select2').each(function (index, value) {
        $(this).prop('selectedIndex', 0).trigger('change');
    });
    $('.search-frm').find('input:not([type=hidden]), select, textarea').val('');
});

function addInvalid(elm) {
    let select2Elm = $(elm).siblings('.select2-container').find('.select2-selection');
    if (typeof select2Elm !== 'undefined') {
        select2Elm.addClass('is-invalid');
        select2Elm.addClass('form-control');
    }
}

function removeInvalid(elm) {
    let select2Elm = $(elm).siblings('.select2-container').find('.select2-selection');
    if (typeof select2Elm !== 'undefined') {
        if (select2Elm.hasClass('is-invalid')) {
            select2Elm.removeClass('is-invalid');
            select2Elm.removeClass('form-control');
        }
    }
}

function removeItem(obj) {
    let action = $(obj).data('action');
    let id = $(obj).data('id');
    let website = $(obj).data('website');
    let textConfirm = $(obj).data('text-confirm');
    if (typeof textConfirm !== 'undefined') {
        $('#confirmDelete .text-confirm').text(textConfirm);
    }
    $('#confirmDelete input[name="id"]').val(id);
    $('#confirmDelete input[name="website"]').val(website);
    $('#confirmDelete form').attr('action', action);
}

function addUpdateItem(obj) {
    let frm = $('#add-update-item form');
    let id = $(obj).data('id');
    let method = 'POST';
    if (typeof id !== 'undefined') {
        method = 'PUT';
    }
    frm.attr('action', $(obj).data('action'));
    frm.find('input[name="_method"]').val(method);
    frm.find('textarea[name="content"]').text($(obj).data('content') ?? '');
    frm.find('input[name="publish_time"]').val($(obj).data('publish_time') ?? '');
    frm.find('select[name="status"]').val($(obj).data('status') ?? 0);
}

function submitAlert(obj) {
    let frm = $(obj).closest('#add-update-item').find('form');
    $.ajax({
        url: frm.attr('action'),
        method: "POST",
        data: frm.serialize(),
        beforeSend: function () {
            $('#loading').show();
        },
        success: function (data) {
            window.location.reload();
        },
        error: function (data) {
            let errors = data.responseJSON.errors;
            frm.find('input, select, textarea').each(function () {
                let invalid = $(this).siblings('.invalid-feedback');
                if (invalid.length) {
                    if (typeof errors[$(this).attr('name')] !== 'undefined') {
                        invalid.text(errors[$(this).attr('name')][0] ? errors[$(this).attr('name')][0] : '');
                        invalid.css('display', 'block');
                        $(this).addClass('is-invalid');
                        addInvalid($(this));
                    } else {
                        invalid.empty();
                        invalid.css('display', 'none');
                        $(this).removeClass('is-invalid');
                        removeInvalid($(this));
                    }
                }
            });
            $('#loading').hide();
        },
    });
}

function updateAlert(obj) {
    let alertId = $(obj).data('alert_id');
    let action = $(obj).data('action');
    let orderId = $(obj).data('order_id');
    let website = $(obj).data('website');
    $.ajax({
        url: action,
        method: "POST",
        data: {
            alert_id: alertId,
            order_id: orderId,
            website: website,
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            if (data.status) {
                window.location.href = data.route;
            }
        }
    });
}

function submitSearchOrder(obj, isContacted) {
    let frm = $('.search-frm-order');
    let inputIsContacted = frm.find('input[name="is_contact"]');
    if (isContacted) {
        inputIsContacted.val(1);
    } else {
        inputIsContacted.val(0);
    }
    frm.submit();
}

function addContactNote(obj) {
    let action = $(obj).data('action');
    let id = $(obj).data('id');
    let website = $(obj).data('website');
    $('#contactNote form').attr('action', action);
    $('#contactNote input[name="id"]').val(id);
    $('#contactNote input[name="website"]').val(website);
    $('#contactNote input[name="latest_contact_date"]').val($(obj).data('latest_contact_date') ?? '');
    $('#contactNote textarea[name="contact_note"]').val($(obj).data('contact_note') ?? '');
    $('#contactNote input.is-invalid').map(function () {
        $(this).removeClass('is-invalid');
    });
    $('.invalid-feedback').css('display', 'none');
    $('#contactNote').modal('show');
}

function submitContactNote(obj) {
    let frm = $(obj).closest('#contactNote').find('form');
    $.ajax({
        url: frm.attr('action'),
        method: "POST",
        data: frm.serialize(),
        beforeSend: function () {
            $('#loading').show();
        },
        success: function (data) {
            window.location.reload();
        },
        error: function (data) {
            let errors = data.responseJSON.errors;
            $('#contactNote input').each(function () {
                let invalid = $(this).siblings('.invalid-feedback');
                if (invalid.length) {
                    if (typeof errors[$(this).attr('name')] !== 'undefined') {
                        invalid.text(errors[$(this).attr('name')][0] ? errors[$(this).attr('name')][0] : '');
                        invalid.css('display', 'block');
                        $(this).addClass('is-invalid');
                    } else {
                        invalid.empty();
                        invalid.css('display', 'none');
                        $(this).removeClass('is-invalid');
                    }
                }
            });
            $('#loading').hide();
        },
    });
}

function addTag(obj) {
    let tag = $(obj).data('tag');
    let message = $('#message');
    let position = message[0].selectionStart;
    let newMessage = message.val().substring(0, position) + '#' + tag + message.val().substring(position);
    message.val(newMessage);
}

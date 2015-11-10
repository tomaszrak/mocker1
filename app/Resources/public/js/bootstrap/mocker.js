$(document).ready(function () {
    jQuery('#add_header_button').click(function (e) {
        e.preventDefault();

        var headerList = jQuery('#headers_list');
        var headerCount = (headerList.find(':input').length - 1) / 2;

        var newWidget = headerList.attr('data-prototype');
        // replace the "__name__" used in the id and name of the prototype
        // with a number that's unique to your emails
        // end name attribute looks like name="contact[emails][2]"
        newWidget = newWidget.replace(/__name__/g, headerCount);

        // create a new list element and add it to the list
        var newLi = jQuery('<li class="row" style="margin-top: 10px"></li>').html(newWidget);
        newLi.appendTo(headerList);
    });
});

$("#mock_form").submit(function (e) {
    $.ajax({
        type: "POST",
        data: $(this).serialize(),
        beforeSend: function () {
            $.blockUI.defaults.css = {
                padding: 0,
                margin: 0,
                width: '30%',
                top: '40%',
                left: '35%',
                textAlign: 'center',
                cursor: 'wait'
            };
            $.blockUI({
                message: '<img src="images/ajax-loader.gif" id="loader" />'
            });
        },
        success: function (data) {
            showDialogWithMock(data);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.responseText);
        },
        complete: function () {
            $.unblockUI();
        }
    });
    e.preventDefault();
});

$("#submit_form_button").click(function () {
    var statusCode = $('#mock_responseStatus').val();

    if ($.isNumeric(statusCode) && statusCode >= 100 && statusCode <= 600) {
        $('#mock_responseStatus').parent().parent().removeClass('has-error');
        $("#mock_form").submit();
    } else {
        $('#mock_responseStatus').parent().parent().addClass('has-error');
        showValidationDialog();
    }
});

function showDialogWithMock(url) {
    BootstrapDialog.show({
        type: BootstrapDialog.TYPE_SUCCESS,
        title: 'Your mock URL',
        message: url,
        closable: false,
        buttons: [{
            label: 'Close',
            action: function (dialog) {
                dialog.close();
            }
        }]
    });
}

function showValidationDialog() {
    BootstrapDialog.show({
        type: BootstrapDialog.TYPE_DANGER,
        title: 'Validation error',
        message: 'Please correct your mock form',
        buttons: [{
            label: 'Close',
            action: function (dialog) {
                dialog.close();
            }
        }]
    });
}
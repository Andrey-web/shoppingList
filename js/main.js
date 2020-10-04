$(document).ready(function () {
    $('.nameFull').on('click', function () {
        $(this).hide();
        $(this).siblings(".inputProdName").show();
        $(this).siblings(".inputProdName").focus();

        $('.count').hide();
        $('.forHide').hide();
    });

    $('.yesIcon').on('click', function () {

        let id = $(this).attr('data-id');
        let postType = 'yes';
        let name = $(this).attr('data-name');
        let count = $(this).attr('data-count');
        let formId = $(this).attr('data-formId');
        let tr = $(this).parents('tr');

        let queryParams = new URLSearchParams(window.location.search);
        queryParams.set("tabId", formId);
        history.replaceState(null, null, "?"+queryParams.toString());

        $(this).removeClass('fa-cart-arrow-down').addClass('fa-spinner fa-spin');

        $.ajax({
            data: {id: id, yes: postType, formId: formId, name: name, count: count},
            method: 'POST',
            success: function(data) {
                tr.hide();
            },
        });
    });
});
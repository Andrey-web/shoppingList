$(document).ready(function () {
    $('.nameFull').on('click', function () {
        $(this).hide();
        $(this).siblings(".inputProdName").show();
        $(this).siblings(".inputProdName").focus();

        $('.count').hide();
        $('.forHide').hide();
    });
});
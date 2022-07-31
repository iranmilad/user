const baseUrl=($('meta[name="base-url"]').attr('content')??'')+ "/admin/";

$(document).on('click','[data-target="cancel"]',function (){
    window.history.back();
})

$(document).ready(function () {
    $(document).find("input[name='price'],input[name='discount_price'],input[data-price]").each(function () {
        this.value = number_format(this.value.replace(/\D/g, ''));
    })

});

$(document).on('input', 'input[name=\'price\'],input[name=\'discount_price\'],input[data-price]', function () {
    this.value = number_format(this.value.replace(/\D/g, ''));
});

$(document).on('submit', 'form', function (e) {
    const dataPrice = $(this).find('input[name=\'price\'],input[name=\'discount_price\'],input[data-price]');
    dataPrice.each(function () {
        $(this).val($(this).val().replace(/,/g, ''))
    })
});

function number_format(Number) {
    Number = Number.toString().replace(/,/g, '');
    let x = Number.split('.');
    let y = x[0];
    let z = x.length > 1 ? '.' + x[1] : '';
    const rgx = /(\d+)(\d{3})/;
    while (rgx.test(y)) {
        y = y.replace(rgx, '$1' + ',' + '$2');
    }
    return y + z;
}

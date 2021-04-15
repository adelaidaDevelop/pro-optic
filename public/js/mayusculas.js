$("input[type='text']").on('input', function(evt) {
    var input = $(this);
    var start = input[0].selectionStart;
    $(this).val(function(_, val) {
        return val.toUpperCase();
    });
    input[0].selectionStart = input[0].selectionEnd = start;
});
$("textarea").on('input', function(evt) {
    var input = $(this);
    var start = input[0].selectionStart;
    $(this).val(function(_, val) {
        return val.toUpperCase();
    });
    input[0].selectionStart = input[0].selectionEnd = start;
});

$("input[type='number']").on('input', function(tecla) {
    //if (this.value.length >= 10) return false;
    let code = tecla.charCode;
    if (code == 8) { // backspace.
        return true;
    } else if (code >= 48 && code <= 57) { // is a number.
        return true;
    } else { // other keys.
        return false;
    }
});
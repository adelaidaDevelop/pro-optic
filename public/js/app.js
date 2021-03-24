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
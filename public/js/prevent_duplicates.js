
// Prevent people from spamming the confirm button and creating multiple records with the same data

$('#form').on('submit', function () {
    $('#prevent-duplicate-btn').attr('disabled', 'true'); 
});
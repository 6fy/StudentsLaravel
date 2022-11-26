
// Prevent people from spamming the confirm button and creating multiple records with the same data

$('#form').on('submit', function () 
{
    $('#prevent-duplicate-btn').attr('disabled', 'true'); 
});


// Change type of member input in the add family member page

$("#date-input").on("input", function() 
{
    let current = $(this).val();

    let dob = new Date(current);
    let today = new Date();

    let age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));

    $("#type").val(getTitleFromAge(age)).change();
});

$("#contribution-amount").on("focusout", function() 
{
    let current = $(this).val();

    if (current < 0) {
        $("#contribution-amount").val(0);
    }

    let left = $("#left").val();

    if (current > left) {
        $("#contribution-amount").val(left);
    }
});

function getTitleFromAge(age) 
{
    if (age < 8) {
        return 'Jeugd';
    }
    else if (age >= 8 && age <= 12) {
        return 'Aspirant';
    }
    else if (age >= 13 && age <= 17) {
        return 'Junior';
    }
    else if (age >= 18 && age <= 50) {
        return 'Senior';
    } else {
        return 'Oudere';
    }
}
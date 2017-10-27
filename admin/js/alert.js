$(document).ready(function() {
    $('.delete').on('click', function() {
        if ($(this)) {
            if (confirm("Are you sure you want to delete this Item ?") == true) {
                return true;
            }
            else {
                return false;
            }
        }
        else {
            return true;
        }
    });
});
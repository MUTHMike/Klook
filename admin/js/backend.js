$(document).ready(function() {
    $('.delete').on('click', delete_item);
    $('.category').on('click', categoryPublishUnpublish);
    $('.article').on('click', articlePublishUnpublish);
    timeoutInit();
});

function articlePublishUnpublish(e) {
    e.preventDefault();
    var $this = $(this);
    var $sms = $('.sms');
    var arr_id = $this.attr('id').split('-');

    $.ajax({
        url: 'saveArticle.php',
        dataType: "json",
        type: "post",
        data: {
            'types': arr_id[1],
            'id': arr_id[0]
        },
        beforeSend: function() {
            $sms.html('Saving...');
        }
    }).done(function(data) {
        if (data.is_error == false) {

            if (arr_id[1] == 0) {
                $this.attr('title', 'Unpublish');
                $this.attr('id', arr_id[0] + '-1');
                $this.html('<i class="icon-ban-circle"></i>');
            } else {
                $this.attr('title', 'Publish');
                $this.attr('id', arr_id[0] + '-0');
                $this.html('<i class="icon-share"></i>');
            }

            $sms.html(data.message);
        } else {
            $sms.html(data.message);
        }
    }).fail(function() {

        $sms.html('There is problem in the server');
    });
    PublishUnpublishTimeout()
}

function categoryPublishUnpublish(e) {
    e.preventDefault();
    var $this = $(this);
    var $sms = $('.sms');
    var arr_id = $this.attr('id').split('-');

    $.ajax({
        url: 'saveCategory.php',
        dataType: "json",
        type: "post",
        data: {
            'types': arr_id[1],
            'id': arr_id[0]
        },
        beforeSend: function() {
            $sms.html('Saving...');
        }
    }).done(function(data) {
        if (data.is_error == false) {

            if (arr_id[1] == 0) {
                $this.attr('title', 'Unpublish');
                $this.attr('id', arr_id[0] + '-1');
                $this.html('<i class="icon-ban-circle"></i>');
            } else {
                $this.attr('title', 'Publish');
                $this.attr('id', arr_id[0] + '-0');
                $this.html('<i class="icon-share"></i>');
            }

            $sms.html(data.message);
        } else {
            $sms.html(data.message);
        }
    }).fail(function() {

        $sms.html('There is problem in the server');
    });
    PublishUnpublishTimeout()
}

// delete
function delete_item() {
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
}

function PublishUnpublishTimeout() {
    $('#js_show').show();
    setTimeout(function() {
        $('#js_show').fadeOut('slow');
    }, 1000);
}

function timeoutInit() {
    $('#msg_status').show();
    setTimeout(function() {
        $('#msg_status').fadeOut('slow');
    }, 1000);
}
function deleteMsg(keyword,url) {
    swal({
        title: "Are you sure want to delete this " + keyword + " ?",
        text: "This action will permanent remove " + keyword + ".",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, Do it!",
        closeOnConfirm: true
    }, function (isConfirm) {
        if (isConfirm) {
            window.location = url;
        } else {
            return false;
        }
    });
}
function getNoticeMsg(type, msg) {
    if (type == "success") {
        return '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>' + msg + '</div>';
    }
    if (type == "error") {
        return '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>' + msg + '</div>';
    }
    if (type == "info") {
        return '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>' + msg + '</div>';
    }
}
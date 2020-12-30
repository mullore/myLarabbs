$(document).ready(function () {
    $('.btn-follower').click(function () {
        axios.post()
            .then(function () {
                location.reload();
            })
    })
    $('.btn-disFollower').click(function () {
        axios.delete()
            .then(function () {
                location.reload();
            })
    })
})

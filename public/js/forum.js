var instanse = false;
var state;
var lastID;
var userID;
var searchToken;
var token;
var rows = 2;


class Classifieds {
    constructor() {
        this.update = updateAds;
        this.send = postAd;
        this.refresh = refreshAds;
        this.commentAd = postCommentAd;
        this.replyComment = postCommentReply;
        this.likeAd = postLikeAd;
        this.likeComment = postLikeComment;
        this.shareAd = shareAd;
        this.resetAds = resetAds;
    }
}

function resetAds() {

}
//check the latest activity
function refreshAds() {
    console.log("Refreshing");
    if (!instanse) {
        instanse = true;
        $.ajax({
            type: "GET",
            url: "/feed/enquirelatest",
            data: {
                "last_id": lastID,
                "user_id": userID,
                "search": searchToken
            },
            dataType: "json",

            success: function (data) {
                state = data.state;
                instanse = false;
            },
        });
    }
}

//Updates the activities
function updateAds() {
    if (!instanse) {
        instanse = true;
        var params = {
            "activity_id": lastID,
            "csrf": token,
            "user_id": userID
        };

        fetch('/feed/get-latest?' + new URLSearchParams(params)).then(response => {
                if (!response.ok) {
                    throw new Error(response.statusText)
                } else {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Ads refreshed',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    
                    response.json().then((result) => {
                        if(result != null){
                            state = result;
                            if (rows == 1) {
                                $('#activity-area').html(singleRowTemplates(state));
                            } else if (rows == 2) {
                                $('#activity-area').html(singleMiniRowTemplates(state));
                            } else if (rows == 3) {
                                $('#activity-area').html(doubleRowTemplates(state));
                            }
                            document.getElementById('activity-area').scrollTop = document.getElementById('activity-area').scrollHeight;
                            instanse = false;
                        }
                    });
                    
                }
            })
            .catch(error => {
                Swal.fire({
                    position: 'top-end',
                    title: 'Error occured',
                    text: `Refreshing Ads failed: ${error}`,
                    icon: 'error',
                    confirmButtonText: 'Ok'
                });
            });
    } else {
        setTimeout(updateAds, 10000);
    }
}

//send the message
function postAd(formData) {
    Swal.fire({
        title: 'Post Classified Ad',
        showCancelButton: true,
        confirmButtonText: 'Post',
        showLoaderOnConfirm: true,
        preConfirm: () => {
            return fetch('/feed/postactivity', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json;charset=utf-8',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    body: JSON.stringify(formData)
                }).then(response => {
                    if (!response.ok) {
                        throw new Error(response.statusText)
                    }
                    return response.json()
                })
                .catch(error => {
                    Swal.showValidationMessage(
                        `Posting failed: ${error}`
                    )
                })
        },
        allowOutsideClick: () => !Swal.isLoading()
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'You posted Ad successfully',
                showConfirmButton: false,
                timer: 1500
            });
            updateAds();
        }
    });
}

function postCommentAd(formData) {
    Swal.fire({
        title: 'Post Comment',
        showCancelButton: true,
        confirmButtonText: 'Post',
        showLoaderOnConfirm: true,
        preConfirm: () => {
            return fetch('/feed/postcommentactivity', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json;charset=utf-8',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    body: JSON.stringify(formData)
                }).then(response => {
                    if (!response.ok) {
                        throw new Error(response.statusText)
                    }
                    return response.json()
                })
                .catch(error => {
                    Swal.showValidationMessage(
                        `Posting failed: ${error}`
                    )
                })
        },
        allowOutsideClick: () => !Swal.isLoading()
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'You commented on Ad',
                showConfirmButton: false,
                timer: 1500
            });
            updateAds();
        }
    });
}

function postCommentReply(formData) {
    Swal.fire({
        title: 'Post Reply',
        showCancelButton: true,
        confirmButtonText: 'Post',
        showLoaderOnConfirm: true,
        preConfirm: () => {
            return fetch('/feed/postcommentreply', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json;charset=utf-8',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    body: JSON.stringify(formData)
                }).then(response => {
                    if (!response.ok) {
                        throw new Error(response.statusText)
                    }
                    return response.json()
                })
                .catch(error => {
                    Swal.showValidationMessage(
                        `Posting failed: ${error}`
                    )
                })
        },
        allowOutsideClick: () => !Swal.isLoading()
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'You replied to a comment',
                showConfirmButton: false,
                timer: 1500
            });
            updateAds();
        }
    });
}

function postLikeAd(formData) {
    fetch('/feed/like-activity', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json;charset=utf-8',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            body: JSON.stringify(formData)
        }).then(response => {
            if (!response.ok) {
                throw new Error(response.statusText)
            } else {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'You liked Ad',
                    showConfirmButton: false,
                    timer: 1500
                });
                updateAds();
            }
            return response.json()
        })
        .catch(error => {
            Swal.showValidationMessage(
                `Posting failed: ${error}`
            )
        })
}

function postLikeComment(formData) {
    fetch('/feed/like-comment', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json;charset=utf-8',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            body: JSON.stringify(formData)
        }).then(response => {
            if (!response.ok) {
                throw new Error(response.statusText)
            } else {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'You liked a comment',
                    showConfirmButton: false,
                    timer: 1500
                });
                updateAds();
            }
        })
        .catch(error => {
            Swal.showValidationMessage(
                `Posting failed: ${error}`
            )
        });
}

function shareAd() {}

function singleRowTemplates() {
    var html = "";
    if (state != null) {
        var geturl = window.location.protocol + '//' + window.location.host;
        var cols = "";
        state.forEach(element => {
            cols += '<div class="comment-box"> <span class="commenter-pic"> <img src="' + geturl + '/images/community/'+element.member.photo+'" height="65" width="65" class="img-fluid"> </span> <span class="commenter-name"> <a href="' + geturl + '/activity/' + element.slug + '" class="h4">' + element.heading + '</a><br> <small>posted by</small> ' + element.member.username + ' <small>' + element.created_at + '</small> </span> <div class="card" style="border: none; background-color: transparent;"> <img class="card-img-top" src="' + geturl + '/images/community/' + element.image_url + '" alt="loading..."> <div class="card-body"> <p class="card-txt">' + element.details + '</p> </div> </div> <div class="comment-meta d-flex justify-content-end"> <a href="tel:' + element.link_phone + '" class="btn mx-2 comment-like"><i class="fa fa-phone" aria-hidden="true"></i> Call Now</a> <a href="' + element.link_url + '" class="btn mx-2 comment-like"><i class="fa fa-link" aria-hidden="true"></i> Website</a>';
            if (element.is_member_logged_in) {
                if (!element.member_liked) {
                    cols += '<form action="' + geturl + '/like-activity" method="post" class="mr-1"> <input type="hidden" name="_token" value="' + element.csrf + '"> <input type="hidden" name="activity" value="' + element.id + '"> <button class="comment-like mt-2"><i class="fa fa-thumbs-up" aria-hidden="true"></i> ' + element.number_of_likes + '</button> </form>';
                } else {
                    cols += '<form action="' + geturl + '/dislike-activity" method="post" class="mr-1"> <input type="hidden" name="_token" value="' + element.csrf + '"> <input type="hidden" name="_method" value="DELETE"> <input type="hidden" name="activity" value="' + element.id + '"> <button class="comment-like mt-2"><i class="fa fa-thumbs-up" aria-hidden="true" style="color: blue;"></i>' + element.number_of_likes + '</button> </form>';
                }
            }
            cols += '<button class="comment-reply reply-popup" id="' + element.id + '"><i class="fa fa-reply-all" aria-hidden="true"></i> Comment</button> <span class="share-button sharer mx-2 mt-2" style="display: inline-block;"> <button class="comment-share" data-button="' + geturl + 'feed/' + element.id + '"><i class="fa fa-share-alt" aria-hidden="true"></i> Share</button> <span class="social top center networks-5 d-flex"> <!-- Facebook Share Button --> <a class="fbtn share facebook" href="https://www.facebook.com/sharer/sharer.php?u=' + geturl + '/feed/' + element.slug + '"><i class="fab fa-facebook-f"></i></a> <!-- Google Plus Share Button --> <a class="fbtn share whatsapp" href="whatsapp://send?text=' + geturl + '/feed/' + element.slug + '" data-action="share/whatsapp/share"><i class="fab fa-whatsapp"></i></a> <!-- Twitter Share Button --> <a class="fbtn share twitter" href="https://twitter.com/intent/tweet?text=' + element.heading + '&amp;url=' + geturl + '/feed/' + element.slug + '&amp;via=Kenyansintexas"><i class="fab fa-twitter"></i></a> </span> </span> </div> <div class="comment-box add-comment reply-box" id="reply-' + element.id + '"> <span class="commenter-pic"> <img src="' + geturl + '/images/logo/icon.png" class="img-fluid"> </span> <div class="row"> <form class="contact-form col-md-12" method="POST" action="' + geturl + '/feed/create-comment"> <input type="hidden" name="_token" value="' + element.csrf + '"> <input type="hidden" name="activity" value="' + element.id + '" /> <textarea class="form-control" placeholder="Add a public reply" rows="2" name="comment"></textarea> <button type="submit" class="btn btn-default">Reply</button> <button type="cancel" class="btn btn-default reply-popup">Cancel</button> </form> </div> </div> </div>';
        });
        html += cols;
    }
    return html;
}

function singleMiniRowTemplates() {
    var html = "";
    if (state != null) {
        var geturl = window.location.protocol + '//' + window.location.host;
        var cols = '';
        state.forEach(element => {
            cols += '<div class="card col-md-12 border border-secondary px-0 mb-4"> <div class="row no-gutters"> <div class="col-md-6 col-sm-12"> <img src="' + geturl + '/images/community/'+element.image_url+'" class="img-fluid" alt="'+element.heading+'" style="max-height: 400px;"> </div> <div class="col-md-6 col-sm-12"> <div class="card-block px-2"> <div class="h4"><span class="commenter-pic"> <img src="' + geturl + '/images/community/'+element.member.photo+'" height="65" width="65" class="img-fluid"> </span> <span class="commenter-name"> <a href="' + geturl + '/activity/' + element.slug + '" class="h5">' + element.heading + '</a><br> <small>posted by</small> ' + element.member.username + ' <small>' + element.created_at + '</small> </span></div> <p class="card-txt">' + element.details + '</p> </div> </div> </div> <div class="card-footer w-100 comment-meta d-flex justify-content-end"> <a href="tel:' + element.link_phone + '" class="btn mx-2 comment-like"><i class="fa fa-phone" aria-hidden="true"></i> Call Now</a> <a href="' + element.link_url + '" class="btn mx-2 comment-like"><i class="fa fa-link" aria-hidden="true"></i> Website</a>';
            if (element.is_member_logged_in) {
                if (!element.member_liked) {
                    cols += '<form action="' + geturl + '/like-activity" method="post" class="mr-1"> <input type="hidden" name="_token" value="' + element.csrf + '"> <input type="hidden" name="activity" value="' + element.id + '"> <button class="comment-like mt-2"><i class="fa fa-thumbs-up" aria-hidden="true"></i> ' + element.number_of_likes + '</button> </form>';
                } else {
                    cols += '<form action="' + geturl + '/dislike-activity" method="post" class="mr-1"> <input type="hidden" name="_token" value="' + element.csrf + '"> <input type="hidden" name="_method" value="DELETE"> <input type="hidden" name="activity" value="' + element.id + '"> <button class="comment-like mt-2"><i class="fa fa-thumbs-up" aria-hidden="true" style="color: blue;"></i>' + element.number_of_likes + '</button> </form>';
                }
            }
            cols += '<button class="comment-reply reply-popup" id="' + element.id + '"><i class="fa fa-reply-all" aria-hidden="true"></i> Comment</button> <span class="share-button sharer mx-2 mt-2" style="display: inline-block;"> <button class="comment-share" data-button="' + geturl + 'feed/' + element.id + '"><i class="fa fa-share-alt" aria-hidden="true"></i> Share</button> <span class="social top center networks-5 d-flex"> <!-- Facebook Share Button --> <a class="fbtn share facebook" href="https://www.facebook.com/sharer/sharer.php?u=' + geturl + '/feed/' + element.slug + '"><i class="fab fa-facebook-f"></i></a> <!-- Google Plus Share Button --> <a class="fbtn share whatsapp" href="whatsapp://send?text=' + geturl + '/feed/' + element.slug + '" data-action="share/whatsapp/share"><i class="fab fa-whatsapp"></i></a> <!-- Twitter Share Button --> <a class="fbtn share twitter" href="https://twitter.com/intent/tweet?text=' + element.heading + '&amp;url=' + geturl + '/feed/' + element.slug + '&amp;via=Kenyansintexas"><i class="fab fa-twitter"></i></a> </span> </span> </div> <div class="comment-box add-comment reply-box" id="reply-' + element.id + '"> <span class="commenter-pic"> <img src="' + geturl + '/images/logo/icon.png" class="img-fluid"> </span> <div class="row"> <form class="contact-form col-md-12" method="POST" action="' + geturl + '/feed/create-comment"> <input type="hidden" name="_token" value="' + element.csrf + '"> <input type="hidden" name="activity" value="' + element.id + '" /> <textarea class="form-control" placeholder="Add a public reply" rows="2" name="comment"></textarea> <button type="submit" class="btn btn-default">Reply</button> <button type="cancel" class="btn btn-default reply-popup">Cancel</button> </form> </div> </div> </div> </div>';
        });
        html += cols;
    }
    return html;
}

function doubleRowTemplates() {
    var html = "";
    if (state != null) {
        var geturl = window.location.protocol + '//' + window.location.host;
        var cols = '<div class="row">';
        state.forEach(element => {
            cols += '<div class="card col-md-6 border-0"> <div class="row no-gutters"> <div class="col-auto"> <img src="" class="img-fluid" alt=""> </div> <div class="col"> <div class="card-block px-2"> <div class="h4"><span class="commenter-pic"> <img src="' + geturl + '/images/logo/icon.png" class="img-fluid"> </span> <span class="commenter-name"> <a href="' + geturl + '/activity/' + element.slug + '" class="h4">' + element.heading + '</a><br> <small>posted by</small> ' + element.member.username + ' <small>' + element.created_at + '</small> </span></div> <p class="card-txt">' + element.details + '</p> </div> </div> </div> <div class="card-footer w-100 comment-meta d-flex justify-content-end"> <a href="tel:' + element.link_phone + '" class="btn mx-2 comment-like"><i class="fa fa-phone" aria-hidden="true"></i> Call Now</a> <a href="' + element.link_url + '" class="btn mx-2 comment-like"><i class="fa fa-link" aria-hidden="true"></i> Website</a>';
            if (element.is_member_logged_in) {
                if (!element.member_liked) {
                    cols += '<form action="' + geturl + '/like-activity" method="post" class="mr-1"> <input type="hidden" name="_token" value="' + element.csrf + '"> <input type="hidden" name="activity" value="' + element.id + '"> <button class="comment-like mt-2"><i class="fa fa-thumbs-up" aria-hidden="true"></i> ' + element.number_of_likes + '</button> </form>';
                } else {
                    cols += '<form action="' + geturl + '/dislike-activity" method="post" class="mr-1"> <input type="hidden" name="_token" value="' + element.csrf + '"> <input type="hidden" name="_method" value="DELETE"> <input type="hidden" name="activity" value="' + element.id + '"> <button class="comment-like mt-2"><i class="fa fa-thumbs-up" aria-hidden="true" style="color: blue;"></i>' + element.number_of_likes + '</button> </form>';
                }
            }
            cols += '<button class="comment-reply reply-popup" id="' + element.id + '"><i class="fa fa-reply-all" aria-hidden="true"></i> Comment</button> <span class="share-button sharer mx-2 mt-2" style="display: inline-block;"> <button class="comment-share" data-button="' + geturl + 'feed/' + element.id + '"><i class="fa fa-share-alt" aria-hidden="true"></i> Share</button> <span class="social top center networks-5 d-flex"> <!-- Facebook Share Button --> <a class="fbtn share facebook" href="https://www.facebook.com/sharer/sharer.php?u=' + geturl + '/feed/' + element.slug + '"><i class="fab fa-facebook-f"></i></a> <!-- Google Plus Share Button --> <a class="fbtn share whatsapp" href="whatsapp://send?text=' + geturl + '/feed/' + element.slug + '" data-action="share/whatsapp/share"><i class="fab fa-whatsapp"></i></a> <!-- Twitter Share Button --> <a class="fbtn share twitter" href="https://twitter.com/intent/tweet?text=' + element.heading + '&amp;url=' + geturl + '/feed/' + element.slug + '&amp;via=Kenyansintexas"><i class="fab fa-twitter"></i></a> </span> </span> </div> <div class="comment-box add-comment reply-box" id="reply-' + element.id + '"> <span class="commenter-pic"> <img src="' + geturl + '/images/logo/icon.png" class="img-fluid"> </span> <div class="row"> <form class="contact-form col-md-12" method="POST" action="' + geturl + '/feed/create-comment"> <input type="hidden" name="_token" value="' + element.csrf + '"> <input type="hidden" name="activity" value="' + element.id + '" /> <textarea class="form-control" placeholder="Add a public reply" rows="2" name="comment"></textarea> <button type="submit" class="btn btn-default">Reply</button> <button type="cancel" class="btn btn-default reply-popup">Cancel</button> </form> </div> </div> </div> </div>';
        });
        cols += '</div>'
        html += cols;
    }
    return html;
}

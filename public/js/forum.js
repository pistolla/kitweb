(function ($) {
    "use strict";
    jQuery(document).ready(function ($) {
        var instanse = false;
        var state;
        var lastID;
        var userID;
        var searchToken;

        function Forum () {
            this.update = updateActivity;
            this.send = postActivity;
            this.refresh = refreshActivities;
            this.commentActivity = postCommentActivity;
            this.replyComment = postCommentReply;
            this.likeActivity = postLikeActivity;
            this.likeComment = postLikeComment;
            this.shareActivity = shareActivity;
        }

        //check the latest activity
        function refreshActivities(){
            console.log("Refreshing");
            if(!instanse){ 
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
                    
                    success: function(data){
                        state = data.state;
                        instanse = false;
                    },
                });
            }	 
        }

        //Updates the activities
        function updateActivity(id, csrf, user_id){
            if(!instanse){
                instanse = true;
                $.ajax({
                    type: "POST",
                    url: "/feed/fetchactivity",
                    data: {  
                            "activity_id": id,
                            "csrf": csrf,
                            "user_id": user_id    
                        },
                    dataType: "json",
                    success: function(data){
                        if(data.view){
                            $('#activity-area').append(data.view);
                        }
                        document.getElementById('activity-area').scrollTop = document.getElementById('activity-area').scrollHeight;
                        instanse = false;
                        state = data.state;
                    },
                    });
            }
            else {
                setTimeout(updateActivity, 1500);
            }
        }

        //send the message
        function postActivity(formData)
        {       
            updateActivity();
            $.ajax({
                type: "POST",
                url: "/feed/postactivity",
                data: formData,
                success: function(data){
                    updateActivity();
                },
                });
        }

        function postCommentActivity(formData)
        {
            $.ajax({
                type: "POST",
                url: "/feed/postcommentactivity",
                data: formData,
                success: function(data){
                    updateActivity();
                },
                });
        }

        function postCommentReply(formData)
        {

        }

        function postLikeActivity()
        {

        }

        function postLikeComment()
        {

        }

        function shareActivity()
        {

        }
    });

}(jQuery));	

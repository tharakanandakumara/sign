function data($url){
    
            $.ajax({
            type: "POST",
            url: $url,
            contentType: false,
            cache: false,
            headers: {
                    Authorization: $token
                },
            processData: false,
            data: new FormData(this),
            // Update Url
            success: function(response) { // Setting Token

                if (response) {
                    if (response == "Your file was uploaded successfully") {
                        console.log(response);
                        
                    } else {
                        console.log(response);
                        //error notification here
                    }

                } else {
                    // notifyMe('.notify_panel', 'Invalid Credentials Entered', '0');
                }
            },
            statusCode: {
                404: function() {
                    //notifyMe('.notify_panel', 'Invalid Username', '0');
                },
                401: function() {
                    //notifyMe('.notify_panel', 'Invalid password', '0');
                }
            }
            });
    
}
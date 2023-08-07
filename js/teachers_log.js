document.body.style.backgroundImage = "url('new-image.jpg')";
$(document).ready(function(){
    //Get Report passenger
    $(document).on('click', '#user_log', function(){

        var date_sel = $('#date_sel').val();

        $.ajax({
            url: 'teacher_log_up.php',
            type: 'POST',
            data: {
                'log_date': 1,
                'date_sel': date_sel,
            },
            success: function(response){
                $ajax({
                    url: "user_log_up.php",
                    type: 'POST',
                    data: {
                        'log_date': 1,
                        'date_sel': date_sel,
                        'select_date': 0,
                    }
                }).done(function(data){
                    $('#userslog').html(data);
                });
            }
        });
    });
});
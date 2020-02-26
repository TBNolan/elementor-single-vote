( function($) {
    $('.movie-seen-toggle').click(function(){
        event.preventDefault();
        var classes = $.grep(this.className.split(" "), function(v, i){
            return v.indexOf('post-') === 0;
        }).join();
        var movieID = classes.slice(5);
        var fieldSet = $("#post-" + movieID);
        console.log(fieldSet);
        //user marked movie as unseen
        if($(this).hasClass('seen')) { 
            $(this).text('Mark as Seen');
            $(this).removeClass('seen');
            $(this).addClass('unseen');
            fieldSet.addClass('hidden');
            $.ajax( {
                url: ajax_url,
                type: 'POST',
                data: {
                    action      :   'single_update_seen_status',
                    'seen'      :   0,
                    'movieID'   :   movieID,
                }
            });
        //user marked movie as seen
        } else {
            $(this).text('Mark as Unseen');
            $(this).addClass('seen');
            $(this).removeClass('unseen');
            fieldSet.removeClass('hidden');
            $.ajax( {
                url: ajax_url,
                type: 'POST',
                data: {
                    action      :   'single_update_seen_status',
                    'seen'      :   1,
                    'movieID'   :   movieID,
                }
            });
        }
    });
    $('input[type=radio]').change(function(){
        event.preventDefault();
        var inputName = this.name;
        var movieID = inputName.slice(11); //slice off 11 characters from beginning leaving us with movie ID
        var rating = this.value;
        $.ajax( {
            url: ajax_url,
            type: 'POST',
            data: {
                action      :   'single_update_rating',
                'rating'      :   rating,
                'movieID'   :   movieID,
            }
        });
    });
})(jQuery);
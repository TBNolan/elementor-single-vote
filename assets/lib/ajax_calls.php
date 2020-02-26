<?php
//update seen status of movies (AJAX)
 function single_record_movie_seen_status() {
     if (! isset( $_POST ) || empty( $_POST ) || !is_user_logged_in() ) {
        header( 'HTTP/1.1 400 Empty POST Values' );
        echo 'Could Not Verify POST Values.';
        exit;
     }

     $user_id = get_current_user_id();
     $movieMetaKey = 'movie-statuses';
     $movieID = $_POST['movieID'];
     $seen = $_POST['seen'];

     $movieArray = (get_user_meta($user_id, $movieMetaKey, true)) ? get_user_meta($user_id, $movieMetaKey, true) : [] ;
     $movieArray[$movieID]['seen'] = $seen;
     update_user_meta( $user_id, $movieMetaKey, $movieArray);
    
     exit;
 }
 add_action('wp_ajax_nopriv_single_update_seen_status', 'single_record_movie_seen_status');
 add_action('wp_ajax_single_update_seen_status', 'single_record_movie_seen_status');

 //update rating of Movie (AJAX_)
 function single_record_movie_rating() {
    if (! isset( $_POST ) || empty( $_POST ) || !is_user_logged_in() ) {
       header( 'HTTP/1.1 400 Empty POST Values' );
       echo 'Could Not Verify POST Values.';
       exit;
    }

    $user_id = get_current_user_id();
    $movieMetaKey = 'movie-statuses';
    $movieID = $_POST['movieID'];
    $rating = $_POST['rating'];

    $movieArray = (get_user_meta($user_id, $movieMetaKey, true)) ? get_user_meta($user_id, $movieMetaKey, true) : [] ;
    $movieArray[$movieID]['rating'] = $rating;
    update_user_meta( $user_id, $movieMetaKey, $movieArray);
   
    exit;
}
add_action('wp_ajax_nopriv_single_update_rating', 'single_record_movie_rating');
add_action('wp_ajax_single_update_rating', 'single_record_movie_rating');
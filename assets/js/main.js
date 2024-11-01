jQuery(document).ready(function($) {
    if (wopoSolitaire.is_shortcode != 0){        
        $('#wopo_notepad').attr('src',wopoSolitaire.app_url);
        $('#wopo_notepad_window').show('slow');
    }
    $('#wopo_notepad_window .btn-close').click(function(){        
        $('#wopo_notepad_window').hide('slow');
    });    
    $('#wopo_notepad_window .btn-minimize').click(function(){        
        $('#wopo_notepad_window').removeClass('maximize').toggleClass('minimize');
    });
    $('#wopo_notepad_window .btn-maximize').click(function(){
        $('#wopo_notepad_window').removeClass('minimize').toggleClass('maximize');
    });
});
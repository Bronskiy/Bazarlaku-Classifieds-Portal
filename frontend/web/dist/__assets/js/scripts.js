$(document).ready(function(){

    // List & Grid View
    $('#serchlist .searchresult:first').show();
    $('#bloglist .bloglisting:first').show();
    $('#list').click(function(){
        $(this).addClass ('btn-orange').children('i').addClass('icon-white')
        $('.grid').fadeOut()
        $('.list').fadeIn()
        $('#grid').removeClass ('btn-orange').children('i').removeClass('icon-white')
    });
    $('#grid').click(function(){
        $(this).addClass ('btn-orange').children('i').addClass('icon-white')
        $('.list').fadeOut()
        $('.grid').fadeIn()
        $('#list').removeClass ('btn-orange').children('i').removeClass('icon-white')
    });

});
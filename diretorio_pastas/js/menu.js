$(document).ready(function(){
    
    //ação click do menu
    $('#menu_mobile').click(function(){
       $('#list_menu').removeClass('menu_mobile_close'); 
       $('#list_menu').addClass('menu_mobile_open'); 
    });
    
    //ação de fechar o menu no click do iten
    $('.link_menu').click(function(){
        $('#list_menu').removeClass('menu_mobile_open');
        $('#list_menu').addClass('menu_mobile_close');
    });
    
    
    
    //ação click do menu
    $('#menu_mobile_header').click(function(){
        $('#menu_mobile_itens').slideToggle(1000);
    
        
    });
    
    
    
    
    
    
});
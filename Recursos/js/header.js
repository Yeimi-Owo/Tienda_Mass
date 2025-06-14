window.addEventListener("scroll", function(){
    var header = document.querySelector("header");
    header.classList.toggle("abajo",window.scrollY>0);
})

$('#main-nav li a').on('click', function() {
    var activeLink = $('.active');
    activeLink.removeClass('active'); 
    $(this).parent().addClass('active');
});
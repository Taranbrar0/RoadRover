$(document).ready(function(){
    $(".trendItems img").animate({
        left:0, 
    },1000,'linear');
    $(".menuBtn").on("click",function(){
        if($(".rightNav").hasClass("show")){
            $(".rightNav").removeClass("show");
            $(".rightNav").addClass("hide");
        }
        else{
            $(".rightNav").addClass("show");
        }       
    });

    let intialPicPos=$(".trendItems img").position().top;
    $(window).on("scroll", function() {
        let scrlTop=$(window).scrollTop;
        let pic = $(".trendItems img");
        let picPos = pic.position().top-scrlTop;
        let car2Pos = $(".car2 img").position().top-scrlTop;

        if (picPos <= car2Pos) {
            pic.css({"position": "fixed", "top":  intialPicPos+ "px"}); // Fixing pic relative to nav
        } else {
            pic.css({"position": "static", "top": "auto"}); // Resetting pic to normal position
        }
        console.log("window"+$(window).scrollTop())
        console.log("pic position: " + picPos);
        console.log("car2 position: " + car2Pos);
    });

    // Initial animation to position the carLogo
    $('#carLogo').animate({
        bottom: '5rem'
    }, 2000);

    // Click event on carLogo
    $('#carLogo').click(function() {
        $('html, body').animate({ scrollTop: 0 }, 1000); // Smooth scroll to top

        $(this).animate({
            bottom: '+=2480px' // Move the element
        }, 1000, function() {
            // Reset position and ensure display is set to block
            $('#carLogo').css({
                bottom: '5rem',
                display: 'block'
            });
        });
    });

    // Scroll event to control visibility and position of carLogo
    $(window).scroll(function() {
        if ($(this).scrollTop() > 300) {
            $('#carLogo').css({
                bottom: '5rem',
                display: 'block'
            });
        } else {
            $('#carLogo').css('display', 'none');
        }
    });
});
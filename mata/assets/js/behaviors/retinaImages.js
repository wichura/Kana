$(window).ready(function() {

    var isRetina = window.devicePixelRatio > 1;

    if (isRetina)
        $("img:not(.no-retina-version)").each(function(i, el) {
            var newImg = $(new Image());
            var newSrc =
                    $(el).attr("src").substring(0, $(el).attr("src").lastIndexOf(".")) + "@x2" +
                    $(el).attr("src").substring($(el).attr("src").lastIndexOf("."), $(el).attr("src").length);


            $(newImg).on("load", function() {

                $("body").append($(newImg).css({opacity: 0, position: "absolute"}))

                var width = $(el).width();
                var height = $(el).height();
                
                if (width == 0 || height == 0) {
                    width = newImg.width() /2;
                    height = newImg.height() /2;
                }
                    

                $(el).css({
                    width: width,
                    height: height
                });

                $(newImg).remove();

                $(el).attr("src", newSrc)
            })

            newImg.attr("src", newSrc);
        })
})
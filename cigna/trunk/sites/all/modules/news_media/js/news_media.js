(function ($){
    $(document).ready(function(){ 
        
        $("html").addClass("js");
        $.fn.accordion.defaults.container = false; 
          $("#acc3").accordion({initShow: "#current"});
          $("#acc1").accordion({
              el: ".h", 
              head: "h4, h5", 
              next: "div", 
              initShow : "div.outer:eq(1)",
             
          });
          $("#acc2").accordion({
              obj: "div", 
              wrapper: "div", 
              el: ".h", 
              head: "h4, h5", 
              next: "div", 
              showMethod: "slideFadeDown",
              hideMethod: "slideFadeUp",
              initShow : "div.shown",
              elToWrap: "sup, img"
            });
          $("html").removeClass("js");
    });
})(jQuery);
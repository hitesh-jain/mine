(function ($){
        
        $(document).ready(function(){
             
            $("#demo1 h3.expand").toggler();
            $("#demo1").expandAll({
              trigger: "h3.expand", 
              ref: "h3.expand", 
              showMethod: "slideDown", 
              hideMethod: "slideUp"
            });
        });
})(jQuery);
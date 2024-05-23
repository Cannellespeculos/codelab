import $ from "jquery"
import jQuery from "jquery"
window.jQuery = jQuery
await import ("jquery-ui/dist/jquery-ui")

$("contenu h2[id]").each((i, el) => {
    let link = $("<a>", {
      href : '#'+ $(el).attr("id")
    })
  
    link.text($(el).text())
  
    $(".menu").append($("<li>").append(link))
  })


  $(".yeahh").css({"width" : "200px", "height" : "200px", "background-color" : "red", "border" : "2px solid black"})

  $('.yeahh').on('click', 'p', function(i, el){
    $(el).after('<p>Ce p a les mêmes caractéristiques que son parent</p>');
    });

    $("button").on("click", () => {
        // $("#a").toggle(1000)
        $("#a").slideDown(3000)
    })
   
    $(".f").draggable()
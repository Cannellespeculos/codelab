import './style.css';
import $ from "jquery";

// $(document).ready(function(){
//   let link = $("<a>", {
//     href : "https://www.afip.fr",
//     title : "Allez sur le site de l'école"
//   })
//   link.text("Site de Edenschool")

//   $("#menu ul").replaceWith(link);
// })
// let td = $("td")

// for (let i = 0; i < td.length; i++) {
//   console.log($(td[i]).text())
  
// }


// $("td").each((index, el) => {
//   console.log(index + ":" + $(el).text())
// })

// $("tr:odd").css("background-color","lightblue")


$("input[type=\"submit\"]").on("click", (ev) => {
  ev.preventDefault()
  $("input:checked").each((i,el) => {
    console.log($(el).val())
  })
})



$("contenu h2[id]").each((i, el) => {
  let link = $("<a>", {
    href : '#'+ $(el).attr("id")
  })

  link.text($(el).text())

  $(".menu").append($("<li>").append(link))
})
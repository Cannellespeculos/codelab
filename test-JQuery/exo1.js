import $, { event } from "jquery";

// $("#menu").each((i,el) => {
//     $(el).hover(() => {
//         $(el).css("background" , "red")
//     })
// })


// $("option").each((i,el) => {
//     $(el).on("click", () => {
//         $("#ajouter").on("click", () => {
//             $("#list").append(el)
//             $("#fruit").remove(el)
    
//         })

//         $("#supprimer").on('click', () => {
//             $("#fruit").append(el)
//             $("#list").remove(el)
//         })
             
//     })

// })

if ($(".fruit:selected")) {
    $("#ajouter").css("color", "black")
    $(".list:selected").removeAttr("selected")
}else if ($(".list:selected")) {
    $("#supprimer").css("color", "black")
    $(".fruit:selected").removeAttr("selected")
}

$("#ajouter").on("click", () => {
    $("#list").append($(".fruit:selected"))
    $("#fruit").remove($(".list:selected"))
    $(".fruit:selected").removeAttr("selected")
})

$("#supprimer").on("click", () => {
    $("#fruit").append($(".list:selected"))
    $("#list").remove($(".fruit:selected"))
    $(".list:selected").removeAttr("selected")
})

let last;
let time;
$("p").on("click", (ev) => {
    if (last) {
        time = ev.timeStamp - last
        $(".time").append(`<p>time since last event = ${time}</p>`)
    }else {
        $(".time").append("click again")
    }
   last = ev.timeStamp
})



$(".form").each((i, el) => {
    let ne = $(el).attr("name");
    $(el).on("click", () => {
        $(`label[for='${ne}']`).fadeOut(5000)
    })
})
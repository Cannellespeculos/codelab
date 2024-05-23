const p = document.getElementById("p")
const previousCount = localStorage.getItem("compteur")

if (!previousCount){
    localStorage.setItem("compteur", 1)
    p.innerHTML = `
    <p>Vous avez vu cette page 1 fois</p>
    `
} else {
    localStorage.setItem("compteur", parseInt(previousCount)+1)
    const count = parseInt(previousCount)+1
    p.innerHTML = `
    <p>Vous avez vu cette page ${count} fois</p>
    `
}
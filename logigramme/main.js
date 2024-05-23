import './style.css'

function caesar(ecart, code) {
    let newcode = ""
    let i = 0


    while (i < code.length) {
      if (code.charCodeAt(i)) {
        console.log("c");
        let index = code.charCodeAt(i)
        index = index + ecart%26
        console.log(index);

          if (index > 122) {
            console.log(index);
            index = index + ecart%26 - 26
            
          }
       
          newcode += String.fromCharCode(index)
      }
      i++;
    }

    return newcode
}

console.log(caesar(21,"cannelle"));
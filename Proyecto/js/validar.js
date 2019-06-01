function validaCantidad() {
  var x, text;

  // Get the value of the input field with id="numb"
  x = document.getElementById("cantidad").value;

  // If x is Not a Number or less than one or greater than 10
  if (isNaN(x) || x < 1 || x > 10) {
    text = "Cantidad no valida";
  } else{
  	text = "";
  }
  document.getElementById("Cantidad no válida").innerHTML = text;
}
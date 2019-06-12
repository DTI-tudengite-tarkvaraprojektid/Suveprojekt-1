/*jshint esversion:6*/
let modal;
let modalImg;
let captionText;
let span;


window.onload = function(){
// Get the modal
 modal = document.getElementById("myModal");

// Get the image and insert it inside the modal - use its "alt" text as a caption
img = document.getElementById("file");
modalImg = document.getElementById("modalImg");
captionText = document.getElementById("caption");
};

function openModal(){
  modal.style.display = "block";
  modalImg.src = this.src;
  captionText.innerHTML = this.alt;
}

// Get the <span> element that closes the modal
span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
function closeModal() {
modal.style.display = "none";
}

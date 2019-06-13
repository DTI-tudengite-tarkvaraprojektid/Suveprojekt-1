/*jshint esversion:6*/
let modal;
let modalImg;
let captionText;
let photoDir = "uploads/";
let photoId;


window.onload = function(){
// Get the modal
 modal = document.getElementById("myModal");

// Get the image and insert it inside the modal - use its "alt" text as a caption

modalImg = document.getElementById("modalImg");
let allPics = document.getElementById("photoRow").getElementsByTagName("img");
for(let i = 0; i < allPics.length; i ++){
		allPics[i].addEventListener("click", openModal);
	}
	document.getElementById("close").addEventListener("click", closeModal);

};

function openModal(e){
  modalImg.src = photoDir + e.target.dataset.fn;
  document.getElementById("caption").innerHTML = "<p>" + e.target.alt + "</p>";
  modal.style.display = "block";
  photoId = e.target.dataset.id;
  captionText.innerHTML = this.alt;
  document.addEventListener("keypress", closewithKey);
}

function closewithKey(e){
	console.log(e.keyCode);
	if(e.keyCode == 27){
		closeModal();
		//seal ka remove event listener
	}
}


// When the user clicks on <span> (x), close the modal
function closeModal(){
	document.removeEventListener("keypress", closewithKey);
	modal.style.display = "none";
}
document.onkeydown = function(evt) {
	evt = evt || window.event;
	var isEscape = false;
	if("key" in evt) {
		isEscape = (evt.key === "Escape" || evt.key === "Esc");
	} else {
		isEscape = (evt.keyCode === 27);
	}
	if(isEscape) {
		closeModal();
	}
}

/*jshint esversion: 6*/
window.onload=function(){
    openNav();
    closeNav();
  
  };
  
  function openNav() {
    changeColorButton.addEventListener('click', changeBackgroundColor);
  
  }
  function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
  }
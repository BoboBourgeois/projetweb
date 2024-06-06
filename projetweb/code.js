const openNavButton = document.querySelector(".nav_toggle")
const navigation = document.querySelector("nav")
openNavButton.addEventListener("click", ToggleNav)

function ToggleNav() {
	openNavButton.classList.toggle("active")
	navigation.classList.toggle("active")
}


var tab=1;
var totalimage=11;

function plusslides(x){

    var image=document.getElementById('img');
    tab = tab + x;
    image.src="images/grille"+tab+".jpg";

    if(tab>=totalimage)
    {
        tab=1;
    }else if(tab<1)
    {
        tab=totalimage;
    }
}

function sliderAuto(){
    var image=document.getElementById('img');
    tab++;
    image.src="images/grille"+tab+".jpg";

    if(tab>=totalimage)
    {
        tab=1;
    }else if(tab<1)
    {
        tab=totalimage;
    }
}
window.setInterval(sliderAuto, 3000);
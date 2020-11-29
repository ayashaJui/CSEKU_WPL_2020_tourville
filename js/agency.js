
//Toggle Active State...
const navState = document.querySelectorAll(".subnav"),
current = document.querySelector(".nav");

for (let i = 0; i < navState.length; i++) {
    navState[i].addEventListener("click", (e) => {
        current.querySelector(".active").classList.remove("active");
        e.target.classList.add("active");
    });
}

//change according to click
const packageDetails = document.querySelector('.package-content');
const reviewDetails = document.querySelector('.review-content');
const infoDetails = document.querySelector('.info-content');

document.querySelector('.package').addEventListener('click', packageState);
document.querySelector('.reviews').addEventListener('click', reviewState);
document.querySelector('.info').addEventListener('click', infoState);

function packageState(e){
    packageDetails.style.display = 'block';
    reviewDetails.style.display = 'none';
    infoDetails.style.display = 'none';
    e.preventDefault();
}
function reviewState(e){
    packageDetails.style.display = 'none';
    reviewDetails.style.display = 'block';
    infoDetails.style.display = 'none';
    e.preventDefault();
}
function infoState(e){
    packageDetails.style.display = 'none';
    reviewDetails.style.display = 'none';
    infoDetails.style.display = 'block';
    e.preventDefault();
}
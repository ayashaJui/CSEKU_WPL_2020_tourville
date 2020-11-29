
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
const tourDetails = document.querySelector('.tour-details-content');
const itinerary = document.querySelector('.itinerary-content');
const gallery = document.querySelector('.gallery-content');
const review = document.querySelector('.review-content');

document.querySelector('.tour-details').addEventListener('click', tourDetailsState);
document.querySelector('.itinerary').addEventListener('click', itineraryState);
document.querySelector('.gallery').addEventListener('click', galleryState);
document.querySelector('.review').addEventListener('click', reviewState);

function tourDetailsState(e){
    tourDetails.style.display = 'block';
    itinerary.style.display = 'none';
    gallery.style.display = 'none';
    review.style.display = 'none';
    e.preventDefault();
}
function itineraryState(e){
    tourDetails.style.display = 'none';
    itinerary.style.display = 'block';
    gallery.style.display = 'none';
    review.style.display = 'none';
    e.preventDefault();
}
function galleryState(e){
    tourDetails.style.display = 'none';
    itinerary.style.display = 'none';
    gallery.style.display = 'block';
    review.style.display = 'none';
    e.preventDefault();
}
function reviewState(e){
    tourDetails.style.display = 'none';
    itinerary.style.display = 'none';
    gallery.style.display = 'none';
    review.style.display = 'block';
    e.preventDefault();
}

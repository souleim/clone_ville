let compteur = 0;
let mvtDiapo, diaporama, elements, sliders, largeurDiapo, speed, transition;


window.onload = () => {

    elements = document.querySelector('.elements');
    diaporama = document.querySelector('#diaporama');
    largeurDiapo = diaporama.getBoundingClientRect().width;

    const firstSlide = elements.firstElementChild.cloneNode(true);
    elements.appendChild(firstSlide);
    sliders = Array.from(elements.children);


    const suiv = document.querySelector('.suiv');
    suiv.addEventListener('click', diapoSuivant);


    const prec = document.querySelector('.prec');
    prec.addEventListener('click', diapoPrecedent);

    mvtDiapo = setInterval(diapoSuivant, 5000);

    diaporama.addEventListener('mouseover', arretDiapo);
    diaporama.addEventListener('mouseout', demarreDiapo);

}

function arretDiapo(){
    clearInterval(mvtDiapo);
}

function demarreDiapo(){
    mvtDiapo = setInterval(diapoSuivant, 5000);
}

function diapoSuivant(){
    compteur++;
    elements.style.transition = "1s linear";
    let decal = -largeurDiapo * compteur;
    elements.style.transform = `translateX(${decal}px)`;

    setTimeout(function(){
        if(compteur >= sliders.length - 1){
            compteur = 0;
            elements.style.transition = "unset";
            elements.style.transform = "translateX(0)";
        }
        
    }, 1000);
}

function diapoPrecedent(){
    compteur--;
    elements.style.transition = "1s linear";
    
    if(compteur < 0){
        compteur = sliders.length - 1;
    
        let decal = -largeurDiapo * compteur;
        elements.style.transition = "unset";
        elements.style.transform = `translateX(${decal}px)`;
        setTimeout(diapoPrecedent, 1);
    }
    let decal = -largeurDiapo * compteur;
    elements.style.transform = `translateX(${decal}px)`;
}





// Menu principal
const urlActuel = location.href;
const liens = document.querySelectorAll('li a');
const lgLiens = liens.length;
for(let i = 0; i < lgLiens; i++){
    if(liens[i].href === urlActuel){
        console.log(liens[i].parentElement);
        liens[i].parentElement.className = 'active';
    }
}

// Menu principal responsive
const body = document.querySelector('body');
const menu_burger = document.querySelector('.menu_burger');


menu_burger.addEventListener('click', () => {
    body.classList.toggle('open');
})

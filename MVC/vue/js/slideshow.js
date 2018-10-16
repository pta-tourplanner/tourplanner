window.onload = function(){
    slideshow();
};

// La fonction de slideshow
var backImg = [
    '../../img/img_paris1.jpg',
    '../../img/img_paris2.jpg',
    '../../img/img_paris3.jpg',
    '../../img/img_paris4.jpg',
    '../../img/img_paris5.jpg',
    '../../img/img_paris-.jpg',
            ];
var pos = 0;
var diapo = document.querySelector('.container');
var chrono;

function slideshow(){
    clearTimeout(chrono);
    diapo.style.backgroundImage = backImg[pos];
    pos++;
    if (pos == backImg.length){
        pos = 0;
    }
    chrono = setTimeout(slideshow, 1000);
}
function load() {
    menuButton = document.getElementsByClassName('searchButton')[0];
    searchMenu = document.getElementsByClassName('searchMenu')[0];
    searchMain = document.getElementsByClassName('searchMain')[0];
    searchMenu.style.left = '-' + searchMain.offsetWidth + 'px';
    menuButton.addEventListener('click', menuAppear);
    hover = document.getElementById('searchHover');
    menuButton.addEventListener('mouseover', function () {
        hover.style.visibility = 'visible';
    });
    menuButton.addEventListener('mouseout', function () { 
        hover.style.visibility = 'hidden';
    });
}

function menuAppear() {
    smoothChangeCoords(-searchMain.offsetWidth, 0)
    menuButton.removeEventListener('click', menuAppear);
    menuButton.addEventListener('click', menuDisappear);
    menuButton.src = 'img/searchLeft.png';

}

function menuDisappear() {
    smoothChangeCoords(0, -searchMain.offsetWidth);
    menuButton.removeEventListener('click', menuDisappear);
    menuButton.addEventListener('click', menuAppear);
    menuButton.src = 'img/searchRight.png';
}

function smoothChangeCoords(start, end) {
    var step = (end - start) / 25;
    var moveTimer = setInterval(function () {
        searchMenu.style.left = start + step + 'px';
        step += (end - start) / 25;
        if (Math.abs(step) >= Math.abs((end - start) - (end - start) / 25)) {
            searchMenu.style.left = end + 'px';
            clearInterval(moveTimer);
        }
    }, 10);
}

window.addEventListener('load', load);
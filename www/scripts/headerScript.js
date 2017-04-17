function load() {
    options = document.getElementsByClassName('option');
    rent = document.getElementsByClassName('rent');
    sale = document.getElementsByClassName('sale');

    for (var i = 0; i < rent.length; i++) {
        rent[i].style.display = 'block';
    }

    options[0].getElementsByTagName('div')[0].style.visibility = 'visible';
    for (var i = 0; i < options.length; i++) {
        options[i].addEventListener('mouseover', function () { this.style.background = 'rgba(255,255,255,0.3)'; });
        options[i].addEventListener('mouseout', function () { this.style.background = 'none'; });
    }
    options[0].addEventListener('click', function () {
        options[1].getElementsByTagName('div')[0].style.visibility = 'hidden';
        this.getElementsByTagName('div')[0].style.visibility = 'visible';
        for (var i = 0; i < rent.length; i++) {
            rent[i].style.display = 'block';
        }
        for (var i = 0; i < sale.length; i++) {
            sale[i].style.display = 'none';
        }
    });
    options[1].addEventListener('click', function () {
        options[0].getElementsByTagName('div')[0].style.visibility = 'hidden';
        this.getElementsByTagName('div')[0].style.visibility = 'visible';
        for (var i = 0; i < rent.length; i++) {
            rent[i].style.display = 'none';
        }
        for (var i = 0; i < sale.length; i++) {
            sale[i].style.display = 'block';
        }
    });
}

window.addEventListener('load', load);
function load() {
    up = document.getElementById('up');
    upHover = document.getElementById('upHover');
    up.addEventListener('click', function () {
        scrollSmooth(0);
    });
    up.addEventListener('mouseover', function () {
        upHover.style.display = 'block';
    });
    up.addEventListener('mouseout', function () {
        upHover.style.display = 'none';
    });
    document.addEventListener('scroll', scroll);
}

function scrollSmooth(position) {
    var currentPos = document.documentElement.scrollTop || document.body.scrollTop;
    var step = (position - currentPos) / 20;
    var timerScroll = setInterval(function () {
        currentPos += step;
        window.scrollTo(0, currentPos);
        if (currentPos - position < 10 && position - currentPos < 10) { window.scrollTo(0, currentPos); clearInterval(timerScroll); }

    }, 10);
}

function scroll() {
    scrolled = window.pageYOffset || document.documentElement.scrollTop;
    if (screen.height < scrolled) {
        up.style.display = 'block';
    } else {
        up.style.display = 'none';
    }
}

window.addEventListener('load', load);
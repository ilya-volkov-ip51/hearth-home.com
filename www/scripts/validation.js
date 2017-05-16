function usernameCheck() {
    var regexp = /^.{3,30}$/;
    if (this.value.search(regexp) === -1) {
        this.style.border = '1px solid red';
        this.nextSibling.nextSibling.style.display = 'block';

    } else {
        this.style.border = 'none';
        this.nextSibling.nextSibling.style.display = 'none';
    }
}

function loginCheck() {
    var regexp = /^[a-zA-Z_.-]{6,30}$/;
    if (this.value.search(regexp) === -1) {
        this.style.border = '1px solid red';
        this.nextSibling.nextSibling.style.display = 'block';

    } else {
        this.style.border = 'none';
        this.nextSibling.nextSibling.style.display = 'none';
    }
}

function passwordCheck() {
    var regexp = /^.{8,30}$/;
    if (this.value.search(regexp) === -1) {
        this.style.border = '1px solid red';
        this.nextSibling.nextSibling.style.display = 'block';

    } else {
        this.style.border = 'none';
        this.nextSibling.nextSibling.style.display = 'none';
    }
}

function passwordConfirmCheck() {
    if (password.value != this.value) {
        this.style.border = '1px solid red';
        this.nextSibling.nextSibling.style.display = 'block';
    } else {
        this.style.border = 'none';
        this.nextSibling.nextSibling.style.display = 'none';
    }
}

function emailCheck() {
    var regexp = /^[0-9a-zA-Z_.-]+@[a-zA-Z_]+?\.[a-zA-Z]+$/;
    if (this.value.search(regexp) === -1 || this.value.search(/^.{6,40}$/) === -1) {
        this.style.border = '1px solid red';
        this.nextSibling.nextSibling.style.display = 'block';

    } else {
        this.style.border = 'none';
        this.nextSibling.nextSibling.style.display = 'none';
    }
}

function load() {
    login = document.getElementsByClassName('login')[0];
    login.addEventListener('input', loginCheck);
    login.nextSibling.nextSibling.innerHTML = '6-30 letters or (_.-)';

    password = document.getElementsByClassName('password')[0];
    password.addEventListener('input', passwordCheck);
    password.nextSibling.nextSibling.innerHTML = '8-30 symbols';

    try {
        username = document.getElementsByClassName('username')[0];
        username.addEventListener('input', usernameCheck);
        username.nextSibling.nextSibling.innerHTML = '3-30 symbols';

        confirm = document.getElementsByClassName('confirm')[0];
        confirm.addEventListener('input', passwordConfirmCheck);
        confirm.nextSibling.nextSibling.innerHTML = 'must be equal';

        email = document.getElementsByClassName('email')[0];
        email.addEventListener('input', emailCheck);
        email.nextSibling.nextSibling.innerHTML = 'not an e-mail';
    } catch(e) {}
}

window.addEventListener('load', load);
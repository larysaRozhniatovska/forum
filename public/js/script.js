function show(id) {
    let p = document.getElementById(id);
    p.setAttribute('type', 'text');
}

function hide(id) {
    let p = document.getElementById(id);
    p.setAttribute('type', 'password');
}
let id_pass = ['id-pass','id-regpass','id-reregpass'];
let pwShown = [false,false,false];
const eyeBlock = [
    document.getElementById("eye"),
    document.getElementById("eye-regpass"),
    document.getElementById("eye-reregpass")
];
for(let i = 0; i < 3; i++){
    if (eyeBlock[i]) {
        eyeBlock[i].addEventListener("click", function () {
            eyeBlock[i].classList.toggle("fa-eye-slash")
            eyeBlock[i].classList.toggle("fa-eye")

            pwShown[i] = !pwShown[i];

            if (pwShown[i]) {
                show(id_pass[i]);
            } else {
                hide(id_pass[i]);
            }
        }, false);
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const messageNoUser = document.getElementById("messageNoUser");
    if (messageNoUser) {
        setTimeout(function() {
            messageNoUser.classList.add('w3-hide');
        }, 3000);
    }
    const messageErrorsLogin = document.getElementById("errorsLogin");
    if (messageErrorsLogin) {
        setTimeout(function() {
            messageErrorsLogin.classList.add('w3-hide');
        }, 3000);
    }
    const messageErrorsAdd = document.getElementById("errorsAdd");
    if (messageErrorsAdd) {
        setTimeout(function() {
            messageErrorsAdd.classList.add('w3-hide');
        }, 3000);
    }
});
const startBox = document.getElementById('start-box');
const regBox = document.getElementById('register-box');
const callRegButton = document.getElementById('call-reg-box');
const callLoginButton = document.getElementById('call-login-box');
const callLoginButton2 = document.getElementById('call-login-box-2');
const loginTriggerButton = document.getElementById('login-trigger-button');
const bgv = document.getElementById('bgv');
const closeButton = document.getElementById('close-button');
const afterRegBox = document.getElementById('after-register-box');
const afterLoginBox = document.getElementById('after-login-box');
const closeButtonLogin = document.getElementById('close-button-login');
const goCourseButton = document.getElementById('go-courses');


var shownStart = true;
var shownReg = false;
var colored = true;

if (afterLoginBox !== null) {
    closeButtonLogin.addEventListener('click', ev => {
        hideElement(afterLoginBox);
    })
    goCourseButton.addEventListener('click', ev => {
        window.location = 'courses.php';
    })
}

if (afterRegBox !== null) {
    callLoginButton2.addEventListener('click', ev => {
        getLoginForm();
        colored = !colored;
        colorElement(bgv);
        hideElement(afterRegBox);
    })

    closeButton.addEventListener('click', ev => {
        hideElement(afterRegBox);
    })
}

if (loginTriggerButton !== null) {
    loginTriggerButton.addEventListener('click', ev => {
        shownStart = !shownStart;
        if (shownStart) {
            hideElement(startBox);
        } else {
            showElement(startBox);
        }
        if (shownReg) {
            hideElement(regBox);
            shownReg = !shownReg;
        }
    });

    loginTriggerButton.addEventListener('click', ev => {
        colored = !colored;
        if (colored) {
            grayElement(bgv);
        } else {
            colorElement(bgv);
        }
    });
}

function getRegForm() {
    // shownStart = !shownStart;
    shownReg = !shownReg;
    hideElement(startBox);
    showElement(regBox);
}

function getLoginForm() {
    // shownStart = !shownStart;
    shownReg = !shownReg;
    hideElement(regBox);
    showElement(startBox);
}

callRegButton.addEventListener('click', ev => {
    getRegForm();
})

callLoginButton.addEventListener('click', ev => {
    getLoginForm();
})
const ajax = new XMLHttpRequest();
const BASE_URL = window.location.origin
const AUTH_URL = BASE_URL + "/api/login"
const TOKEN = sessionStorage.getItem("token")

if (TOKEN) {
    window.location.replace(BASE_URL + "/")
}

function Auth() {
    let submit = document.getElementById("submit")
    let inputs = document.getElementsByTagName("input")
    submit.addEventListener("click", function(e) {
        var data = JSON.stringify({
            email: inputs[0].value,
            password: inputs[1].value,
        });
        ajax.onloadstart = function() {
            inputStatus(inputs, true)
            submit.setAttribute("disabled", "disabled")
        }
        ajax.onloadend = function() {
            inputStatus(inputs, false)
            submit.removeAttribute("disabled")
        }
        ajax.open("POST", AUTH_URL, true);
        ajax.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
        ajax.onload = function() {
            let response = JSON.parse(this.response)
            if (response.error) {
                let errors = response.error
                for (var key in errors) {
                    let err_element = document.getElementById(key + "-error")
                    err_element.classList.add("text-danger")
                    err_element.textContent = errors[key][0]
                }
            } else if (!response.success) {
                let err_element = document.getElementById("invalid")
                err_element.classList.add("text-danger")
                err_element.textContent = response.message
            } else {
                sessionStorage.setItem("token", response.token);
                window.location = BASE_URL;
            }
        };
        ajax.send(data);
    })
}

function inputStatus(inputs, status) {
    for (var i = 0; i < inputs.length; i++) {
        inputs[i].disabled = status;
    }
}
Auth()
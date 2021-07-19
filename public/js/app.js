const ajax = new XMLHttpRequest();
const BASE_URL = window.location.origin
const AUTH_URL = BASE_URL + "/api/login"
const TOKEN = sessionStorage.getItem("token");

if (!TOKEN) {
    window.location.replace(BASE_URL + "/login");
}

function signout() {
    let btn = document.getElementById("sign-out")
    sessionStorage.removeItem("token")
    window.location.replace(BASE_URL + "/login");
}

function inputStatus(status) {
    let inputs = document.getElementsByTagName("input")
    for (var i = 0; i < inputs.length; i++) {
        inputs[i].disabled = status;
    }
}


function formatRupiah(angka, prefix) {
    angka = angka.toString().substring(0, angka.toString().length - 5);
    // console.log(str)
    var number_string = angka.toString().replace(/[^,\d]/g, '').toString(),
        split = number_string.split(','),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);
    // tambahkan titik jika yang di input sudah menjadi angka ribuan
    if (ribuan) {
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }
    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
}


function showLoading(status) {
    $('body').loading(status);
}
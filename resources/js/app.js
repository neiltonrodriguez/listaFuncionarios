require('./bootstrap');

function alerta(icon, msg) {
    let time = 1000;
    if (icon === 'error')
        time = 4000;
    Swal.fire({
        position: 'top-end',
        icon: icon,
        title: msg,
        showConfirmButton: false,
        timer: time
    })
}
function MessageAlert(params) {
    Swal.fire({
        title: params[2],
        text: params[0],
        icon: params[1]
    });
}

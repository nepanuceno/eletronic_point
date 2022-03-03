function MessageAlert(params)
{
    let message = document.querySelector('#'+params[0]).textContent;

    if(params[1] == 'success') {
        type_message = params[2]
    } else if(params[1] == 'error') {
        type_message = params[2] + '!'
    }

    Swal.fire(
        type_message,
        message,
        params[1]
    )
}

var a = document.querySelectorAll('.disable-button')
a.forEach(element => {
    element.addEventListener('click', function disable(e) {
        let activeMsg = this.getAttribute('data-active')
        console.log(this.parentElement)
        e.preventDefault()
        Swal.fire({
            title: 'Deseja ' + activeMsg + ' este Servidor?',
            text: "Esta ação poderá ser revertida",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim, ' + activeMsg + '!'
        }).then((result) => {
            if (result.value) {
                this.parentElement.submit()
            } else {
                return false
            }
        })
    })
});

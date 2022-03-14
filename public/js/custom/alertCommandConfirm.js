var a = document.querySelectorAll('.disable-button')
a.forEach(element => {
    element.addEventListener('click', function disable(e) {
        let dataTitle = this.getAttribute('data-title')
        let dataText = this.getAttribute('data-text')
        let confirButtonText = this.getAttribute('confirm-button-text')
        let cancelButtonText = this.getAttribute('cancel-button-text')
        let icon = this.getAttribute('type-icon') ?? 'question';
        console.log(this.parentElement)
        e.preventDefault()
        Swal.fire({
            title: dataTitle,
            text: dataText,
            icon: icon,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: confirButtonText,
            cancelButtonText: cancelButtonText,
        }).then((result) => {
            if (result.value) {
                this.parentElement.submit()
            } else {
                return false
            }
        })
    })
});

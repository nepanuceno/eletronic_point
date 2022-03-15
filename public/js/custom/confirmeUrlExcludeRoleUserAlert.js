function confirmeUrlExcludeRoleUserAlert(context, params) {
    Swal.fire({
        title: params[2],
        text: params[3],
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: params[4],
        cancelButtonText: params[9]
    }).then((result) => {
        if (result.value) {

            fetch('delete_roles_user/'+params[0]+'/'+params[1]).then(function(response) {
                if(response.ok) {
                    Swal.fire(
                        params[5],
                        params[6],
                        'success'
                    )
                    context.remove();

                } else {
                  Swal.fire(
                    params[7],
                    params[8],
                    'error'
                  )
                }
            }).catch(function(error) {
                Swal.fire(
                    params[7],
                    error.message,
                    'error'
                  )
            });
        }
    });
}

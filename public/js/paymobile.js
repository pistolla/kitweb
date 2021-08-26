$('#mobile-payment').submit(handleSubmit());

function handleSubmit(event){
    event.preventDefault();
    var form = $(this);
    var formData = {
        "gateway": form.find('#gateway_id').val(),
        "trx": form.find("#trx_id").val(),
    };

    postRequest(formData);
}

function postRequest(data) {
    $.ajax({
        url: "/home/deposit-mpesa",
        type: "POST",
        data: data,
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        },
        success: postSuccess,
        error: postError
    });
}

function postSuccess(data, status, jqXhr) {
    Swal.fire({
        title: 'Please enter MPESA transaction code',
        input: 'text',
        inputAttributes: {
            autocapitalize: 'on'
        },
        showCancelButton: true,
        confirmButtonText: 'Send',
        showLoaderOnConfirm: true,
        preConfirm: (login) => {
            return fetch(login).then(response => {
                if(!response.ok){
                    throw new Error(response.statusText)
                }
                return response.json()
            })
            .catch(error => {
                Swal.showValidationMessage(`Request failed: ${error}`)
            })
        },
        allowOutsideClick: () => !Swal.isLoading()
    }).then((result) => {
        if(result.isConfirmed) {
            Swal.fire({
                title: `${result.value.login}'s avatar`,
                imageUrl: result.value.avatar_url
            })
        }
    })
}

function postError(jqXhr, status, errorThrown) {

}
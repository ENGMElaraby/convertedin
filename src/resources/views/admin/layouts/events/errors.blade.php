<script>
    @if(count($errors))
    swal({
        title: '<i>ERROR</i>',
        type: 'error',
        html: '<div class=\'alert alert-danger\'><ul> @foreach ($errors->all() as $error) <li>{{ $error }}</li> <br /> @endforeach </ul></div>',
        padding: '2em',
        target: document.getElementById('rtl-container')
    });
    @endif
    $(document).on("click", '.ask-delete',function () {
        let column_id = $(this).data("id");
        swal({
            title: "Are you sure",
            text: "really want delete",
            type: "warning",
            showCancelButton: !0,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes!",
            confirmButtonClass: "btn btn-primary",
            cancelButtonClass: "btn btn-danger ml-1",
            buttonsStyling: !1
        }).then(function (t) {
            t.value ?
                document.getElementById('destroy-form-'+column_id).submit()
                : t.dismiss === swal.DismissReason.cancel && swal({
                title: "Cancel",
                text: "Yes",
                type: "error",
                confirmButtonClass: "btn btn-success"
            })
        })
    });
</script>
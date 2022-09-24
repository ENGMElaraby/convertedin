<script>
    @if(session('alert'))
    swal({
        title: '<i>Good Work</i>',
        type: '{{ session('alert')['type'] }}',
        html: "{{ session('alert')['html'] }}",
        padding: '2em',
        target: document.getElementById('rtl-container')
    });
    @endif
</script>
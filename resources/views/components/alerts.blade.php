@if (session()->has('success'))
<script>
    Toastify({
        text: "{{ session()->get('success') }}",
        duration: 10000,
        newWindow: true,
        close: true,
        gravity: "top",
        position: "right",
        stopOnFocus: true,
        style: {
            background: "#68B984",
            color: "white",
            borderRadius: "2px",
            paddingX: "40px",
            marginTop: "45px",
            fontWeight: "bold",
            fontSize: "13px"
        },
        onClick: function() {}
    }).showToast();
</script>
@endif
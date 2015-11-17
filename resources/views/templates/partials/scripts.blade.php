<!-- jQuery -->
<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<!-- Compiled and minified JavaScript For Materialize CSS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/js/materialize.min.js"></script>
<!-- Sweetalert JS -->
<script src="/resources/assets/js/sweetalert.min.js"></script>
<script>
    $(document).ready(function () {
        // Activate the side menu
        $(".button-collapse").sideNav();

        // Activate Parallax on the home page
        $('.parallax').parallax();

        // Activate material select
        $('select').material_select();

        @if (notify()->ready())
            swal({
                title: "{!! notify()->message() !!}",
                text: "{!! notify()->option('text') !!}",
                type: "{{ notify()->type() }}",
                @if (notify()->option('timer'))
                    timer: {{ notify()->option('timer') }},
                    showConfirmButton: false,
                @endif
                allowEscapeKey: true,
                allowOutsideClick: true,
            });
        @endif
    });
</script>

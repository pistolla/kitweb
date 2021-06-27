@if (session('success'))
<script type="text/javascript">
    $(document).ready(function(){
        $.notify({
            allow_dismiss: true,
            title: "Success!",
            message: "{{ session('success') }}"
        });
    });
</script>
@endif

@if (session('alert'))
<script type="text/javascript">
    $(document).ready(function(){
        $.notify({
            allow_dismiss: true,
            title: "Sorry!",
            message: "{{ session('alert') }}"
        },{
            type: 'danger'
           });
    });
</script>
@endif



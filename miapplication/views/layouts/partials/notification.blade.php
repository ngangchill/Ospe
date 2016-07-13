@if(ci()->session->flashdata('info'))
<div id="flash-msg" class="alert alert-info alert-fixed-top">
    <p >{{ ci()->session->flashdata('info') }}</p>
</div>
@elseif(ci()->session->flashdata('success'))
<div id="flash-msg" class="alert alert-success alert-fixed-top">
    <p>{{ ci()->session->flashdata('success') }}</p>
</div>
@elseif(ci()->session->flashdata('warning'))
<div id="flash-msg" class="alert alert-warning alert-fixed-top">
    <p>{{ ci()->session->flashdata('warning') }}</p>
</div>
@elseif(ci()->session->flashdata('danger'))
<div id="flash-msg" class="alert alert-danger alert-fixed-top">
    <p>{{ ci()->session->flashdata('danger') }}</p>
</div>
@elseif(ci()->session->flashdata('error'))
<div id="flash-msg" class="alert alert-danger alert-fixed-top">
    <p>{{ ci()->session->flashdata('danger') }}</p>
</div>
@endif
<script type="text/javascript">
    setTimeout(function () {
        $('#flash-msg').fadeOut('slow');
    }, 3000);
</script>
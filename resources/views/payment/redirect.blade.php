<form id="cmi-form" action="{{ $cmiUrl }}" method="POST">
    @foreach ($data as $key => $value)
        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
    @endforeach
</form>
<script>
    document.getElementById('cmi-form').submit();
</script>

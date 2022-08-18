<script>
    if ( window.history.replaceState ) {
        console.log(window.history);
        window.history.replaceState( null, null, window.location.href );
    }
</script>
<?php
session_start();
@$_SESSION['zalogowany']=false;
session_destroy();


?>
<script>

setTimeout(function () {
   window.location.href= 'index.php'; // the redirect goes here

},1);

</script>
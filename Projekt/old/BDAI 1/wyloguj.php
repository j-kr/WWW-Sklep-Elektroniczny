<?php
session_start();
$_SESSION['zalogowany']=false;
echo'Wylogowano';

?>
<script>

setTimeout(function () {
   window.location.href= 'index.php'; // the redirect goes here

},2000);

</script>
<?php

$session = new Classes\ClassSessions();
$session->destructSessions();

echo 
"
<script>
    window.location.href='".DIRPAGE."';
</script>
";
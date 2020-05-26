<?php if(!empty($_SESSION['message'])){
    echo $_SESSION['message'];
    unset($_SESSION['message']);
} ?>

<form action="controller.php" method="post">
    <input type="text" name="title">
    <button>提交</button>
</form>
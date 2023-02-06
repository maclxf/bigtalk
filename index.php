<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>我是大话设计模式练习项目</title>
    <script>
        const p = new Promise((resolve, reject) => {
            resolve('成功结果')
        });

        const t = p.then((value) => {
            console.log('成功调用1', value)
            return kkkk;
        }, (reson) => {
            console.log('失败调用1', reson)
        });

        t.then((value) => {
            console.log('成功调用2', value)
        }, (error) => {
            console.log('失败调用2', error)
        });

        console.log(t)
    </script>
</head>
<body>
<?php
    phpinfo();
    echo '2023-02-06-1';
?>

</body>
</html>
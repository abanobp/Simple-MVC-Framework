<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> <?php $this->getHere("title");?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
     <?php $this->getHere("body");?>
     <?php $this->getHere("body");?>
     <?php $this->getHere("body");?>
     
     <?php $this->startSection("body2"); ?>
        <h1>Hello From Parent content<h2>
     <?php $this->showSection(); ?>
</body>
</html>
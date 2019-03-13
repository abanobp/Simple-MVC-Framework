
<?php $this->extend("Default"); ?>


<?php $this->startSection("body") ;?>
    <h1>
        Wellcome in My Home Page
    </h1>
<?php $this->stopSection() ;?>

<?php $this->startSection("body2") ;?>
    @parent@
    <h1>
        Wellcome in My Home Page
    </h1>
   
<?php $this->stopSection() ;?>
<?php $this->startSection("title" , "Home Page") ;?>
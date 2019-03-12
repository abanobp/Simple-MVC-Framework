<?php
class a 
{
 public function test()
    {
        echo "hello parent" ; 
    }
}

class b extends a
{
     function test()
    {
        echo "hello child" ; 
    }
}

$o = new b () ; 
$o->test() ; 
?>
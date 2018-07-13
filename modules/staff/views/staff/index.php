<?php
/* @var $this yii\web\View */


echo ((count(
    array_intersect(['VC_ROLE','COLLEGE_PRINCIPAL','DVC_AF_ROLE','REGISTRAR_PLANNING_ROLE','FINANCE_OFFICER_ROLE',],
        $r)
)));

echo '<pre>';print_r($r);echo'</pre>';


$a = ['VC_ROLE','COLLEGE_PRINCIPAL',];
$b = ['sssddd'];

print_r(array_merge($a,$b));

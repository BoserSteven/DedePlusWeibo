<?php
require_once("../../API/qqConnectAPI.php");
$qc = new QC();
$ret = $qc->qq_callback();
$ret2 = $qc->get_openid();
echo '<meta charset="utf-8">';
if(!$ret || !$ret2){
    echo '<script>';
    echo 'alert("授权失败!")';
    echo '</script>';
}else{
    $str = "<?php\n";
    $str .= "return array(\n";
    $str .= "'QC_userData' => array(\n
'state' => '{$_SESSION['QC_userData']['state']}',\n
'access_token' => '{$_SESSION['QC_userData']['access_token']}',\n
'openid' => '{$_SESSION['QC_userData']['openid']}',\n
),\n";
    $str .= ');';
    file_put_contents('../../QC_userData.php', $str);

    echo '<script>';
    echo 'alert("授权成功!")';
    echo '</script>';
}

<?php


    //΢��ͬ��
    if(file_exists('../plus/tencent_weibo/QC_userData.php') || file_exists('../plus/sina_weibo/sina_token.php')){
        $ret = GetOneArchive($arcID);
        $rdt_url = $cfg_basehost . $ret['arcurl'];//��ǰ���µ�����
        $content2 = "... ( �Ķ�ȫ�ģ�" . $rdt_url . ' )';
        $content = mb_substr(strip_tags(trim($body)), 0, 70, 'gbk') . $content2;
    }
    if(file_exists('../plus/tencent_weibo/QC_userData.php')){
        //��һ����Ѷ΢��
        require "../plus/tencent_weibo/API/qqConnectAPI.php";
        $ret = require '../plus/tencent_weibo/QC_userData.php';
        $_SESSION['QC_userData'] = $ret['QC_userData'];
        $qc = new QC();
        $arr = array(
            'img' => urlencode("http://imgcache.qq.com/QzonePortal_v2/city_v2/img/news_img/2011/0526/portal_new_1306376959_00375.jpg"),
            'type' => 1,
            'content' => iconv('GB2312', 'UTF-8', $content),
        );
        $ret = $qc->add_t($arr);
    }

    if(file_exists('../plus/sina_weibo/sina_token.php')){
        //��һ������΢��
        require '../plus/sina_weibo/config.php';
        $ret2 = require '../plus/sina_weibo/sina_token.php';
        $_SESSION['token'] = $ret2['token'];
        require '../plus/sina_weibo/saetv2.ex.class.php';
        $c = new SaeTClientV2( WB_AKEY , WB_SKEY , $_SESSION['token']['access_token'] );
        $ret2 = $c->update( iconv('GB2312', 'UTF-8', $content) );   //����΢��
    }

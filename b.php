<?php
//*************************** 信息 ***************************

//增加投票
function AddInfoVote($classid,$id,$add){
    global $empire,$dbtbpre,$class_r;
    $pubid=ReturnInfoPubid($classid,$id);
    $num=$empire->gettotal("select count(*) as total from {$dbtbpre}enewsinfovote where pubid='$pubid' limit 1");
    $votename=$add['vote_name'];
    $votenum=$add['vote_num'];
    //统计总票数
    for($i=0;$i<count($votename);$i++)
    {
        $t_votenum+=$votenum[$i];
    }
    $t_votenum=(int)$t_votenum;
    $voteclass=(int)$add['vote_class'];
    $width=(int)$add['vote_width'];
    $height=(int)$add['vote_height'];
    $doip=(int)$add['dovote_ip'];
    $tempid=(int)$add['vote_tempid'];
    $add['vote_title']=hRepPostStr($add['vote_title'],1);
    $add['vote_dotime']=hRepPostStr($add['vote_dotime'],1);
    //附加字段
    $diyotherlink=(int)$add['info_diyotherlink'];
    $infouptime=0;
    if($add['info_infouptime'])
    {
        $infouptime=to_time($add['info_infouptime']);
    }
    $infodowntime=0;
    if($add['info_infodowntime'])
    {
        $infodowntime=to_time($add['info_infodowntime']);
    }
    if($num)	//修改
    {
        $votetext=ReturnVote($add['vote_name'],$add['vote_num'],$add['delvote_id'],$add['vote_id'],1);	//返回组合
        $votetext=hRepPostStr($votetext,1);
        $sql=$empire->query("update {$dbtbpre}enewsinfovote set title='$add[vote_title]',votenum='$t_votenum',votetext='$votetext',voteclass='$voteclass',doip='$doip',dotime='$add[vote_dotime]',tempid='$tempid',width='$width',height='$height',diyotherlink='$diyotherlink',infouptime='$infouptime',infodowntime='$infodowntime' where pubid='$pubid' limit 1");
    }
    else	//增加
    {
        $votetext=ReturnVote($add['vote_name'],$add['vote_num'],$add['delvote_id'],$add['vote_id'],0);	//返回组合
        if(!($votetext||$diyotherlink||$infouptime||$infodowntime))
        {
            return '';
        }
        $votetext=hRepPostStr($votetext,1);
        $sql=$empire->query("insert into {$dbtbpre}enewsinfovote(pubid,id,classid,title,votenum,voteip,votetext,voteclass,doip,dotime,tempid,width,height,diyotherlink,infouptime,infodowntime,copyids) values('$pubid','$id','$classid','$add[vote_title]','$t_votenum','','$votetext','$voteclass','$doip','$add[vote_dotime]','$tempid','$width','$height','$diyotherlink','$infouptime','$infodowntime','');");
    }
}

//更新同时发布
function UpdateInfoCopyids($classid,$id,$copyids){
    global $empire,$dbtbpre,$class_r;
    $pubid=ReturnInfoPubid($classid,$id);
    $num=$empire->gettotal("select count(*) as total from {$dbtbpre}enewsinfovote where pubid='$pubid' limit 1");
    if($num)	//修改
    {
        $empire->query("update {$dbtbpre}enewsinfovote set copyids='$copyids' where pubid='$pubid' limit 1");
    }
    else	//增加
    {
        $empire->query("insert into {$dbtbpre}enewsinfovote(pubid,id,classid,copyids) values('$pubid','$id','$classid','$copyids');");
    }
}

//返回标题是否重复
function ReturnCheckRetitle($add){
    global $empire,$dbtbpre,$class_r;
    $classid=(int)$add['classid'];
    $id=(int)$add['id'];
    $title=AddAddsData($add['title']);
    $where='';
    if($id)
    {
        $where=' and id<>'.$id;
    }
    //已审核
    $num=$empire->gettotal("select count(*) as total from {$dbtbpre}ecms_".$class_r[$classid][tbname]." where title='".addslashes($title)."'".$where." limit 1");
    //未审核
    if(empty($num))
    {
        $num=$empire->gettotal("select count(*) as total from {$dbtbpre}ecms_".$class_r[$classid][tbname]."_check where title='".addslashes($title)."'".$where." limit 1");
    }
    return $num;
}

//AJAX验证标题是否重复
function CheckReTitleAjax($add){
    if(ReturnCheckRetitle($add))
    {
        echo 1;
    }
    else
    {
        echo 0;
    }
}

//增加信息处理变量
function DoPostInfoVar($add){
    global $class_r;
    //组合标题属性
    $add[titlecolor]=RepPhpAspJspcodeText($add[titlecolor]);
    $add['my_titlefont']=TitleFont($add[titlefont],$add[titlecolor]);
    //专题
    $add['ztids']=RepPostVar($add['ztids']);
    $add['zcids']=RepPostVar($add['zcids']);
    $add['oldztids']=RepPostVar($add['oldztids']);
    $add['oldzcids']=RepPostVar($add['oldzcids']);
    //其它变量
    $add[keyboard]=RepPhpAspJspcodeText(DoReplaceQjDh($add[keyboard]));
    $add[titleurl]=RepPhpAspJspcodeText($add[titleurl]);
    $add[checked]=(int)$add[checked];
    $add[istop]=(int)$add[istop];
    $add[dokey]=(int)$add[dokey];
    $add[isgood]=(int)$add[isgood];
    $add[groupid]=(int)$add[groupid];
    $add[newstempid]=(int)$add[newstempid];
    $add[firsttitle]=(int)$add[firsttitle];
    $add[userfen]=(int)$add[userfen];
    $add[closepl]=(int)$add[closepl];
    $add[ttid]=(int)$add[ttid];
    $add[oldttid]=(int)$add[oldttid];
    $add[onclick]=(int)$add[onclick];
    $add[totaldown]=(int)$add[totaldown];
    $add[infotags]=RepPhpAspJspcodeText(DoReplaceQjDh($add[infotags]));
    $add[ispic]=$add[titlepic]?1:0;
    $add[filename]=RepFilenameQz($add[filename],1);
    $add[newspath]=RepFilenameQz($add[newspath],1);
    $add['isurl']=$add['titleurl']?1:0;
    return $add;
}

//相关链接ID处理
function DoPostDiyOtherlinkID($keyid){
    if(!$keyid||$keyid==',')
    {
        return '';
    }
    $new_keyid='';
    $dh='';
    $r=explode(',',$keyid);
    $count=count($r);
    for($i=0;$i<$count;$i++)
    {
        $r[$i]=(int)$r[$i];
        if(!$r[$i])
        {
            continue;
        }
        $new_keyid.=$dh.$r[$i];
        $dh=',';
    }
    return $new_keyid;
}

//增加信息
function AddNews($add,$userid,$username){

    global $empire,$class_r,$class_zr,$bclassid,$public_r,$dbtbpre,$emod_r;
    $add[classid]=(int)$add[classid];
    $userid=(int)$userid;
    if(!$add[title]||!$add[classid])
    {
        printerror("EmptyTitle","history.go(-1)");
    }
    //操作权限
    $doselfinfo=CheckLevel($userid,$username,$add[classid],"news");
    if(!$doselfinfo['doaddinfo'])//增加权限
    {
        printerror("NotAddInfoLevel","history.go(-1)");
    }
    $ccr=$empire->fetch1("select classid,modid,listdt,haddlist,sametitle,addreinfo,wburl,repreinfo from {$dbtbpre}enewsclass where classid='$add[classid]' and islast=1 limit 1");
    if(!$ccr['classid']||$ccr['wburl'])
    {
        printerror("ErrorUrl","history.go(-1)");
    }
    if($ccr['sametitle'])//验证标题重复
    {
        if(ReturnCheckRetitle($add))
        {
            printerror("ReInfoTitle","history.go(-1)");
        }
    }
    $add=DoPostInfoVar($add);//返回变量
    $ret_r=ReturnAddF($add,$class_r[$add[classid]][modid],$userid,$username,0,0,1);//返回自定义字段
    $newspath=FormatPath($add[classid],$add[newspath],1);//查看目录是否存在，不存在则建立
    //审核权限
    if(!$doselfinfo['docheckinfo'])
    {
        $add['checked']=$class_r[$add[classid]][checked];
    }
    //必须审核
    if($doselfinfo['domustcheck'])
    {
        $add['checked']=0;
    }
    //推荐权限
    if(!$doselfinfo['dogoodinfo'])
    {
        $add['isgood']=0;
        $add['firsttitle']=0;
        $add['istop']=0;
    }
    //签发
    $isqf=0;
    if($class_r[$add[classid]][wfid])
    {
        $add[checked]=0;
        $isqf=1;
    }
    $newstime=empty($add['newstime'])?time():to_time($add['newstime']);
    $truetime=time();
    $lastdotime=$truetime;
    //是否生成
    $havehtml=0;
    if($add['checked']==1&&$ccr['addreinfo'])
    {
        $havehtml=1;
    }
    //返回关键字组合
    if($add['info_diyotherlink'])
    {
        $keyid=DoPostDiyOtherlinkID($add['info_keyid']);
    }
    else
    {
        $keyid=GetKeyid($add[keyboard],$add[classid],0,$class_r[$add[classid]][link_num]);
    }
    //附加链接参数
    $addecmscheck=empty($add['checked'])?'&ecmscheck=1':'';
    //索引表


    $sql=$empire->query("insert into {$dbtbpre}ecms_".$class_r[$add[classid]][tbname]."_index(classid,checked,newstime,truetime,lastdotime,havehtml) values('$add[classid]','$add[checked]','$newstime','$truetime','$lastdotime','$havehtml');");
    $id=$empire->lastid();
    $pubid=ReturnInfoPubid($add['classid'],$id);
    $infotbr=ReturnInfoTbname($class_r[$add[classid]][tbname],$add['checked'],$ret_r['tb']);
    //主表



    $expsto = $empire->fetch1("select * from stoexpressnumber where status = 0 limit 1");
    if($expsto) {
        $ret_r['title']=$expsto['number'];
        var_dump ($ret_r);
        exit;
        $b = $expsto['id'];
        $status = $empire->query("update stoexpressnumber set status = 1 where id =$b ");

    }
    $infosql=$empire->query("insert into ".$infotbr['tbname']."(id,classid,ttid,onclick,plnum,totaldown,newspath,filename,userid,username,firsttitle,isgood,ispic,istop,isqf,ismember,isurl,truetime,lastdotime,havehtml,groupid,userfen,titlefont,titleurl,stb,fstb,restb,keyboard".$ret_r['fields'].") values('$id','$add[classid]','$add[ttid]','$add[onclick]',0,'$add[totaldown]','$newspath','$filename','$userid','".addslashes($username)."','$add[firsttitle]','$add[isgood]','$add[ispic]','$add[istop]','$isqf',0,'$add[isurl]','$truetime','$lastdotime','$havehtml','$add[groupid]','$add[userfen]','".addslashes($add[my_titlefont])."','".addslashes($add[titleurl])."','$ret_r[tb]','$public_r[filedeftb]','$public_r[pldeftb]','".addslashes($add[keyboard])."'".$ret_r['values'].");");

    //副表
    $finfosql=$empire->query("insert into ".$infotbr['datatbname']."(id,classid,keyid,dokey,newstempid,closepl,haveaddfen,infotags".$ret_r['datafields'].") values('$id','$add[classid]','$keyid','$add[dokey]','$add[newstempid]','$add[closepl]',0,'".addslashes($add[infotags])."'".$ret_r['datavalues'].");");
    //更新栏目信息数
    AddClassInfos($add['classid'],'+1','+1',$add['checked']);
    //更新新信息数
    DoUpdateAddDataNum('info',$class_r[$add['classid']]['tid'],1);
    //签发
    if($isqf==1)
    {
        InfoInsertToWorkflow($id,$add[classid],$class_r[$add[classid]][wfid],$userid,$username);
    }
    //更新附件表
    UpdateTheFile($id,$add['filepass'],$add['classid'],$public_r['filedeftb']);
    //取第一张图作为标题图片
    if($add['getfirsttitlepic']&&empty($add['titlepic']))
    {
        $firsttitlepic=GetFpicToTpic($add['classid'],$id,$add['getfirsttitlepic'],$add['getfirsttitlespic'],$add['getfirsttitlespicw'],$add['getfirsttitlespich'],$public_r['filedeftb']);
        if($firsttitlepic)
        {
            $addtitlepic=",titlepic='".addslashes($firsttitlepic)."',ispic=1";
        }
    }
    //文件命名
    if($add['filename'])
    {
        $filename=$add['filename'];
    }
    else
    {
        $filename=ReturnInfoFilename($add[classid],$id,'');
    }
    //信息地址
    $updateinfourl='';
    if(!$add['isurl'])
    {
        $infourl=GotoGetTitleUrl($add['classid'],$id,$newspath,$filename,$add['groupid'],$add['isurl'],$add['titleurl']);
        $updateinfourl=",titleurl='$infourl'";
    }
    $usql=$empire->query("update ".$infotbr['tbname']." set filename='$filename'".$updateinfourl.$addtitlepic." where id='$id'");
    //替换图片下一页
    if($add['repimgnexturl'])
    {
        UpdateImgNexturl($add[classid],$id,$add['checked']);
    }
    //投票
    AddInfoVote($add['classid'],$id,$add);
    //加入专题
    InsertZtInfo($add['ztids'],$add['zcids'],$add['oldztids'],$add['oldzcids'],$add['classid'],$id,$newstime);
    //TAGS
    if($add[infotags]&&$add[infotags]<>$add[oldinfotags])
    {
        eInsertTags($add[infotags],$add['classid'],$id,$newstime);
    }
    //增加信息是否生成文件
    if($ccr['addreinfo']&&$add['checked'])
    {
        GetHtml($add['classid'],$id,'',0);
    }
    //生成上一篇
    if($ccr['repreinfo']&&$add['checked'])
    {
        $prer=$empire->fetch1("select * from {$dbtbpre}ecms_".$class_r[$add[classid]][tbname]." where id<$id and classid='$add[classid]' order by id desc limit 1");
        GetHtml($add['classid'],$prer['id'],$prer,1);
    }
    //生成栏目
    if($ccr['haddlist']&&$add['checked'])
    {
        hAddListHtml($add['classid'],$ccr['modid'],$ccr['haddlist'],$ccr['listdt']);//生成信息列表
        if($add['ttid'])//生成标题分类列表
        {
            ListHtml($add['ttid'],'',5);
        }
    }
    //同时发布
    $copyclassid=$add[copyclassid];
    $cpcount=count($copyclassid);
    if($cpcount)
    {
        $copyids=AddInfoToCopyInfo($add[classid],$id,$copyclassid,$userid,$username,$doselfinfo);
        if($copyids)
        {
            UpdateInfoCopyids($add['classid'],$id,$copyids);
        }
    }
    if($sql)
    {
        //返回地址
        if($add['ecmsfrom']&&(stristr($add['ecmsfrom'],'ListNews.php')||stristr($add['ecmsfrom'],'ListAllInfo.php')))
        {
            $ecmsfrom=$add['ecmsfrom'];
        }
        else
        {
            $ecmsfrom=$add['ecmsnfrom']==1?"ListNews.php?bclassid=$add[bclassid]&classid=$add[classid]":"ListAllInfo.php?tbname=".$class_r[$add[classid]][tbname];
            $ecmsfrom.=hReturnEcmsHashStrHref2(0);
        }
        $GLOBALS['ecmsadderrorurl']=$ecmsfrom.$addecmscheck;
        insert_dolog("classid=$add[classid]<br>id=".$id."<br>title=".$add[title],$pubid);//操作日志
        printerror("AddNewsSuccess","/e/extend/caozuo/dayin.php?id=$id&classid=$add[classid]".$addecmscheck.hReturnEcmsHashStrHref2(0));
    }
    else
    {
        printerror("DbError","");
    }
}

//修改信息
function EditNews($add,$userid,$username){
    global $empire,$class_r,$class_zr,$bclassid,$public_r,$dbtbpre,$emod_r;
    $add[classid]=(int)$add[classid];
    $userid=(int)$userid;
    $add[id]=(int)$add[id];
    if(!$add[id]||!$add[title]||!$add[classid]||!$add[filename])
    {
        printerror("EmptyTitle","history.go(-1)");
    }
    $doselfinfo=CheckLevel($userid,$username,$add[classid],"news");//操作权限
    if(!$doselfinfo['doeditinfo'])//编辑权限
    {
        printerror("NotEditInfoLevel","history.go(-1)");
    }
    $ccr=$empire->fetch1("select classid,modid,listdt,haddlist,sametitle,addreinfo,wburl,repreinfo from {$dbtbpre}enewsclass where classid='$add[classid]' and islast=1 limit 1");
    if(!$ccr['classid']||$ccr['wburl'])
    {
        printerror("ErrorUrl","history.go(-1)");
    }
    //索引表
    $index_checkr=$empire->fetch1("select id,classid,checked from {$dbtbpre}ecms_".$class_r[$add[classid]][tbname]."_index where id='$add[id]' limit 1");
    if(!$index_checkr['id']||$index_checkr['classid']!=$add['classid'])
    {
        printerror("ErrorUrl","history.go(-1)");
    }
    //主表
    $infotb=ReturnInfoMainTbname($class_r[$add[classid]][tbname],$index_checkr['checked']);
    $checkr=$empire->fetch1("select id,classid,userid,username,ismember,stb,newspath,filename,isqf,fstb,isgood,firsttitle,istop from ".$infotb." where id='$add[id]' limit 1");
    if($doselfinfo['doselfinfo']&&($checkr['userid']<>$userid||$checkr['ismember']))//只能编辑自己的信息
    {
        printerror("NotDoSelfinfo","history.go(-1)");
    }
    //已审核信息不可修改
    if($doselfinfo['docheckedit']&&$index_checkr['checked'])
    {
        printerror("NotEditCheckInfoLevel","history.go(-1)");
    }
    //审核权限
    if(!$doselfinfo['docheckinfo'])
    {
        $add['checked']=$index_checkr['checked'];
    }
    //必须审核
    if($doselfinfo['domustcheck']&&!$index_checkr['checked'])
    {
        $add['checked']=0;
    }
    //推荐权限
    if(!$doselfinfo['dogoodinfo'])
    {
        $add['isgood']=$checkr['isgood'];
        $add['firsttitle']=$checkr['firsttitle'];
        $add['istop']=$checkr['istop'];
    }
    if($ccr['sametitle'])//验证标题重复
    {
        if(ReturnCheckRetitle($add))
        {
            printerror("ReInfoTitle","history.go(-1)");
        }
    }
    //公共表
    $pubid=ReturnInfoPubid($add['classid'],$add['id']);
    $pubcheckr=$empire->fetch1("select copyids from {$dbtbpre}enewsinfovote where pubid='$pubid' limit 1");
    $mid=$class_r[$add[classid]][modid];
    $pf=$emod_r[$mid]['pagef'];
    $add=DoPostInfoVar($add);//返回变量
    $add['fstb']=$checkr['fstb'];
    $ret_r=ReturnAddF($add,$class_r[$add[classid]][modid],$userid,$username,1,0,1);//返回自定义字段
    $deloldfile=0;
    if($add[groupid]<>$add[oldgroupid]||($index_checkr['checked']&&!$add[checked]))//改变文件权限
    {
        DelNewsFile($checkr[filename],$checkr[newspath],$add[classid],$add[$pf],$add[oldgroupid]);//删除旧的文件
        $deloldfile=1;
    }
    //签发
    $newchecked=$index_checkr['checked'];
    $a='';
    if($class_r[$add[classid]][wfid]&&$checkr['isqf'])
    {
        $qfr=$empire->fetch1("select checktno from {$dbtbpre}enewswfinfo where id='$add[id]' and classid='$add[classid]' limit 1");
        if($qfr['checktno']=='100')//已通过
        {
            $aqf=",checked='$add[checked]'";
            $newchecked=$add[checked];
        }
        else
        {
            if($add[reworkflow])
            {
                InfoUpdateToWorkflow($add[id],$add[classid],$class_r[$add[classid]][wfid],$userid,$username);
            }
            $aqf='';
        }
    }
    else
    {
        $aqf=",checked='$add[checked]'";
        $newchecked=$add[checked];
    }
    //日期目录
    $updatefile='';
    $urlnewspath=$checkr['newspath'];
    if($add['newspath']!=$checkr[newspath])
    {
        $add[newspath]=FormatPath($add[classid],$add[newspath],1);//查看目录是否存在，不存在则建立
        $updatefile.=",newspath='$add[newspath]'";
        if($deloldfile==0)
        {
            DelNewsFile($checkr[filename],$checkr[newspath],$add[classid],$add[$pf],$add[oldgroupid]);//删除旧文件
            $deloldfile=1;
        }
        $urlnewspath=$add['newspath'];
    }
    //文件名
    $urlfilename=$checkr['filename'];
    if($add['filename']&&$add['filename']!=$checkr[filename])
    {
        $newfilename=$add['filename'];
        $updatefile.=",filename='$newfilename'";
        if($deloldfile==0)
        {
            DelNewsFile($checkr[filename],$checkr[newspath],$add[classid],$add[$pf],$add[oldgroupid]);//删除旧文件
            $deloldfile=1;
        }
        $urlfilename=$newfilename;
    }
    $newstime=empty($add['newstime'])?time():to_time($add['newstime']);
    $lastdotime=time();
    //返回关键字组合
    if($add['info_diyotherlink'])
    {
        $keyid=DoPostDiyOtherlinkID($add['info_keyid']);
    }
    else
    {
        $keyid=GetKeyid($add[keyboard],$add[classid],$add[id],$class_r[$add[classid]][link_num]);
    }
    //附加链接参数
    $addecmscheck=empty($newchecked)?'&ecmscheck=1':'';
    //信息地址
    $infourl=GotoGetTitleUrl($add['classid'],$add['id'],$urlnewspath,$urlfilename,$add['groupid'],$add['isurl'],$add['titleurl']);
    //返回表信息
    $infotbr=ReturnInfoTbname($class_r[$add[classid]][tbname],$index_checkr['checked'],$checkr['stb']);
    //索引表
    $indexsql=$empire->query("update {$dbtbpre}ecms_".$class_r[$add[classid]][tbname]."_index set newstime='$newstime',lastdotime='$lastdotime'".$aqf." where id='$add[id]' limit 1");
    //主表
    $sql=$empire->query("update ".$infotbr['tbname']." set classid='$add[classid]',ttid='$add[ttid]',onclick='$add[onclick]',totaldown='$add[totaldown]',firsttitle=$add[firsttitle],isgood=$add[isgood],ispic='$add[ispic]',istop=$add[istop],isurl='$add[isurl]',lastdotime=$lastdotime,groupid=$add[groupid],userfen=$add[userfen],titlefont='".addslashes($add[my_titlefont])."',titleurl='".addslashes($infourl)."',keyboard='".addslashes($add[keyboard])."'".$updatefile.$ret_r[values]." where id='$add[id]' limit 1");
    //副表
    $stb=$checkr['stb'];
    $fsql=$empire->query("update ".$infotbr['datatbname']." set classid='$add[classid]',keyid='$keyid',dokey=$add[dokey],newstempid=$add[newstempid],closepl=$add[closepl],infotags='".addslashes($add[infotags])."'".$ret_r[datavalues]." where id='$add[id]' limit 1");
    //取第一张图作为标题图片
    if($add['getfirsttitlepic']&&empty($add['titlepic']))
    {
        $firsttitlepic=GetFpicToTpic($add['classid'],$add['id'],$add['getfirsttitlepic'],$add['getfirsttitlespic'],$add['getfirsttitlespicw'],$add['getfirsttitlespich'],$checkr['fstb']);
        if($firsttitlepic)
        {
            $usql=$empire->query("update ".$infotbr['tbname']." set titlepic='".addslashes($firsttitlepic)."',ispic=1 where id='$add[id]'");
        }
    }
    //更新附件
    UpdateTheFileEdit($add['classid'],$add['id'],$checkr['fstb']);
    //替换图片下一页
    if($add['repimgnexturl'])
    {
        UpdateImgNexturl($add['classid'],$add['id'],$index_checkr['checked']);
    }
    //投票
    AddInfoVote($add['classid'],$add['id'],$add);
    //写入专题
    InsertZtInfo($add['ztids'],$add['zcids'],$add['oldztids'],$add['oldzcids'],$add['classid'],$add['id'],$newstime);
    //TAGS
    if($add[infotags]&&$add[infotags]<>$add[oldinfotags])
    {
        eInsertTags($add[infotags],$add['classid'],$add['id'],$newstime);
    }
    //是否改变审核状态
    if($index_checkr['checked']!=$newchecked)
    {
        MoveCheckInfoData($class_r[$add[classid]][tbname],$index_checkr['checked'],$checkr['stb'],"id='$add[id]'");
        //更新栏目信息数
        if($newchecked)
        {
            AddClassInfos($add['classid'],'','+1');
        }
        else
        {
            AddClassInfos($add['classid'],'','-1');
        }
    }
    //生成文件
    if($ccr['addreinfo']&&$newchecked)
    {
        GetHtml($add['classid'],$add['id'],'',0);
    }
    //生成上一篇
    if($ccr['repreinfo']&&($newchecked||$newchecked<>$add[oldchecked]))
    {
        $prer=$empire->fetch1("select * from {$dbtbpre}ecms_".$class_r[$add[classid]][tbname]." where id<$add[id] and classid='$add[classid]' order by id desc limit 1");
        GetHtml($prer['classid'],$prer['id'],$prer,1);
    }
    //生成栏目
    if($ccr['haddlist']&&($newchecked||$newchecked<>$add[oldchecked]))
    {
        hAddListHtml($add[classid],$ccr['modid'],$ccr['haddlist'],$ccr['listdt']);//生成信息列表
        if($add['ttid'])//生成标题分类列表
        {
            ListHtml($add['ttid'],'',5);
        }
        //改变标题分类
        if($add['oldttid']&&$add['ttid']<>$add['oldttid'])
        {
            ListHtml($add['oldttid'],'',5);
        }
    }
    //同时更新
    if($pubcheckr['copyids']&&$pubcheckr['copyids']<>'1')
    {
        EditInfoToCopyInfo($add[classid],$add[id],$userid,$username,$doselfinfo);
    }
    else
    {
        $copyclassid=$add[copyclassid];
        $cpcount=count($copyclassid);
        if($cpcount)
        {
            $copyids=AddInfoToCopyInfo($add[classid],$add[id],$copyclassid,$userid,$username,$doselfinfo);
            if($copyids)
            {
                UpdateInfoCopyids($add['classid'],$add['id'],$copyids);
            }
        }
    }
    if($sql)
    {
        //返回地址
        if($add['ecmsfrom']&&(stristr($add['ecmsfrom'],'ListNews.php')||stristr($add['ecmsfrom'],'ListAllInfo.php')))
        {
            $ecmsfrom=$add['ecmsfrom'];
        }
        else
        {
            $ecmsfrom="ListNews.php?bclassid=$add[bclassid]&classid=$add[classid]".hReturnEcmsHashStrHref2(0);
        }
        insert_dolog("classid=$add[classid]<br>id=".$add[id]."<br>title=".$add[title],$pubid);//操作日志
        printerror("EditNewsSuccess",$ecmsfrom.$addecmscheck);
    }
    else
    {
        printerror("DbError","history.go(-1)");
    }
}

//修改信息(快速)
function EditInfoSimple($add,$userid,$username){
    global $empire,$class_r,$class_zr,$bclassid,$public_r,$dbtbpre,$emod_r;
    $add[classid]=(int)$add[classid];
    $userid=(int)$userid;
    $add[id]=(int)$add[id];
    $closeurl='info/EditInfoSimple.php?isclose=1&reload=1'.hReturnEcmsHashStrHref2(0);
    if(!$add[id]||!$add[title]||!$add[classid])
    {
        printerror("EmptyTitle","history.go(-1)",8);
    }
    $doselfinfo=CheckLevel($userid,$username,$add[classid],"news");//操作权限
    if(!$doselfinfo['doeditinfo'])//编辑权限
    {
        printerror("NotEditInfoLevel","history.go(-1)",8);
    }
    $ccr=$empire->fetch1("select classid,modid,listdt,haddlist,sametitle,addreinfo,wburl,repreinfo from {$dbtbpre}enewsclass where classid='$add[classid]' and islast=1 limit 1");
    if(!$ccr['classid']||$ccr['wburl'])
    {
        printerror("ErrorUrl","history.go(-1)",8);
    }
    //索引表
    $index_checkr=$empire->fetch1("select id,classid,checked from {$dbtbpre}ecms_".$class_r[$add[classid]][tbname]."_index where id='$add[id]' limit 1");
    if(!$index_checkr['id']||$index_checkr['classid']!=$add['classid'])
    {
        printerror("ErrorUrl","history.go(-1)",8);
    }
    //主表
    $infotb=ReturnInfoMainTbname($class_r[$add[classid]][tbname],$index_checkr['checked']);
    $checkr=$empire->fetch1("select id,classid,userid,username,ismember,stb,newspath,filename,isqf,fstb,isgood,firsttitle,istop,groupid from ".$infotb." where id='$add[id]' limit 1");
    if($doselfinfo['doselfinfo']&&($checkr['userid']<>$userid||$checkr['ismember']))//只能编辑自己的信息
    {
        printerror("NotDoSelfinfo","history.go(-1)",8);
    }
    //已审核信息不可修改
    if($doselfinfo['docheckedit']&&$index_checkr['checked'])
    {
        printerror("NotEditCheckInfoLevel","history.go(-1)");
    }
    //审核权限
    if(!$doselfinfo['docheckinfo'])
    {
        $add['checked']=$index_checkr['checked'];
    }
    //必须审核
    if($doselfinfo['domustcheck']&&!$index_checkr['checked'])
    {
        $add['checked']=0;
    }
    //推荐权限
    if(!$doselfinfo['dogoodinfo'])
    {
        $add['isgood']=$checkr['isgood'];
        $add['firsttitle']=$checkr['firsttitle'];
        $add['istop']=$checkr['istop'];
    }
    if($ccr['sametitle'])//验证标题重复
    {
        if(ReturnCheckRetitle($add))
        {
            printerror("ReInfoTitle","history.go(-1)",8);
        }
    }
    //公共表
    $pubid=ReturnInfoPubid($add['classid'],$add['id']);
    $pubcheckr=$empire->fetch1("select copyids from {$dbtbpre}enewsinfovote where pubid='$pubid' limit 1");
    $mid=$class_r[$add[classid]][modid];
    $pf=$emod_r[$mid]['pagef'];
    $add=DoPostInfoVar($add);//返回变量
    //签发
    $newchecked=$index_checkr['checked'];
    $a="";
    if($class_r[$add[classid]][wfid]&&$checkr['isqf'])
    {
        $qfr=$empire->fetch1("select checktno from {$dbtbpre}enewswfinfo where id='$add[id]' and classid='$add[classid]' limit 1");
        if($qfr['checktno']=='100')//已通过
        {
            $aqf=",checked='$add[checked]'";
            $newchecked=$add[checked];
        }
        else
        {
            if($add[reworkflow])
            {
                InfoUpdateToWorkflow($add[id],$add[classid],$class_r[$add[classid]][wfid],$userid,$username);
            }
            $aqf='';
        }
    }
    else
    {
        $aqf=",checked='$add[checked]'";
        $newchecked=$add[checked];
    }
    $lastdotime=time();
    //发布时间
    $newstime=empty($add['newstime'])?time():to_time($add['newstime']);
    //附加链接参数
    $addecmscheck=empty($newchecked)?'&ecmscheck=1':'';
    //信息地址
    $infourl=GotoGetTitleUrl($add['classid'],$add['id'],$checkr['newspath'],$checkr['filename'],$checkr['groupid'],$add['isurl'],$add['titleurl']);
    //返回表信息
    $infotbr=ReturnInfoTbname($class_r[$add[classid]][tbname],$index_checkr['checked'],$checkr['stb']);
    //索引表
    $indexsql=$empire->query("update {$dbtbpre}ecms_".$class_r[$add[classid]][tbname]."_index set newstime='$newstime',lastdotime='$lastdotime'".$aqf." where id='$add[id]' limit 1");
    //主表
    $expsql=$empire->query("select * from stoexpressmunber where status = 0  limit 1");
    echo $expsql;
    exit;
    if($expsql){
        $expupdatesql=$empire->query("update stoexpressmunber set status = 1 WHERE id = $expsql->id");
        echo $expupdatesql;
        exit;
    }

    $sql=$empire->query("update ".$infotbr['tbname']." set classid='$add[classid]',ttid='$add[ttid]',onclick='$add[onclick]',totaldown='$add[totaldown]',firsttitle='$add[firsttitle]',isgood='$add[isgood]',ispic='$add[ispic]',istop='$add[istop]',isurl='$add[isurl]',lastdotime='$lastdotime',titlefont='".addslashes($add[my_titlefont])."',titleurl='".addslashes($infourl)."',title='$expsql->number',titlepic='".addslashes($add[titlepic])."',newstime='$newstime' where id='$add[id]' limit 1");
    //副表
    $fsql=$empire->query("update ".$infotbr['datatbname']." set classid='$add[classid]',closepl='$add[closepl]'".$ret_r[datavalues]." where id='$add[id]' limit 1");
    //更新附件
    UpdateTheFileEdit($add['classid'],$add['id'],$checkr['fstb']);
    //是否改变审核状态
    if($index_checkr['checked']!=$newchecked)
    {
        MoveCheckInfoData($class_r[$add[classid]][tbname],$index_checkr['checked'],$checkr['stb'],"id='$add[id]'");
        //更新栏目信息数
        if($newchecked)
        {
            AddClassInfos($add['classid'],'','+1');
        }
        else
        {
            AddClassInfos($add['classid'],'','-1');
        }
    }
    //生成文件
    if($ccr['addreinfo']&&$newchecked)
    {
        GetHtml($add['classid'],$add['id'],'',0);
    }
    //生成上一篇
    if($ccr['repreinfo']&&($newchecked||$newchecked<>$add[oldchecked]))
    {
        $prer=$empire->fetch1("select * from {$dbtbpre}ecms_".$class_r[$add[classid]][tbname]." where id<$add[id] and classid='$add[classid]' order by id desc limit 1");
        GetHtml($prer['classid'],$prer['id'],$prer,1);
    }
    //生成栏目
    if($ccr['haddlist']&&($newchecked||$newchecked<>$add[oldchecked]))
    {
        hAddListHtml($add[classid],$ccr['modid'],$ccr['haddlist'],$ccr['listdt']);//生成信息列表
    }
    //同时更新
    if($checkr['copyids']&&$checkr['copyids']<>'1')
    {
        EditInfoToCopyInfo($add[classid],$add[id],$userid,$username,$doselfinfo);
    }
    if($sql)
    {
        //返回地址
        if($add['ecmsfrom']&&(stristr($add['ecmsfrom'],'ListNews.php')||stristr($add['ecmsfrom'],'ListAllInfo.php')))
        {
            $ecmsfrom=$add['ecmsfrom'];
        }
        else
        {
            $ecmsfrom="ListNews.php?bclassid=$add[bclassid]&classid=$add[classid]".hReturnEcmsHashStrHref2(0);
        }
        $ecmsfrom=$ecmsfrom.$addecmscheck;
        insert_dolog("classid=$add[classid]<br>id=".$add[id]."<br>title=".$add[title],$pubid);//操作日志
        printerror("EditNewsSuccess",$closeurl,8);
    }
    else
    {
        printerror("DbError","history.go(-1)",8);
    }
}

//删除信息
function DelNews($id,$classid,$userid,$username){
    global $empire,$class_r,$class_zr,$bclassid,$public_r,$dbtbpre,$emod_r,$adddatar;
    $id=(int)$id;
    $classid=(int)$classid;
    if(!$id||!$classid)
    {
        printerror("NotDelNewsid","history.go(-1)");
    }
    $doselfinfo=CheckLevel($userid,$username,$classid,"news");//操作权限
    if(!$doselfinfo['dodelinfo'])//删除权限
    {
        printerror("NotDelInfoLevel","history.go(-1)");
    }
    $ccr=$empire->fetch1("select classid,modid,listdt,haddlist,repreinfo from {$dbtbpre}enewsclass where classid='$classid' limit 1");
    if(!$ccr['classid'])
    {
        printerror("ErrorUrl","history.go(-1)");
    }
    //索引表
    $index_r=$empire->fetch1("select classid,checked from {$dbtbpre}ecms_".$class_r[$classid][tbname]."_index  where id='$id' limit 1");
    if(!$index_r[classid]||$index_r[classid]!=$classid)
    {
        printerror("ErrorUrl","history.go(-1)");
    }
    //返回表
    $infotb=ReturnInfoMainTbname($class_r[$classid][tbname],$index_r['checked']);
    $r=$empire->fetch1("select * from ".$infotb." where id='$id' limit 1");
    if($doselfinfo['doselfinfo']&&($r[userid]<>$userid||$r[ismember]))//只能编辑自己的信息
    {
        printerror("NotDoSelfinfo","history.go(-1)");
    }
    $pubid=ReturnInfoPubid($classid,$id);
    //附加链接参数
    $addecmscheck=empty($index_r['checked'])?'&ecmscheck=1':'';
    $mid=$class_r[$classid][modid];
    $tbname=$class_r[$classid][tbname];
    $pf=$emod_r[$mid]['pagef'];
    $stf=$emod_r[$mid]['savetxtf'];
    //返回表信息
    $infotbr=ReturnInfoTbname($class_r[$classid][tbname],$index_r['checked'],$r['stb']);
    //分页字段
    if($pf)
    {
        if(strstr($emod_r[$mid]['tbdataf'],','.$pf.','))
        {
            $finfor=$empire->fetch1("select ".$pf." from ".$infotbr['datatbname']." where id='$id' limit 1");
            $r[$pf]=$finfor[$pf];
        }
    }
    //存文本
    if($stf)
    {
        $newstextfile=$r[$stf];
        $r[$stf]=GetTxtFieldText($r[$stf]);
        DelTxtFieldText($newstextfile);//删除文件
    }
    DelNewsFile($r[filename],$r[newspath],$classid,$r[$pf],$r[groupid]);//删除信息文件
    $sql=$empire->query("delete from {$dbtbpre}ecms_".$class_r[$classid][tbname]."_index where id='$id'");
    $sql=$empire->query("delete from ".$infotbr['tbname']." where id='$id'");
    $fsql=$empire->query("delete from ".$infotbr['datatbname']." where id='$id'");
    //更新栏目信息数
    AddClassInfos($classid,'-1','-1',$index_r['checked']);
    //删除其它表记录和附件
    DelSingleInfoOtherData($r['classid'],$id,$r,0,0);
    if($index_r['checked'])
    {
        //生成上一篇
        if($ccr['repreinfo'])
        {
            $prer=$empire->fetch1("select * from {$dbtbpre}ecms_".$tbname." where id<$id and classid='$classid' order by id desc limit 1");
            GetHtml($prer['classid'],$prer['id'],$prer,1);
            //下一篇
            $nextr=$empire->fetch1("select * from {$dbtbpre}ecms_".$tbname." where id>$id and classid='$classid' order by id limit 1");
            if($nextr['id'])
            {
                GetHtml($nextr['classid'],$nextr['id'],$nextr,1);
            }
        }
        hAddListHtml($classid,$ccr['modid'],$ccr['haddlist'],$ccr['listdt']);//生成信息列表
        if($r['ttid'])//如果是标题分类
        {
            ListHtml($r['ttid'],'',5);
        }
    }
    //同步删除
    if($r['copyids']&&$r['copyids']<>'1')
    {
        DelInfoToCopyInfo($classid,$id,$r,$userid,$username,$doselfinfo);
    }
    if($sql)
    {
        $returl=$_SERVER['HTTP_REFERER'];
        //发送通知
        if($adddatar['causetext'])
        {
            DoInfoSendNotice($userid,$username,$r['userid'],$r['username'],$adddatar['causetext'],$r,1);
            if($adddatar['ecmsfrom']&&(stristr($adddatar['ecmsfrom'],'ListNews.php')||stristr($adddatar['ecmsfrom'],'ListAllInfo.php')))
            {
                $returl=$adddatar['ecmsfrom'];
            }
            else
            {
                $returl="ListNews.php?bclassid=$adddatar[bclassid]&classid=$adddatar[classid]".$addecmscheck.hReturnEcmsHashStrHref2(0);
            }
        }
        else
        {
            if($_POST['enews']=='DoInfoAndSendNotice')
            {
                $returl="ListNews.php?bclassid=$adddatar[bclassid]&classid=$adddatar[classid]".$addecmscheck.hReturnEcmsHashStrHref2(0);
            }
        }
        insert_dolog("classid=$classid<br>id=".$id."<br>title=".$r[title],$pubid);//操作日志
        printerror("DelNewsSuccess",$returl);
    }
    else
    {
        printerror("ErrorUrl","history.go(-1)");
    }
}

//批量删除信息
function DelNews_all($id,$classid,$userid,$username,$ecms=0){
    global $empire,$class_r,$class_zr,$public_r,$dbtbpre,$emod_r;
    $classid=(int)$classid;
    $count=count($id);
    if(!$count)
    {
        printerror("NotDelNewsid","history.go(-1)");
    }
    $doselfinfo=CheckLevel($userid,$username,$classid,"news");//操作权限
    if(!$doselfinfo['dodelinfo'])//删除权限
    {
        printerror("NotDelInfoLevel","history.go(-1)");
    }
    $dopubid=0;
    $mid=$class_r[$classid][modid];
    $tbname=$class_r[$classid][tbname];
    $pf=$emod_r[$mid]['pagef'];
    $stf=$emod_r[$mid]['savetxtf'];
    if($ecms==1)
    {
        $doctb="_doc";
    }
    elseif($ecms==2)
    {
        $doctb="_check";
    }
    for($i=0;$i<$count;$i++)
    {
        $add.="id='".intval($id[$i])."' or ";
    }
    $donum=0;
    $dolog='';
    $add=substr($add,0,strlen($add)-4);
    for($i=0;$i<$count;$i++)//删除信息文件
    {
        $id[$i]=intval($id[$i]);
        $r=$empire->fetch1("select * from {$dbtbpre}ecms_".$tbname.$doctb." where id='$id[$i]'");
        if($doselfinfo['doselfinfo']&&($r[userid]<>$userid||$r[ismember]))//只能编辑自己的信息
        {
            continue;
        }
        $donum++;
        if($donum==1)
        {
            $dopubid=ReturnInfoPubid($r['classid'],$id[$i]);
            $dolog="classid=".$r['classid']."<br>id=".$r['id']."&ecms=$ecms<br>title=".$r['title'];
        }
        //分页字段
        if($pf)
        {
            if(strstr($emod_r[$mid]['tbdataf'],','.$pf.','))
            {
                if($ecms==1)
                {
                    $finfor=$empire->fetch1("select ".$pf." from {$dbtbpre}ecms_".$tbname."_doc_data where id='$id[$i]'");
                }
                elseif($ecms==2)
                {
                    $finfor=$empire->fetch1("select ".$pf." from {$dbtbpre}ecms_".$tbname."_check_data where id='$id[$i]'");
                }
                else
                {
                    $finfor=$empire->fetch1("select ".$pf." from {$dbtbpre}ecms_".$tbname."_data_".$r[stb]." where id='$id[$i]'");
                }
                $r[$pf]=$finfor[$pf];
            }
        }
        //存文本
        if($stf)
        {
            $newstextfile=$r[$stf];
            $r[$stf]=GetTxtFieldText($r[$stf]);
            DelTxtFieldText($newstextfile);//删除文件
        }
        DelNewsFile($r[filename],$r[newspath],$r[classid],$r[$pf],$r[groupid]);
        //删除副表
        if($ecms==0)
        {
            $empire->query("delete from {$dbtbpre}ecms_".$tbname."_data_".$r[stb]." where id='$id[$i]'");
        }
        //删除其它表记录和附件
        DelSingleInfoOtherData($r['classid'],$id[$i],$r,0,0);
        //更新栏目信息数
        if($ecms==0||$ecms==2)
        {
            AddClassInfos($r['classid'],'-1','-1',$ecms==2?0:1);
        }
    }
    //删除信息
    $sql=$empire->query("delete from {$dbtbpre}ecms_".$tbname.$doctb." where ".$add);
    if($ecms==0)
    {
        $empire->query("delete from {$dbtbpre}ecms_".$tbname."_index where ".$add);
        $ccr=$empire->fetch1("select classid,modid,listdt,haddlist from {$dbtbpre}enewsclass where classid='$classid'");
        hAddListHtml($classid,$ccr['modid'],$ccr['haddlist'],$ccr['listdt']);//生成信息列表
    }
    elseif($ecms==1)
    {
        $empire->query("delete from {$dbtbpre}ecms_".$tbname."_doc_index where ".$add);
        $empire->query("delete from {$dbtbpre}ecms_".$tbname."_doc_data where ".$add);
    }
    elseif($ecms==2)
    {
        $empire->query("delete from {$dbtbpre}ecms_".$tbname."_index where ".$add);
        $empire->query("delete from {$dbtbpre}ecms_".$tbname."_check_data where ".$add);
    }
    if($sql)
    {
        //操作日志
        if($donum==1)
        {
            insert_dolog($dolog,$dopubid);
        }
        else
        {
            insert_dolog("classid=".$classid."<br>classname=".$class_r[$classid][classname]."&ecms=$ecms");
        }
        printerror("DelNewsAllSuccess",$_SERVER['HTTP_REFERER']);
    }
    else
    {
        printerror("DbError","history.go(-1)");
    }
}

//批量修改发布时间
function EditMoreInfoTime($add,$userid,$username){
    global $empire,$dbtbpre,$class_r;
    $classid=(int)$add['classid'];
    $infoid=$add['infoid'];
    $newstime=$add['newstime'];
    $count=count($infoid);
    $tbname=$class_r[$classid]['tbname'];
    if(!$classid||!$tbname||!$count)
    {
        printerror('EmptyMoreInfoTime','');
    }
    //操作权限
    $doselfinfo=CheckLevel($userid,$username,$classid,"news");
    if(!$doselfinfo['doeditinfo'])//编辑权限
    {
        printerror('NotEditInfoLevel','history.go(-1)');
    }
    $dopubid=0;
    $donum=0;
    $dolog='';
    //主表
    $infotb='';
    for($i=0;$i<$count;$i++)
    {
        $doinfoid=(int)$infoid[$i];
        if(empty($infotb))
        {
            //索引表
            $index_r=$empire->fetch1("select classid,checked from {$dbtbpre}ecms_".$tbname."_index where id='$doinfoid' limit 1");
            if(!$index_r['classid'])
            {
                continue;
            }
            //返回表
            $infotb=ReturnInfoMainTbname($tbname,$index_r['checked']);
        }
        $donum++;
        if($donum==1)
        {
            $dopubid=ReturnInfoPubid($classid,$doinfoid);
            $dolog="classid=".$classid."<br>classname=".$class_r[$classid][classname]."<br>id=".$doinfoid;
        }
        $donewstime=$newstime[$i]?to_time($newstime[$i]):time();
        $empire->query("update {$dbtbpre}ecms_".$tbname."_index set newstime='$donewstime' where id='$doinfoid'");
        $empire->query("update ".$infotb." set newstime='$donewstime' where id='$doinfoid'");
    }
    //操作日志
    if($donum==1)
    {
        insert_dolog($dolog,$dopubid);
    }
    else
    {
        insert_dolog("classid=$classid<br>classname=".$class_r[$classid][classname]);
    }
    printerror('EditMoreInfoTimeSuccess',$_SERVER['HTTP_REFERER']);
}

//刷新页

























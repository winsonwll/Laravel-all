<?php
/**
 * 设置加载自定义文件方式
 */

    function showState($stateId)
    {
        switch($stateId){
            case '1':
                return '正常状态';
            break;
            case '2':
                return '激活状态';
            break;
            case '3':
                return '未知状态';
            break;
        }
    }

    /**
     * 通过id来获取场馆地址
     */
    function getVenueAddrById($vid)
    {
        return \DB::table('piao_venues')->where('vid',$vid)->first()->vaddr;
    }

/**
 * 通过演出id获取评论数
 */
function getTotalComment($sid)
{
    return \DB::table('piao_comments')->where('sid',$sid)->count();
}
<?php
/**
 * Created by PhpStorm.
 * User: 1
 * Date: 2016/11/17
 * Time: 17:07
 * 统计分布图
 */

namespace Admin\Controller;
use Think\Controller;
class HighchartsController extends BaseController{

     /**
      *拆线图 Time line chart
      */
    public  function  lineChart(){


        $this->display();
    }

    /**
     * 时间轴折线图
     */
    public  function  timeChart(){

        $this->display();
    }
    /**
     * 区域图
     */
    public function regionalMap(){

        $this->display();
    }
    /**
     * 柱状图统计
     */
    public function histogram(){

        $this->display();
    }
    /**
     * 饼状图
     */
    public function pieChart(){

        $this->display();
    }
    /**
     * 3D柱状图
     */
    public function histogram3D(){

        $this->display();
    }
    /**
     *  3D饼状图
     */
    public function pieChart3D(){

        $this->display();
    }
}

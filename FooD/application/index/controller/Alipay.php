<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
use think\Config;
use think\Session;

require_once EXTEND_PATH . 'alipay02/pagepay/service/AlipayTradeService.php';
require_once EXTEND_PATH . 'alipay02/pagepay/buildermodel/AlipayTradePagePayContentBuilder.php';

class Alipay extends Controller
{
    /**
     * 支付宝支付
     * $body            商品描述，可空
     * $subject         订单名称，必填
     * $total_amount    付款金额，必填
     * $out_trade_no    商户订单号，商户网站订单系统中唯一订单号，必填
     */
    public function payPage()//表单 发送参数到支付宝
    {
        $config = Config::get('alipay');

        //获取订单生成后传递过来的订单编号和金额
        $data = request()->only(['subject', 'total_amount', 'out_trade_no', 'body']);

        //商户订单号，商户网站订单系统中唯一订单号，必填
        $out_trade_no = $data['out_trade_no'];

        //订单名称，必填
        $subject = empty($data['subject']) ? '服装' : $data['subject'];

        //付款金额，必填
        $total_amount = $data['total_amount'];

        //商品描述，可空
        $body = empty($data['body']) ? '' : $data['body'];

        //构造参数
        $payRequestBuilder = new \AlipayTradePagePayContentBuilder();
        $payRequestBuilder->setBody($body);
        $payRequestBuilder->setSubject($subject);
        $payRequestBuilder->setTotalAmount($total_amount);
        $payRequestBuilder->setOutTradeNo($out_trade_no);

        $aop = new \AlipayTradeService($config);

        /**
         * pagePay 电脑网站支付请求
         * @param $builder 业务参数，使用buildmodel中的对象生成。
         * @param $return_url 同步跳转地址，公网可以访问
         * @param $notify_url 异步通知地址，公网可以访问
         * @return $response 支付宝返回的信息
         */
        $response = $aop->pagePay($payRequestBuilder,$config['return_url'],$config['notify_url']);

        //输出表单
        var_dump($response);
    }

    public function notify_url(){//验证 验证是否支付
        $arr=request();
        $config = Config::get('alipay');
        $alipaySevice = new \AlipayTradeService($config);
        $alipaySevice->writeLog(var_export($_POST,true));
        $result = $alipaySevice->check($arr);

        /* 实际验证过程建议商户添加以下校验。
        1、商户需要验证该通知数据中的out_trade_no是否为商户系统中创建的订单号，
        2、判断total_amount是否确实为该订单的实际金额（即商户订单创建时的金额），
        3、校验通知中的seller_id（或者seller_email) 是否为out_trade_no这笔单据的对应的操作方（有的时候，一个商户可能有多个seller_id/seller_email）
        4、验证app_id是否为该商户本身。
        */
        if($result) {//验证成功
            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            //请在这里加上商户的业务逻辑程序代


            //——请根据您的业务逻辑来编写程序（以下代码仅作参考）——

            //获取支付宝的通知返回参数，可参考技术文档中服务器异步通知参数列表

            //商户订单号

            $out_trade_no = $_POST['out_trade_no'];

            //支付宝交易号

            $trade_no = $_POST['trade_no'];

            //交易状态
            $trade_status = $_POST['trade_status'];


            if($_POST['trade_status'] == 'TRADE_FINISHED') {

                //判断该笔订单是否在商户网站中已经做过处理
                //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
                //请务必判断请求时的total_amount与通知时获取的total_fee为一致的
                //如果有做过处理，不执行商户的业务程序

                //注意：
                //退款日期超过可退款期限后（如三个月可退款），支付宝系统发送该交易状态通知
            }
            else if ($_POST['trade_status'] == 'TRADE_SUCCESS') {
                //判断该笔订单是否在商户网站中已经做过处理
                //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
                //请务必判断请求时的total_amount与通知时获取的total_fee为一致的
                //如果有做过处理，不执行商户的业务程序
                //注意：
                //付款完成后，支付宝系统发送该交易状态通知
            }
            //——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
            echo "success";    //请不要修改或删除
        }else {
            //验证失败
            echo "fail";

        }
    }

    public function return_url(){//回调 验证成功后返回自己系统这边的支付成功页面 更新订单数据到数据库
        $arr=$_GET;
        $config = Config::get('alipay');
        $alipaySevice = new \AlipayTradeService($config);
        $result = $alipaySevice->check($arr);

        /* 实际验证过程建议商户添加以下校验。
        1、商户需要验证该通知数据中的out_trade_no是否为商户系统中创建的订单号，
        2、判断total_amount是否确实为该订单的实际金额（即商户订单创建时的金额），
        3、校验通知中的seller_id（或者seller_email) 是否为out_trade_no这笔单据的对应的操作方（有的时候，一个商户可能有多个seller_id/seller_email）
        4、验证app_id是否为该商户本身。
        */
        if($result) {//验证成功

            // 更改订单状态
            Db::name('order')
                ->where('order_sn', $arr['out_trade_no'])
                ->update([
                    'order_status'  => 1,
                    'pay_time'      => $arr['timestamp']
                ]);

            $cur_order = Db::name('order')
                ->where('order_sn', $arr['out_trade_no'])
                ->find();

            // 购物车数据
            $session_car = Session::get('car');

            //商品购买，库存数量-,销量+
            if(!$cur_order['is_multi']){
                $goodsid  = $cur_order['goods_id'];
                $goodssum = $cur_order['goods_num'];

                // 删除购物车 Session
                unset($session_car[$goodsid]);

                $sql = "update shop_goods set sales_count=sales_count+" . $goodssum . ",repertory=repertory-" . $goodssum . " where goods_id=" . $goodsid;
                Db::execute($sql);
            } else {
                $goods_tmp = explode('|', $cur_order['goods_list']);

                $goodsid = json_decode($goods_tmp[0]);
                $goodssum = json_decode($goods_tmp[1]);

                foreach ($goodsid as $k => $vo){
                    unset($session_car[$goodsid[$k]]);
                    $sql = "update shop_goods set sales_count=sales_count+" . $goodssum[$k] . ",repertory=repertory-" . $goodssum[$k] . " where goods_id=" . $vo;
                    Db::execute($sql);
                }
            }


            //——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
            //获取支付宝的通知返回参数，可参考技术文档中页面跳转同步通知参数列表

            //商户订单号
            $out_trade_no = htmlspecialchars($_GET['out_trade_no']);

            //支付宝交易号
            $trade_no = htmlspecialchars($_GET['trade_no']);

            //将订单表中的支付状态更改为已支付，并将支付宝交易号写入数据表中
//            Db::table('sp_order')->where('sn',$out_trade_no)->update(['pay_status'=>1,'alipay'=>$trade_no]);

            // 储存购物车的数据
            Session::set('car', $session_car, 'think');
            Db::name('car')->where('user_id', $cur_order['user_id'])->update([
                'goods_info' => json_encode($session_car)
            ]);

            $this->success('支付成功，跳转中...','index/orders/successs?ordernum='. $arr['out_trade_no']);

            //——请根据您的业务逻辑来编写程序（以上代码仅作参考）——

            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        }
        else {
            //验证失败
            echo "验证失败";
        }
    }

    //验签 验证密钥
    public function rsaCheckV1($data)
    {
        $aop = new \AopClient();
        $aop->alipayrsaPublicKey = "支付宝公钥";
        $flag = $aop->rsaCheckV1($data, NULL, "RSA2");
        return $flag;
    }

}
<?php
namespace app\index\controller;
use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;
use think\Cache;
use think\Db;

class Sms
{
    public function send($template='SMS_205616486')
    {
        //当点击按钮提交是短信验证时，执行发送短信代码
        $mobile = input('phone');
        $type = input('type');
        $res = preg_match('/^0?(13|14|15|17|18|19|16)[0-9]{9}$/',$mobile);
        if(!$res){
            $data = ['state'=>1,'msg'=>'手机号码不正确'];
            echo json_encode($data);
            die;
        }
        //给模板默认值
        $template = input('template');
        if(empty($template)){
            $template = $template;
        }
        //随机验证码
        $code = '';
        for ($i=0;$i<4;$i++){
            $code .= mt_rand(1,9);
        }
        AlibabaCloud::accessKeyClient('LTAI4GKeoj774q9owQHLPguY', 'bsCi3uuepfUA53mkJ1ymEUFCvTXSnz')
            ->regionId('cn-hangzhou')
            ->asDefaultClient();
        try {
            $result = AlibabaCloud::rpc()
                ->product('Dysmsapi')
                // ->scheme('https') // https | http
                ->version('2017-05-25')
                ->action('SendSms')
                ->method('POST')
                ->host('dysmsapi.aliyuncs.com')
                ->options([
                    'query' => [
                        'RegionId' => "cn-hangzhou",
                        'PhoneNumbers' => "$mobile",
                        'SignName' => "FooD点餐",
                        'TemplateCode' => "$template",
                        'TemplateParam' => "{'code':$code}",
                    ],
                ])
                ->request();
          $result =  $result->toArray();
          if($result['Message']=='OK'){
              //成功后保留5分钟，假设之前还在则需要清除再生成
              //判断type为2，表示手机登录
              if($type==2){
                  //判断是否注册
                  $res = Db::name('user')->where('mobile',$mobile)->find();
                  if(!$res){
                      $data = ['state'=>1,'msg'=>'发送失败，该手机号并未注册'];
                      echo json_encode($data);
                      die;
                  }
                  $cache = 'login'.$mobile;
              }else{
                  $cache = 'register'.$mobile;
              }
              if(Cache::get($cache)){
                  Cache::rm($cache);
              }
              Cache::set($cache,$code,5*60);
              $data = ['state'=>2,'msg'=>'发送成功，请注意查收'];
              echo json_encode($data);
              die;
          }else{
              $data = ['state'=>1,'msg'=>'发送失败，请重试'];
              echo json_encode($data);
              die;
          }

        } catch (ClientException $e) {
            echo $e->getErrorMessage() . PHP_EOL;
        } catch (ServerException $e) {
            echo $e->getErrorMessage() . PHP_EOL;
        }

    }

}


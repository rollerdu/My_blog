<?php
namespace Home\Controller;
use Think\Controller;
class BaseLoginController extends Controller {
    public function __construct(){
        parent::__construct();
        //过滤参数
//        $_REQUEST = I('request.');
        $this->domainUrl = C('APP_PATH');
    }
    public function checkLogin($backUrl = ''){
        if($_SESSION['openid']){
            $user = M('winners')->where(array('openid' => array('eq',$_SESSION['openid'])))->find();
            if($user && is_array($user)) {
                session('WxUserId', $user['id']);
                session('WxMobile', $user['mobile']);
                session('WxUsername', $user['name']);
                return true;
            }
        }
        $this->getUserOpenId($backUrl);

    }
    public function getUserOpenId($backUrl = ''){
        $code = trim(I("get.code"));
        if($backUrl) session('backUrl',$backUrl);
        if(!$code){
            $url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=".C('APPID')."&redirect_uri=
                http%3A%2F%2Fblog.duomeitao.com%2FHome%2FBaseLogin%2FgetUserOpenId&response_type=code&
                scope=snsapi_base&state=1#wechat_redirect";
            $url = str_replace(" ", "", str_replace("\r", "", str_replace("\n", "", $url)));
            Header("Location: $url");
        }else{
            $wxOauthUrl = sprintf(WX_OAUTH2_ACCESSTOKEN_URL,C('APPID'),C('APPSECRET'),$code);
            $output = $this->get($wxOauthUrl);
            $jsoninfo = json_decode($output, true);
            session('openid', $jsoninfo["openid"]);
            $user = M('winners')->where(array('openid' => array('eq',$jsoninfo["openid"])))->find();
            if($user && is_array($user)) {
                session('WxUserId', $user['id']);
                session('WxMobile', $user['mobile']);
                session('WxUsername', $user['name']);
                $backUrl = $_SESSION['backUrl'];
                unset($_SESSION['backUrl']);
            }else{
                M('winners')->add(array('openid'=>$jsoninfo['openid']));
            }
            if($backUrl){
                $this->redirect("$backUrl");
            }else{
                $this->redirect("/Home/Index/lottery");
            }
        }
    }
    public function get($url, $params = array()) {
        if (empty($url) || !is_array($params)) {
            return false;
        }
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        $paramStr = '';
        if (count($params)) {
            foreach ($params as $k => $v) {
                $paramStr.=(empty($paramStr) ? '' : '&') . $k . '=' . $v;
            }
        }
        $url.=empty($paramStr) ? '' : '?' . $paramStr;
        curl_setopt($curl, CURLOPT_URL, $url);
        $result = curl_exec($curl);
        $info = curl_getinfo($curl);
        curl_close($curl);
        if ($info['http_code'] == 200)
            return $result;
        else
            return false;
    }
//    /**
//     * @Func: 微信端获取微信用户信息
//     */
//    public function weixinUser(){
//        if(!$_SESSION['openid']){
//            $code = I("code");
//            $wxOauth2Url = sprintf(WX_OAUTH2_ACCESSTOKEN_URL,APPID,APPSECRET,$code);
//            $output = HttpClient::get($wxOauth2Url);
//            $jsoninfo = json_decode($output, true);
//
//        }else{
//            $jsoninfo['openid'] = $_SESSION['openid'];
//        }
//        //通过openid取出用户信息
//        $output1 = AccessToken::getAccessToken();
//        $output2 =  HttpClient::get(sprintf(WX_GET_USER_INFO_URL,$output1,$jsoninfo['openid']));
//        return $output2;
//    }

}

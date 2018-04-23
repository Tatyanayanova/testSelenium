<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function slack($message, $channel)
{
    $ch = curl_init("https://tanyayanova.slack.com/api/chat.postMessage");
    $data = http_build_query([
        "token" => "xoxp-335261537463-334177305284-347122349636-2bbb07669f5c03c5f2a3469a6e4fa9b7",
    	"channel" => $channel, //"#mychannel",
    	"text" => $message, //"Hello, Foo-Bar channel message.",
    	"username" => "MySlackBot",
    ]);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $result = curl_exec($ch);
    curl_close($ch);
    
    return $result;
}

slack('hello', '#test');

///////////////////////////

/*class DomenStatisticController extends Controller
public function actionAllStatistic($key, $json = false) {
        if ($key == Yii::app()->params['VETMANAGER_API_KEY']) {
            $model = new DomainsLog;
            if($json == true){
                $this->renderPartial('allstatisticsjson', array('model' => $model));
            }else{
                $this->renderPartial('allstatistics', array('model' => $model));
            }
        }
    }

  ///////////////////////////////////////////  
    
    
   public function runScheduleSlack()
    {
        $time = date('H:i') . ':00';
        //$communication = new Communication();
        if ($time >= '07:00:00') {
            $report = '<p><b>Показатели:</b></p> <br />' . file_get_contents(self::HTML_STATISTIC_URL . '?key=' . self::API_KEY);
            var_dump('self::HTML_STATISTIC_URL', self::HTML_STATISTIC_URL);
            var_dump('self::API_KEY', self::API_KEY);
            //var_dump($report);
            //$communication->sendNotificationToHipChat($report);
        }
         
         $this->slack("This is a line of text.\nAnd this is another one.", '#test');
         echo 'ok';
                 
        
        
    }

    protected  function slack($message, $channel)
    {
        $ch = curl_init("https://tanyayanova.slack.com/api/chat.postMessage");
        $data = http_build_query([
            "token" => "xoxp-335261537463-334177305284-347122349636-2bbb07669f5c03c5f2a3469a6e4fa9b7",
            "channel" => $channel, //"#mychannel",
            "text" => $message, //"Hello, Foo-Bar channel message.",
            "username" => "MySlackBot",
        ]);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }
}

$test = new ScheduleCommand();
$test->runScheduleSlack();    
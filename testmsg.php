<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


define('HTML_STATISTIC_URL', '');
define('API_KEY', '');
define('CHANNEL', '#test');

function slackJeson($data) {
    var_dump('slackJeson');
    $ch = curl_init("https://tanyayanova.slack.com/api/chat.postMessage");
    $data_string = json_encode($data);    
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Authorization: Bearer xoxp-335261537463-334177305284-359201422454-8925034befde22b09808b130f9045f3f',
        'Content-Length: ' . strlen($data_string))
    );
    $result = curl_exec($ch);
    curl_close($ch);

    return $result;
}

function scheduleSlackJeson() {
    var_dump('scheduleSlackJeson');
    $report = json_decode(file_get_contents(HTML_STATISTIC_URL . '?key=' . API_KEY . '&json=true'));
    $msgEndTariffPlan = array();
    $msgEndTariffPlan[] = [
                        "title" => "Доменное имя",
                        "short" => true
                    ];
            $msgEndTariffPlan[] =  [
                        "title" => "Окончание тарифа",
                        "short" => true
                    ];
    if (!empty($report->endTariffPlan)) {
        foreach ($report->endTariffPlan as $client) {            
            $msgEndTariffPlan[] = [
                        "value" => $client->domain_name,
                        "short" => true
                    ];
            $msgEndTariffPlan[] =  [
                        "value" => $client->tariff_valid_until,
                        "short" => true
                    ];
        }
    } 
    $msgChiters = '';
    if (!empty($report->chitters)) {
        foreach ($report->chitters as $cheter) {            
            
            $msgChiters = $msgChiters . $cheter->domain_name . "(" . $cheter->cnt . "),";
        }
    }
    
    $data = [
        "channel" => CHANNEL,        
        "username" => "SlackBot",
        "attachments" => [
            ["text" => 'ПОКАЗАТЕЛИ'],
            ["color" => "#2eb886"],
            ["fields" => [
                    [
                        "title" => "Наименование",
                        "short" => true
                    ],
                    [
                        "title" => "Значение (в скобочках показатель за предыдущий месяц)",
                        "short" => true
                    ],
                    [
                        "value" => "Всего пользователей",
                        "short" => true
                    ],
                    [
                        "value" => $report->commonData->userCount,
                        "short" => true
                    ],
                    [
                        "value" => "Оплаченных клиник",
                        "short" => true
                    ],
                    [
                        "value" => $report->commonData->paidActiveUser,
                        "short" => true
                    ],
                    [
                        "value" => "Пользователей в оплаченных клиниках",
                        "short" => true
                    ],
                    [
                        "value" => $report->commonData->tariffsUserInfo->current->sum_users . " (" . $report->commonData->tariffsUserInfo->previus->sum_users . ')',
                        "short" => true
                    ],
                    [
                        "value" => "Пользователей в среднем на клинику",
                        "short" => true
                    ],
                    [
                        "value" => $report->commonData->tariffsUserInfo->current->avg_users . " (" . $report->commonData->tariffsUserInfo->previus->avg_users . ')' ,
                        "short" => true
                    ],
                    [
                        "value" => "Сумма приблизительно в месяц (300 рублей на пользователя)",
                        "short" => true
                    ],
                    [
                        "value" => $report->commonData->tariffsUserInfo->current->app_sum . ' (' . $report->commonData->tariffsUserInfo->previus->app_sum . ')' ,
                        "short" => true
                    ],
                    [
                        "value" => "Бесплатные пользователи",
                        "short" => true
                    ],
                    [
                        "value" => $report->commonData->freeUserCount ,
                        "short" => true
                    ],
                    [
                        "value" => "Активные пользователи сегодня (вчера)",
                        "short" => true
                    ],
                    [
                        "value" => $report->commonData->activeUsersToday->current . " (" . $report->commonData->activeUsersToday->last . ')' ,
                        "short" => true
                    ],
                    [
                        "value" => "Регистраций ",
                        "short" => true
                    ],
                    [
                        "value" => $report->commonData->registrationCount->current . ' (' . $report->commonData->registrationCount->last . ')' ,
                        "short" => true
                    ],
                    [
                        "value" => "Количество новых оплативших",
                        "short" => true
                    ],
                    [
                        "value" => $report->commonData->newPaidUser->current . " (" . $report->commonData->newPaidUser->last . ')',
                        "short" => true
                    ],
                    [
                        "value" => "Просроченные клиенты",
                        "short" => true
                    ],
                    [
                        "value" => $report->commonData->paidNotActiveUser,
                        "short" => true
                    ]
                ]
            ],
            ["text" => 'КОЛИЧЕСТВО ВЕРСИЙ ДЛЯ ОДНОГО ДОМЕНА ЗА СУТКИ'],
            ["fields" =>  $msgEndTariffPlan ],
            ["text" => 'КОЛИЧЕСТВО ВЕРСИЙ ДЛЯ ОДНОГО ДОМЕНА ЗА СУТКИ'],
            ["text" => $msgChiters],
        ]
    ];


    slackJeson($data);
}
//slack('hello', '#test');
var_dump(scheduleSlackJeson());



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

function scheduleSlack()
    {
        $time = date('H:i') . ':00';        
        if ($time == '07:00:00') {
            $report =  json_decode(file_get_contents(HTML_STATISTIC_URL . '?key=' . API_KEY.'&json=true'));
            $msgEndTariffPlan = '';              
            if (!empty($report->endTariffPlan)){             
                foreach ($report->endTariffPlan as $client){
                    $msgEndTariffPlan = $msgEndTariffPlan.str_pad($client->domain_name,130).str_pad($client->tariff_valid_until,130)."\n";  
                }
            }   
            $msgChiters = '';    
            if (!empty($report->chitters)){             
                foreach ($report->chitters as $cheter){
                    $msgChiters = $msgChiters.$cheter->domain_name."(". $cheter->cnt. "),";
                }
            }            
            $message = ">                                                    ПОКАЗАТЕЛИ\n"
                   . " *Наименование*                                                                                     *Значение* (в скобочках показатель за предыдущий месяц)\n"                
                    .  str_pad("Всего пользователей ",130).$report->commonData->userCount."\n"
                    .  str_pad("Оплаченных клиник",126).$report->commonData->paidActiveUser."\n"
                    .  str_pad("Пользователей в оплаченных клиниках",126).$report->commonData->tariffsUserInfo->current->sum_users . " (". $report->commonData->tariffsUserInfo->previus->sum_users. ')'."\n"
                    .  str_pad("Пользователей в среднем на клинику",127).$report->commonData->tariffsUserInfo->current->avg_users. " (". $report->commonData->tariffsUserInfo->previus->avg_users . ')'."\n"
                    .  str_pad("Сумма приблизительно в месяц (300 рублей на пользователя)",120).$report->commonData->tariffsUserInfo->current->app_sum. ' ('. $report->commonData->tariffsUserInfo->previus->app_sum. ')'."\n"
                    .  str_pad("Бесплатные пользователи",128).$report->commonData->freeUserCount."\n"
                    .  str_pad("Активные пользователи сегодня(вчера)",127).$report->commonData->activeUsersToday->current. " (".$report->commonData->activeUsersToday->last. ')'."\n"
                    .  str_pad("Регистраций ",130).$report->commonData->registrationCount->current. ' ('. $report->commonData->registrationCount->last. ')'."\n"
                    .  str_pad("Количество новых оплативших",126).$report->commonData->newPaidUser->current. " (". $report->commonData->newPaidUser->last. ')'."\n"
                    .  str_pad("Просроченные клиенты",126).$report->commonData->paidNotActiveUser."\n" 
                    . ">                                                ОКОНЧАНИЕ ТАРИФНОГO ПЛАНА\n"
                    .str_pad("*Доменное имя*",130).str_pad("*Окончание тарифа*",130)."\n"               
                    .$msgEndTariffPlan
                    .">                                          КОЛИЧЕСТВО ВЕРСИЙ ДЛЯ ОДНОГО ДОМЕНА ЗА СУТКИ\n"
                    .$msgChiters."\n"
                    ;     
             
            slack($message, '#statistics');
        
        }  
    }


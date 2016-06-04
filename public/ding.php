<?php

require 'corp/api/Auth.php';
require 'corp/api/Department.php';
require 'corp/api/Message.php';
$deptId = '11889001';
$userId = 'manager2775';
$token  = \Auth::getAccessToken();
//$ret    = \Department::listDept($token);
//$users  = \User::simplelist($token, $deptId);

$send   = \Message::send($token, ['toparty'=>$deptId, 'agentid'=>AGENTID, 'msgtype'=>'text', 'text'=>['content'=>'hello']]);
print_r($send);


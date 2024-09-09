<?php

namespace App\Service;

use App\Models\ConstantModel;
use Telnyx\Message;
use Telnyx\Telnyx;

class TelnyxApiService
{
    public function sendMessage($messageInfo, $phoneReceive, $type)
    {
        $apiToken = config('services.telnyx.api_token');
        $phoneSend = config('services.telnyx.phone_send');
        Telnyx::setApiKey($apiToken);
        $createMessage = [
            "from" => $phoneSend, // Your Telnyx number
            "to" => '+1' . $phoneReceive,
            "text" => $messageInfo['message'],
        ];
        if ($type == ConstantModel::$TYPE_MESSAGE['MMS'] && $messageInfo['mediaUrl']) {
            $configMMS = [
                "subject" => $messageInfo['subject'],
                "media_urls" => [$messageInfo['mediaUrl']]
            ];
            array_merge($createMessage, $configMMS);
        }
        return Message::Create($createMessage);
    }
}

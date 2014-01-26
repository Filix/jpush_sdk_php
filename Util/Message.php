<?php
namespace Filix\JpushBundle\Util;

/**
 * Message
 *
 * @author Filix
 * @email syp.syl@gmail.com
 */
class Message
{

    const RECEIVER_TYPE_TAG = 2;
    const RECEIVER_TYPE_ALIAS = 3;
    const RECEIVER_TYPE_ALL = 4;
    const MSG_TYPE_NOTICE = 1;
    const MSG_TYPE_CUSTOM = 2;
    const ANDROID_PLATFORM = 'android';
    const IOS_PLATFORM = 'ios';

    protected $sendno;
    protected $receiver_type;
    protected $receiver_value = array();
    protected $msg_type;
    protected $msg_content;
    protected $send_description;
    protected $platform = array();
    protected $apns_production = 0;
    protected $time_to_live = 0;
    protected $override_msg_id;

    public function getSendno()
    {
        return $this->sendno;
    }

    public function setSendno($sendno)
    {
        $this->sendno = $sendno;

        return $this;
    }

    public function getReceiverType()
    {
        return $this->receiver_type;
    }

    public function setReceiverType($receiver_type)
    {
        $this->receiver_type = $receiver_type;

        return $this;
    }

    public function getReceiverValue()
    {
        return $this->receiver_value;
    }

    public function addReceiverValue($value)
    {
        $this->receiver_value[] = $value;

        return $this;
    }

    public function setReceiverValue(array $receiver_value)
    {
        $this->receiver_value = $receiver_value;

        return $this;
    }

    public function getMsgType()
    {
        return $this->msg_type;
    }

    public function setMsgType($msg_type)
    {
        $this->msg_type = $msg_type;

        return $this;
    }

    public function getMsgContent()
    {
        return $this->msg_content;
    }

    /*
     * array('n_builder_id' =>0, 'n_title' => 'title', 'n_content' => 'content', 'n_extras' => 'extras')
     */

    public function setMsgContent(array $msg_content)
    {
        $this->msg_content = $msg_content;

        return $this;
    }

    public function getSendDescription()
    {
        return $this->send_description;
    }

    public function setSendDescription($send_description)
    {
        $this->send_description = $send_description;

        return $this;
    }

    public function getPlatform()
    {
        return $this->platform;
    }

    public function addPlatform($platform)
    {
        $this->platform[] = $platform;

        return $this;
    }

    public function setPlatform(array $platform)
    {
        $this->platform = $platform;

        return $this;
    }

    public function getApnsProduction()
    {
        return $this->apns_production;
    }

    public function setApnsProduction($apns_production)
    {
        $this->apns_production = $apns_production;

        return $this;
    }

    public function getTimeToLive()
    {
        return $this->time_to_live;
    }

    public function setTimeToLive($time_to_live)
    {
        $this->time_to_live = $time_to_live;

        return $this;
    }

    public function getOverrideMsgId()
    {
        return $this->override_msg_id;
    }

    public function setOverrideMsgId($override_msg_id)
    {
        $this->override_msg_id = $override_msg_id;

        return $this;
    }

}

<?php
/**
 * Created by PhpStorm.
 * User: capstonestudent
 * Date: 2/24/2020
 * Time: 9:13 PM
 */

namespace ZK;

use Couchbase\Exception;
use ZKLib;

class Realtime
{
    public function enable_realtime(ZKLib $self)
    {
        $self->_section = __METHOD__;
        $command = Util::CMD_REG_EVENT;
        $command_string = 'ffff0000';
        $session = $self->_command($command, $command_string, Util::COMMAND_TYPE_DATA);

        if ($session === false) {
            return false;
        }

       $ret  = Util::checkValid($self->_data_recv);
        return $ret;
    }

    public  function  recv_event(ZKLib $self){
        echo "<pre/>";
        var_dump($self->_zkclient);
//        $ret = socket_recv($self->_zkclient, $dataRec, 4096, 0);
//        var_dump($ret);
    }
}
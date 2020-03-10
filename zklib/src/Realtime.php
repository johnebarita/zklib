<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 25/02/2020
 * Time: 9:50 AM
 */

namespace ZK;

use ZKLib;


class Realtime
{

    public function enable_realtime(ZKLib $self)
    {
        $self->_section = __METHOD__;
        $command = Util::CMD_REG_EVENT;
        $byte1 = chr(255);
        $byte2 = chr(0);
        $command_string = ($byte1 . $byte1 . $byte2 . $byte2);
        $session = $self->_command($command, $command_string);

        if ($session === false) {
            return false;
        }
        return $ret = Util::checkValid($self->_data_recv);
    }

    public function recv_event(ZKLib $self)
    {
        if (false !== ($ret =socket_recv($self->_zkclient, $dataRec, 4096, 0))) {
            var_dump($dataRec);
            $command = Util::CMD_ACK_OK;
            $command_string = '';
            $session = $self->_command($command, $command_string);
        }
    }
}
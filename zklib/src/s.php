<?php
///**
// * Created by PhpStorm.
// * User: User
// * Date: 11/02/2020
// * Time: 10:53 AM
// */
//include('zklib/ZKLib.php');
//
//$zk = new ZKLib('169.254.126.127');
//$ret = $zk->connect();
//
//if($ret){
//    $zk->enable_realtime();
//}
//
////for CONNECT
//
//public function connect(ZKLib $self)
//{
//    $self->_section = __METHOD__;
//
//    $command = Util::CMD_CONNECT; //1000
//    $command_string = '';
//    $chksum = 0;
//    $session_id = 0;
//    $reply_id = -1 + Util::USHRT_MAX;
//
//    $buf = Util::createHeader($command, $chksum, $session_id, $reply_id, $command_string);
//
//    socket_sendto($self->_zkclient, $buf, strlen($buf), 0, $self->_ip, $self->_port);
//
//    try {
//        @socket_recvfrom($self->_zkclient, $self->_data_recv, 1024, 0, $self->_ip, $self->_port);
//        if (strlen($self->_data_recv) > 0) {
//            $u = unpack('H2h1/H2h2/H2h3/H2h4/H2h5/H2h6', substr($self->_data_recv, 0, 8));
//
//            $session = hexdec($u['h6'] . $u['h5']);
//            if (empty($session)) {
//                return false;
//            }
//
//            $self->_session_id = $session;
//            return Util::checkValid($self->_data_recv);
//        } else {
//            return false;
//        }
//    } catch (ErrorException $e) {
//        return false;
//    } catch (Exception $e) {
//        return false;
//    }
//}
//
//static public function createHeader($command, $chksum, $session_id, $reply_id, $command_string)
//{
//    $buf = pack('SSSS', $command, $chksum, $session_id, $reply_id) . $command_string;
//
//    $buf = unpack('C' . (8 + strlen($command_string)) . 'c', $buf);
//
//    $u = unpack('S', self::createChkSum($buf));
//
//    if (is_array($u)) {
//        $u = reset($u);
//    }
//    $chksum = $u;
//
//    $reply_id += 1;
//
//    if ($reply_id >= self::USHRT_MAX) {
//        $reply_id -= self::USHRT_MAX;
//    }
//
//    $buf = pack('SSSS', $command, $chksum, $session_id, $reply_id);
//
//    return $buf . $command_string;
//
//}
//
// static public function createChkSum($p)
//{
//    $l = count($p);
//    $chksum = 0;
//    $i = $l;
//    $j = 1;
//    while ($i > 1) {
//        $u = unpack('S', pack('C2', $p['c' . $j], $p['c' . ($j + 1)]));
//
//        $chksum += $u[1];
//
//        if ($chksum > self::USHRT_MAX) {
//            $chksum -= self::USHRT_MAX;
//        }
//        $i -= 2;
//        $j += 2;
//    }
//
//    if ($i) {
//        $chksum = $chksum + $p['c' . strval(count($p))];
//    }
//
//    while ($chksum > self::USHRT_MAX) {
//        $chksum -= self::USHRT_MAX;
//    }
//
//    if ($chksum > 0) {
//        $chksum = -($chksum);
//    } else {
//        $chksum = abs($chksum);
//    }
//
//    $chksum -= 1;
//    while ($chksum < 0) {
//        $chksum += self::USHRT_MAX;
//    }
//
//    return pack('S', $chksum);
//}
//
// static public function checkValid($reply)
//{
//    $u = unpack('H2h1/H2h2', substr($reply, 0, 8));
//    $command = hexdec($u['h2'] . $u['h1']);
//
//    /** TODO: Some device can return 'Connection unauthorized' then should check also */
//    if ($command == self::CMD_ACK_OK || $command == self::CMD_ACK_UNAUTH) {
//        return true;
//    } else {
//        return false;
//    }
//}
//
//public function enable_realtime(ZKLib $self)
//{
//    $self->_section = __METHOD__;
//    $command = Util::CMD_REG_EVENT;
//    $command_string = (char(255) . char(255) . char(0) . char(0));
//    $session = $self->_command($command, $command_string);
//
//    if ($session === false) {
//        return false;
//    }
//    return $ret = Util::checkValid($self->_data_recv);
//}
//
// public function _command($command, $command_string, $type = Util::COMMAND_TYPE_GENERAL)
//{
//    $chksum = 0;
//    $session_id = $this->_session_id;
//
//
//    $u = unpack('H2h1/H2h2/H2h3/H2h4/H2h5/H2h6/H2h7/H2h8', substr($this->_data_recv, 0, 8));
//    $reply_id = hexdec($u['h8'] . $u['h7']);
//
//    $buf = Util::createHeader($command, $chksum, $session_id, $reply_id, $command_string);
//
//
//    socket_sendto($this->_zkclient, $buf, strlen($buf), 0, $this->_ip, $this->_port);
//
//    try {
//        socket_recvfrom($this->_zkclient, $this->_data_recv, 1024, 0, $this->_ip, $this->_port);
//
//        $u = unpack('H2h1/H2h2/H2h3/H2h4/H2h5/H2h6', substr($this->_data_recv, 0, 8));
//        $ret = false;
//        $session = hexdec($u['h6'] . $u['h5']);
//        if ($type === Util::COMMAND_TYPE_GENERAL && $session_id === $session) {
//            $ret = substr($this->_data_recv, 8);
//        } else if ($type === Util::COMMAND_TYPE_DATA && !empty($session)) {
//            $ret = $session;
//        }
//
//        return $ret;
//    } catch (ErrorException $e) {
//        return false;
//    } catch (Exception $e) {
//        return false;
//    }
//}
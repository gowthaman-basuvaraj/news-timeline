<?php

/**
 * Gearman functions
 *
 * @author Russell Smith <russell.smith@ukd1.co.uk>
 * @copyright UKD1 Limited 2010
 */
class Gearman {

  private $client;

  function __construct() {
    // get a new gearman worker
    $this->client = new GearmanClient();

    // add the servers in the config

    $this->client->addServer("127.0.0.1");
  }

  public function reverse($str) {
    $this->client->doLowBackground("reverse", serialize($str));
  }

  function send_notification_email($to, $to_name, $subject, $body) {
    $this->client->doLowBackground('send_notification_email', serialize(array('to' => $to, 'to_name' => $to_name, 'subject' => $subject, 'body' => $body)));
  }

}
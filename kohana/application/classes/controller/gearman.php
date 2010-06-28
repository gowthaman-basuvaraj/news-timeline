<?php

class Controller_Gearman extends Controller_Base {

  public function __construct(Kohana_Request $request) {
    $this->worker = new GearmanWorker();
    $this->worker->addServer('127.0.0.1');
    $this->log = Kohana_Log::instance();
    $this->readability = new Readability();
    $this->fetcher = new Contentfetcher();


    $this->worker->addFunction("reverse", array($this, "reverse_fn"));
    parent::__construct($request);
  }

  private $worker;
  private $log;
  private $readability;
  private $fetcher;
  private $htmldom;

  public function action_workers() {



    while ($this->worker->work()) {
      switch ($this->worker->returnCode()) {
        case GEARMAN_SUCCESS:
          $this->log->add("DEBUG", "SUCESS RET: " . $this->worker->returnCode());
          break;
        default:
          $this->log->add("DEBUG", "ERROR RET: " . $this->worker->returnCode());

          exit;
      }
      $this->log->write();
    }
    die();
  }

  public function reverse_fn($job) {
    $workload = $job->workload();
    $this->log->add("DEBUG", "Received job: " . $job->handle());
    $this->log->add("DEBUG", "Workload: $workload");
    $result = strrev($workload);

    //for ($i = 1; $i <= 10; $i+=3) {
    //$job->sendStatus($i, 10);
    //sleep(1);
    //}

    $this->log->add("DEBUG", "Result: $result");
    $this->log->write();
    return $result;
  }

  public function action_process_link($job) {
    foreach (Mango::factory("link")->load(null) as $link) {
      $workload['link'] = $link;
      //$workload = $job->workload();
      //$this->log->add("DEBUG", "Received job: " . $job->handle());
      //$this->log->add("DEBUG", "Workload: $workload");
      $linkObject = $workload['link'];

      echo "Processing $linkObject->url<br />";
      $html = $this->fetcher->get_htmlpage($linkObject->url);
      include_once("application/classes/simple_html_dom.php");
      $this->htmldom = str_get_html($html);
      if (isset($workload['fetch_html']) || true) {
        $content_div = $this->readability->grabArticle($html, false);
        $content_html = $content_div->ownerDocument->saveXML($content_div);
      }if (isset($workload['fetch_img']) || true) {
        $imgs = array();
        foreach ($this->htmldom->find("img") as $img) {
          $img = $img->getAttribute("src");

          $img_parts = explode("/", $img);
          if (substr($img, 0, 4) == "http") {
            $img_url = $img;
          } else {
            $base_url = $this->fetcher->GetMainBaseFromURL($linkObject->url);
            $img_url = "$base_url" . $img;
          }


          $filename = APPPATH . "content_cache/" . $img_parts[count($img_parts) - 1];
          $img_url = preg_replace("/\s/", "%20", $img_url);
          $curlobj = new curlobj($img_url, $linkObject->url);
          $curlobj->createCurl();
         // echo "Saving $filename for $img_url<br/>";
          $f = fopen($filename, "wb");
          fwrite($f, $curlobj->getContent());
          fclose($f);

          $imgs[] = array("file" => $filename, "url" => $img_url);
        }
        //load images check for sizes
        $max_width = -1;
        $max_width_img = null;

        foreach ($imgs as $file) {
          if(!file_exists($file["file"])) {
            continue;
          }
          if (!strstr(mime_content_type($file["file"]), "image"))
            continue;
          if(strstr($file["file"], ".gif")) {//for now ignore gifs
            continue;
          }
          $img = Kohana_Image::factory($file["file"]);
          //echo "processing " . $file["file"] . " width $img->width<br />";
          if ($img->width > $max_width) {
            $max_width = $img->width;
            if (file_exists($max_width_img["file"])) {
              unlink($max_width_img["file"]);
            }
            $max_width_img = $file;
          } else {
            if (file_exists($max_width_img["file"])) {
              //unlink($max_width_img["file"]);
            }
          }
        }
        if ($max_width_img && file_exists($max_width_img["file"])) {
          $local_cache = "static_content/" . $linkObject->story->humanizeid."-". basename($max_width_img["file"]);
          rename($max_width_img["file"], $local_cache);
          $linkObject->story->values(array("story_image" => $max_width_img["url"], "local_cache"=>$local_cache));
          $linkObject->story->update();
          echo Kohana::debug($linkObject->story->as_array());
        }
      }

      $result = "";
      $this->log->add("DEBUG", "Result: $result");
      $this->log->write();
     
    }
    return $result;
  }

}

?>

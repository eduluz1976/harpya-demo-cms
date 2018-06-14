<?php

namespace cms\helper;


use \harpya\ufw\Utils;
use \harpya\ufw\Application;

error_reporting(E_ALL);

class Email {

    
    
    const EMAIL_FROM_NAME = "from_name";
    const EMAIL_FROM_ADDR = "from_addr";
    
    const EMAIL_TO_NAME = "to_name";
    const EMAIL_TO_ADDR = "to_addr";
    
    const TITLE = "title";
    
    const MIME_TYPE = "mime_type";
    const CONTENT = "content";
    
    
    /**
     * 
     * @var string from_name Description
     * 
     * @return string
     */
    public static function send($props=[]) {
        
        $apiKey = getenv('SENDGRID_API_KEY');
        
        
        
        if (!$apiKey) {
            throw new \Exception("Sendgrid API key not found");
        }
        
        
        
        $fromAddr = Utils::get(self::EMAIL_FROM_ADDR, $props, Application::getInstance()->getRequest()->get(self::EMAIL_FROM_ADDR, getenv(self::EMAIL_FROM_ADDR)));
        $fromName = Utils::get(self::EMAIL_FROM_NAME, $props, Application::getInstance()->getRequest()->get(self::EMAIL_FROM_NAME, getenv(self::EMAIL_FROM_NAME)??$fromAddr));

        if (!$fromAddr) {
            throw new \Exception("Required field is missing: " . self::EMAIL_FROM_ADDR);
        }
        
        $email = new \SendGrid\Mail\Mail();
        $email->setFrom($fromAddr, $fromName);
        
//        $from = new \SendGrid\Mail\Mail($fromName, $fromAddr);
        
        $subject = Utils::get(self::TITLE, $props,Application::getInstance()->getRequest()->get(self::TITLE, getenv(self::TITLE)??'Verify your account'));
        
        $toAddr = Utils::get(self::EMAIL_TO_ADDR, $props,Application::getInstance()->getRequest()->get(self::EMAIL_TO_ADDR, getenv(self::EMAIL_TO_ADDR)));
        $toName = Utils::get(self::EMAIL_TO_NAME, $props,Application::getInstance()->getRequest()->get(self::EMAIL_TO_NAME, getenv(self::EMAIL_TO_NAME)??$toAddr));

        if (!$toAddr) {
            throw new \Exception("Required field is missing: " . self::EMAIL_TO_ADDR);
        }

        $email->addTo($toAddr, $toName);
//        $to = new \SendGrid\Mail\Mail($toName, $toAddr);
        
        $html = Utils::get(self::CONTENT, $props,Application::getInstance()->getRequest()->get(self::CONTENT));


        if (!$html) {
            throw new \Exception("Required field is missing: " . self::CONTENT);
        }

        
//        $content = new \SendGrid\Content(Utils::get(self::MIME_TYPE, $props,Application::getInstance()->getRequest()->get(self::MIME_TYPE,"text/html")), $html);

//        dd($content);
//        echo "\n\n";
//        echo "\n from = " . json_encode($from);
//        echo "\n to = " . json_encode($to);
//        echo "\n subject = " . json_encode($subject);
//        echo "\n content = " . json_encode($content);
        $resp = [];
        try {
//            echo " Key = $apiKey ";
            $sendgrid = new \SendGrid($apiKey);
            $email->setSubject($subject);
            $email->addContent('text/html', $html);
            
//            $mail = new \SendGrid\Mail($from, $subject, $to, $content);
//            $sg = new \SendGrid($apiKey);

//            $response = $sg->client->mail()->send()->post($mail);

$response = $sendgrid->send($email);
            
            $resp['stats'] = $response->statusCode();
            $resp['headers'] = $response->headers();        
            $resp['body'] = $response->body();        
            
        } catch (\Exception $ex) {
    echo 'Caught exception: ',  $ex->getMessage(), "\n";
    //$resp = 
        }
        return $resp;
    }    
}
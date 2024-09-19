<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Newsletter;
use App\Page;
use App\Article;
use App\Category;
use App\EmailNotification;
use Mail;
use Helper;
use SendGrid\Mail\From;
use SendGrid\Mail\To;
use SendGrid\Mail\Content;
use SendGrid\Mail\Personalization;
use SendGrid\Mail\Subject;
use Illuminate\Support\Facades\Redirect;
use Session;
class SubscriptionController extends Controller
{

    public function forwardSubscription($request)
    {
        $ip = \Request::ip();
        $iplocation = Helper::getIPLocation($ip);
        $names = $this->combineNames($request->firstName, $request->lastName);
        $emails = $this->filterEmails($request->email);
    
        if (count($names) != count($emails)) {
            Session::flash('message', 'Please do not enter duplicate names');
            Session::flash('alert-class', 'alert-danger');
            return false;
        }
    
        $subscribers = array_combine($names, $emails);
        
        foreach ($subscribers as $name => $email) {
            $this->processSubscription($name, $email, $request, $ip, $iplocation);
        }
    
        return true;
    }
    
    private function combineNames($firstNames, $lastNames)
    {
        $nameArr = [];
        foreach (array_combine($firstNames, $lastNames) as $firstName => $lastName) {
            if (trim($lastName) !== "") {
                $nameArr[] = trim($firstName) . ' ' . trim($lastName);
            }
        }
        return $nameArr;
    }
    
    private function filterEmails($emails)
    {
        return array_filter($emails, function($email) {
            return trim($email) !== "";
        });
    }
    
    private function processSubscription($name, $email, $request, $ip, $iplocation)
    {
        $existingUser = Newsletter::findSubscriber($email);
        $emailData = $this->prepareEmailData($name, $email, $request, $ip, $iplocation);
    
        if ($existingUser) {
            $emailData['token'] = $existingUser->token;
            $this->sendEmail($emailData);
        } else {
            $this->createNewSubscriber($emailData);
            $this->sendEmail($emailData);
            $this->notifyAdmin($emailData);
        }
    }
    
    private function prepareEmailData($name, $email, $request, $ip, $iplocation)
    {
        $emailSettings = EmailNotification::findByForm('newsletter');
        $adminEmailSettings = EmailNotification::findByForm('newsletter-admin');
    
        return [
            'name' => $name,
            'token' => Str::random(60),
            'email' => $email,
            'fromName' => $request->fromName,
            'fromEmail' => $request->fromEmail,
            'ip' => $ip,
            'iplocation' => $iplocation,
            'from_email' => str_replace(' ', '', $emailSettings->send),
            'to_email' => str_replace(' ', '', $emailSettings->receive),
            'cc_email' => str_replace(' ', '', $emailSettings->cc),
            'bcc_email' => str_replace(' ', '', $emailSettings->bcc),
            'from_email_admin' => str_replace(' ', '', $adminEmailSettings->send),
            'to_email_admin' => str_replace(' ', '', $adminEmailSettings->receive),
            'cc_email_admin' => str_replace(' ', '', $adminEmailSettings->cc),
            'bcc_email_admin' => str_replace(' ', '', $adminEmailSettings->bcc),
        ];
    }
    
    private function sendEmail($data)
    {
        // Create a new SendGrid Mail object
        $email = new \SendGrid\Mail\Mail();
        
        // Set sender information
        $email->setFrom("zaustralia@zagro.com", "Zagro Australia");
    
        // Personalization for the recipient
        $personalization = new \SendGrid\Mail\Personalization();
        $personalization->addTo(new \SendGrid\Mail\To($data['email'], $data['name']));
    
        // Add personalization to the email
        $email->addPersonalization($personalization);
    
        // Add dynamic template data
        $email->addDynamicTemplateDatas([
            'subject' => 'Zagro Australia eNews: (You have been recommended by ' . $data['fromName'] . ')',
            'name'    => $data['fromEmail']
        ]);
    
        // Set the template ID
        $email->setTemplateId("d-65c797d6abde4a43b565aa493945fd71");
    
        // Initialize SendGrid with API Key
        $sendgrid = new \SendGrid(env('SENDGRID_API_KEY'));  // Remember to store the API key in .env
        
        try {
            // Send the email using SendGrid
            $response = $sendgrid->client->mail()->send()->post($email);
            
            // Debug: Print status code and response headers (optional)
            print $response->statusCode() . "\n";
            print_r($response->headers());
            print $response->body() . "\n";
        } catch (Exception $e) {
            // Log any exceptions and errors
            \Log::error('SendGrid Error: ' . $e->getMessage());
        }
    }
    
    
    private function createNewSubscriber($data)
    {
        $newsletter = new Newsletter;
        $newsletter->fill([
            'name' => $data['name'],
            'token' => $data['token'],
            'email' => $data['email'],
            'type' => 'contact',
            'status' => 'active',
            'ip' => $data['ip'],
            'iplocation' => $data['iplocation']
        ]);
        $newsletter->save();
    }
    
    private function notifyAdmin($data)
    {
        Mail::send('emails.newsletter_admin', $data, function ($mail) use ($data) {
            $mail->subject('Zagro - Welcome!');
            $mail->to(explode(',', $data['to_email_admin']));
            $mail->from(explode(',', $data['from_email_admin']));
            if ($data['cc_email_admin']) $mail->cc(explode(',', $data['cc_email_admin']));
            if ($data['bcc_email_admin']) $mail->bcc(explode(',', $data['bcc_email_admin']));
        });
    }
    

}

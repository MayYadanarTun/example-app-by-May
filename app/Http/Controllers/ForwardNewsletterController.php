<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;
use Validator;
use App\Rules\RecaptchaV3;

class ForwardNewsletterController extends SubscriptionController
{
    public function index()
    {
        $page = Page::findBySlug('forward');
        if ($page)
            return view('forward-newsletter', compact('page'));
        return redirect()->route('home');
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'fromName' => 'required|max:100',
            'fromEmail' => 'required|email||regex:/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/',
            'g_recaptcha_response_newsletter_footer' => ['required_without_all:g_recaptcha_response_newsletter_sidebar,g_recaptcha_response_newsletter_popup,g_recaptcha_response_discount_popup', new RecaptchaV3($request->g_recaptcha_response_newsletter_footer)],
            'g_recaptcha_response_newsletter_sidebar' => ['required_without_all:g_recaptcha_response_newsletter_footer,g_recaptcha_response_newsletter_popup,g_recaptcha_response_discount_popup', new RecaptchaV3($request->g_recaptcha_response_newsletter_sidebar)],
            'g_recaptcha_response_newsletter_popup' => ['required_without_all:g_recaptcha_response_newsletter_footer,g_recaptcha_response_newsletter_sidebar,g_recaptcha_response_discount_popup', new RecaptchaV3($request->g_recaptcha_response_newsletter_popup)],
            'g_recaptcha_response_discount_popup' => ['required_without_all:g_recaptcha_response_newsletter_footer,g_recaptcha_response_newsletter_sidebar,g_recaptcha_response_newsletter_popup', new RecaptchaV3($request->g_recaptcha_response_discount_popup)],
        ]);
        

        if($validator->fails())
        {
            return back()->withInput()->withErrors($validator);
        }
        //create new method instead of userSubscription();
        $subscription = $this->forwardSubscription($request);

        if(!$subscription)
        {
            return back()->withInput()->withErrors("An error has occured on submit. Please try again.");
        }
        return redirect('/thank-you')->with('alert-success', 'Thank you for recommending to your friends!');
    }
}

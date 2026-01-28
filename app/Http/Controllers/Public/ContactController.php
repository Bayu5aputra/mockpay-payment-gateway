<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    /**
     * Display contact page
     * GET /contact
     */
    public function index(Request $request)
    {
        $subject = $request->input('subject');

        $subjects = [
            'general' => 'General Inquiry',
            'technical' => 'Technical Support',
            'billing' => 'Billing Question',
            'enterprise' => 'Enterprise Plan',
            'partnership' => 'Partnership Opportunity',
            'feedback' => 'Feedback & Suggestions',
            'other' => 'Other',
        ];

        $contactInfo = [
            'email' => 'support@mockpay.test',
            'phone' => '+62 21 1234 5678',
            'address' => 'Jl. Sudirman No. 123, Jakarta 12190, Indonesia',
            'hours' => 'Monday - Friday, 9:00 AM - 6:00 PM (GMT+7)',
        ];

        $socialLinks = [
            ['platform' => 'Twitter', 'url' => 'https://twitter.com/mockpay', 'icon' => 'twitter'],
            ['platform' => 'GitHub', 'url' => 'https://github.com/mockpay', 'icon' => 'github'],
            ['platform' => 'Discord', 'url' => 'https://discord.gg/mockpay', 'icon' => 'discord'],
            ['platform' => 'LinkedIn', 'url' => 'https://linkedin.com/company/mockpay', 'icon' => 'linkedin'],
        ];

        return view('public.contact', compact('subjects', 'subject', 'contactInfo', 'socialLinks'));
    }

    /**
     * Submit contact form
     * POST /contact
     */
    public function submit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:10|max:2000',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // In real application, send email or save to database
            // For now, just log the contact request
            \Log::info('Contact form submission', [
                'name' => $request->name,
                'email' => $request->email,
                'subject' => $request->subject,
                'message' => $request->message,
            ]);

            // Optionally send email notification
            // Mail::to('support@mockpay.test')->send(new ContactFormMail($request->all()));

            return redirect()->back()->with('success', 'Thank you for contacting us! We will get back to you within 24 hours.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to submit contact form. Please try again later.')
                ->withInput();
        }
    }

    /**
     * Display support page
     * GET /support
     */
    public function support()
    {
        $categories = [
            [
                'title' => 'Getting Started',
                'icon' => 'rocket',
                'articles' => [
                    ['title' => 'How to create an account', 'url' => '/docs/getting-started#registration'],
                    ['title' => 'Generate your first API key', 'url' => '/docs/getting-started#api-keys'],
                    ['title' => 'Make your first API call', 'url' => '/docs/api-reference#create-payment'],
                    ['title' => 'Set up webhooks', 'url' => '/docs/webhooks#setup'],
                ]
            ],
            [
                'title' => 'Payment Methods',
                'icon' => 'credit-card',
                'articles' => [
                    ['title' => 'Virtual Account integration', 'url' => '/docs/payment-methods#virtual-account'],
                    ['title' => 'E-wallet implementation', 'url' => '/docs/payment-methods#ewallet'],
                    ['title' => 'Credit card testing', 'url' => '/docs/payment-methods#credit-card'],
                    ['title' => 'QRIS payments', 'url' => '/docs/payment-methods#qris'],
                ]
            ],
            [
                'title' => 'Troubleshooting',
                'icon' => 'wrench',
                'articles' => [
                    ['title' => 'Common API errors', 'url' => '/docs/faq#api-errors'],
                    ['title' => 'Webhook not receiving', 'url' => '/docs/faq#webhooks'],
                    ['title' => 'Authentication issues', 'url' => '/docs/faq#authentication'],
                    ['title' => 'Payment simulation problems', 'url' => '/docs/faq#simulation'],
                ]
            ],
            [
                'title' => 'Account & Billing',
                'icon' => 'user',
                'articles' => [
                    ['title' => 'Update account information', 'url' => '/docs/faq#account'],
                    ['title' => 'Change subscription plan', 'url' => '/docs/faq#subscription'],
                    ['title' => 'Download invoices', 'url' => '/docs/faq#invoices'],
                    ['title' => 'Cancel subscription', 'url' => '/docs/faq#cancel'],
                ]
            ],
        ];

        return view('public.support', compact('categories'));
    }
}

@extends('layouts.public')

@section('title', 'Contact Us')

@section('content')
@php
    $selectedSubject = old('subject', $subject ?? 'general');
@endphp
<!-- Contact Hero -->
<section class="relative overflow-hidden bg-gradient-to-br from-cyan-600 via-blue-600 to-slate-900 pt-32 pb-20">
    <div class="absolute inset-0">
        <div class="absolute -top-24 -left-24 h-72 w-72 rounded-full bg-cyan-400/20 blur-3xl"></div>
        <div class="absolute top-24 -right-24 h-96 w-96 rounded-full bg-blue-400/20 blur-3xl"></div>
        <div class="absolute bottom-0 left-1/2 h-64 w-64 -translate-x-1/2 rounded-full bg-emerald-400/10 blur-3xl"></div>
    </div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl">
            <div class="inline-flex items-center rounded-full bg-white/10 px-4 py-2 text-sm font-semibold text-white ring-1 ring-white/20">
                Support and Sales
            </div>
            <h1 class="text-5xl font-bold text-white mt-6 mb-6">Let’s talk about your payment flow</h1>
            <p class="text-xl text-cyan-100">
                Reach out for integration help, sandbox issues, or enterprise questions. We reply within one business day.
            </p>
            <div class="mt-8 flex flex-wrap gap-4">
                <div class="flex items-center gap-3 rounded-xl bg-white/10 px-4 py-3 text-white ring-1 ring-white/20">
                    <span class="inline-flex h-2 w-2 rounded-full bg-emerald-400"></span>
                    <span class="text-sm">Typical response: under 24 hours</span>
                </div>
                <div class="flex items-center gap-3 rounded-xl bg-white/10 px-4 py-3 text-white ring-1 ring-white/20">
                    <span class="text-sm">Support hours: {{ $contactInfo['hours'] }}</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Form Section -->
<section class="py-20 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <!-- Contact Info -->
            <div class="space-y-8">
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">Contact Information</h2>
                    <p class="text-gray-600 mb-6">Choose a channel or send the form. We handle support, sales, and partnerships.</p>

                    <div class="space-y-5">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-12 h-12 bg-cyan-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-cyan-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-base font-semibold text-gray-900">Email</h3>
                                <a href="mailto:{{ $contactInfo['email'] }}" class="text-gray-600 hover:text-cyan-700">{{ $contactInfo['email'] }}</a>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-base font-semibold text-gray-900">Phone</h3>
                                <a href="tel:{{ $contactInfo['phone'] }}" class="text-gray-600 hover:text-blue-700">{{ $contactInfo['phone'] }}</a>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-12 h-12 bg-emerald-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-emerald-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-base font-semibold text-gray-900">Office</h3>
                                <p class="text-gray-600">{{ $contactInfo['address'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Links</h3>
                    <ul class="space-y-3">
                        <li><a href="{{ route('docs.index') }}" class="text-gray-700 hover:text-cyan-700">Documentation</a></li>
                        <li><a href="{{ route('docs.testing') }}" class="text-gray-700 hover:text-cyan-700">Testing Guide</a></li>
                        <li><a href="{{ route('docs.troubleshooting') }}" class="text-gray-700 hover:text-cyan-700">Troubleshooting</a></li>
                        <li><a href="{{ route('pricing') }}" class="text-gray-700 hover:text-cyan-700">Pricing</a></li>
                    </ul>
                </div>

                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Follow Us</h3>
                    <div class="flex flex-wrap gap-3">
                        @foreach ($socialLinks as $link)
                            <a href="{{ $link['url'] }}" target="_blank" rel="noreferrer" class="inline-flex items-center gap-2 rounded-lg bg-slate-100 px-3 py-2 text-sm font-semibold text-slate-700 hover:bg-cyan-600 hover:text-white transition-colors">
                                @if ($link['icon'] === 'twitter')
                                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                                    </svg>
                                @elseif ($link['icon'] === 'github')
                                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M12 .5C5.73.5.5 5.73.5 12c0 5.08 3.29 9.39 7.86 10.91.58.11.79-.25.79-.56 0-.28-.01-1.02-.02-2-3.2.7-3.88-1.54-3.88-1.54-.53-1.35-1.29-1.71-1.29-1.71-1.06-.72.08-.7.08-.7 1.17.08 1.79 1.2 1.79 1.2 1.04 1.78 2.74 1.27 3.41.97.1-.75.41-1.27.74-1.56-2.55-.29-5.23-1.28-5.23-5.69 0-1.26.45-2.29 1.19-3.1-.12-.3-.52-1.52.11-3.16 0 0 .98-.31 3.2 1.18a11.06 11.06 0 015.82 0c2.22-1.49 3.2-1.18 3.2-1.18.63 1.64.23 2.86.11 3.16.74.81 1.19 1.84 1.19 3.1 0 4.42-2.68 5.39-5.24 5.67.42.36.79 1.08.79 2.18 0 1.58-.01 2.85-.01 3.24 0 .31.21.68.8.56C20.71 21.39 24 17.08 24 12 24 5.73 18.27.5 12 .5z"/>
                                    </svg>
                                @elseif ($link['icon'] === 'discord')
                                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M20.317 4.369a19.791 19.791 0 00-4.885-1.515.074.074 0 00-.079.037c-.211.375-.444.864-.608 1.249a18.271 18.271 0 00-5.487 0 12.64 12.64 0 00-.617-1.249.077.077 0 00-.079-.037 19.736 19.736 0 00-4.885 1.515.069.069 0 00-.032.027C.533 9.046-.32 13.579.099 18.057a.082.082 0 00.031.056 19.9 19.9 0 005.993 3.03.077.077 0 00.084-.028c.462-.63.874-1.295 1.226-1.994a.076.076 0 00-.041-.105 12.54 12.54 0 01-1.785-.853.077.077 0 01-.008-.128c.12-.09.24-.184.356-.277a.074.074 0 01.077-.01c3.694 1.686 7.69 1.686 11.34 0a.074.074 0 01.078.01c.117.093.236.187.357.277a.077.077 0 01-.006.128 11.59 11.59 0 01-1.786.853.076.076 0 00-.04.105c.36.699.772 1.364 1.225 1.994a.076.076 0 00.084.028 19.876 19.876 0 005.994-3.03.077.077 0 00.031-.056c.5-5.177-.838-9.673-3.548-13.66a.061.061 0 00-.031-.027z"/>
                                    </svg>
                                @elseif ($link['icon'] === 'linkedin')
                                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M4.98 3.5C4.98 5 3.9 6.1 2.4 6.1S-.18 5 .02 3.5C.02 2 1.1.9 2.6.9c1.4 0 2.38 1.1 2.38 2.6zM.5 23.5h3.8V7.9H.5v15.6zM8.1 7.9h3.6v2.1h.1c.5-1 1.7-2.1 3.6-2.1 3.9 0 4.7 2.6 4.7 6v9.6h-3.8v-8.5c0-2-.04-4.6-2.8-4.6-2.8 0-3.3 2.2-3.3 4.5v8.6H8.1V7.9z"/>
                                    </svg>
                                @endif
                                <span>{{ $link['platform'] }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-xl p-8">
                    <div class="flex items-center justify-between mb-8">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900">Send a message</h2>
                            <p class="text-gray-600">Tell us what you need and we will respond quickly.</p>
                        </div>
                        <div class="hidden md:flex items-center gap-2 rounded-full bg-slate-100 px-4 py-2 text-sm font-semibold text-slate-600">
                            Secure form
                        </div>
                    </div>

                    @if (session('success'))
                        <div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-emerald-800">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4 text-red-700">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4 text-red-700">
                            <p class="font-semibold mb-2">Please fix the following:</p>
                            <ul class="list-disc list-inside space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form class="space-y-6" method="POST" action="{{ route('contact.submit') }}">
                        @csrf
                        <div>
                            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Full Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent" required>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Work Email</label>
                                <input type="email" name="email" id="email" value="{{ old('email') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent" required>
                            </div>
                            <div>
                                <label for="phone" class="block text-sm font-semibold text-gray-700 mb-2">Phone (Optional)</label>
                                <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent">
                            </div>
                        </div>

                        <div>
                            <label for="subject" class="block text-sm font-semibold text-gray-700 mb-2">Subject</label>
                            <select id="subject" name="subject" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent" required>
                                @foreach ($subjects as $key => $label)
                                    <option value="{{ $key }}" @if ($selectedSubject === $key) selected @endif>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="message" class="block text-sm font-semibold text-gray-700 mb-2">Message</label>
                            <textarea id="message" name="message" rows="6" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent" required>{{ old('message') }}</textarea>
                        </div>

                        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                            <p class="text-sm text-gray-500">
                                By submitting, you agree to our <a href="{{ route('legal.privacy-policy') }}" class="text-cyan-700 hover:underline">Privacy Policy</a>.
                            </p>
                            <button type="submit" class="inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-cyan-600 to-blue-700 text-white font-bold rounded-lg hover:from-cyan-700 hover:to-blue-800 transition-all duration-200 shadow-lg hover:shadow-xl">
                                Send Message
                            </button>
                        </div>
                    </form>
                </div>

                <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="rounded-2xl bg-white p-5 shadow-md">
                        <p class="text-sm text-gray-500">Docs</p>
                        <p class="text-lg font-semibold text-gray-900">Find integration answers</p>
                        <a href="{{ route('docs.index') }}" class="text-cyan-700 hover:underline text-sm">Browse documentation</a>
                    </div>
                    <div class="rounded-2xl bg-white p-5 shadow-md">
                        <p class="text-sm text-gray-500">Testing</p>
                        <p class="text-lg font-semibold text-gray-900">Sandbox and simulators</p>
                        <a href="{{ route('docs.testing') }}" class="text-cyan-700 hover:underline text-sm">View testing guide</a>
                    </div>
                    <div class="rounded-2xl bg-white p-5 shadow-md">
                        <p class="text-sm text-gray-500">Enterprise</p>
                        <p class="text-lg font-semibold text-gray-900">Custom SLAs and support</p>
                        <a href="{{ route('pricing') }}" class="text-cyan-700 hover:underline text-sm">See pricing</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">Frequently Asked Questions</h2>
            <p class="text-xl text-gray-600">Can't find what you're looking for? Contact us directly.</p>
        </div>

        <div class="max-w-3xl mx-auto space-y-4">
            <div class="bg-gray-50 rounded-xl p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-2">How long does it take to get a response?</h3>
                <p class="text-gray-600">We typically respond to all inquiries within 24 hours during business days.</p>
            </div>
            <div class="bg-gray-50 rounded-xl p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Do you offer phone support?</h3>
                <p class="text-gray-600">Yes, phone support is available for Enterprise customers. Contact us for more information.</p>
            </div>
            <div class="bg-gray-50 rounded-xl p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Can I schedule a demo?</h3>
                <p class="text-gray-600">Absolutely! Fill out the contact form and select "Enterprise Plan" or "Partnership Opportunity" as the subject to request a demo.</p>
            </div>
        </div>
    </div>
</section>
@endsection

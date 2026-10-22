@extends('layouts.app')

@section('title', 'Contact Us - Practical 8')

@section('content')
<div class="max-w-2xl mx-auto space-y-6 py-4">

    <!-- Flash Alert from Component -->
    @if(session('success'))
        <x-alert type="success" title="Inquiry Received!">
            {{ session('success') }}
        </x-alert>
    @else
        <x-alert type="info" title="Form Submission Demo">
            This contact form illustrates secure POST data transmission using the <code>&#64;csrf</code> token and Blade template layouts.
        </x-alert>
    @endif

    <!-- Card Component with Form -->
    <x-card title="Contact &amp; Feedback Form" subtitle="Computer Engineering Department, Government Polytechnic Jamnagar">
        <form action="{{ route('contact.submit') }}" method="POST" class="space-y-4">
            @csrf
            
            <div>
                <label for="name" class="block text-sm font-semibold text-slate-700 mb-1">Full Name</label>
                <input type="text" id="name" name="name" value="{{ old('name', 'Harshit Chavda') }}" 
                       class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" required>
            </div>

            <div>
                <label for="email" class="block text-sm font-semibold text-slate-700 mb-1">Email Address</label>
                <input type="email" id="email" name="email" value="{{ old('email', 'harshit@example.com') }}" 
                       class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" required>
            </div>

            <div>
                <label for="subject" class="block text-sm font-semibold text-slate-700 mb-1">Subject</label>
                <input type="text" id="subject" name="subject" value="Inquiry regarding Practical 8 Blade Template" 
                       class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" required>
            </div>

            <div>
                <label for="message" class="block text-sm font-semibold text-slate-700 mb-1">Message</label>
                <textarea id="message" name="message" rows="4" 
                          class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" required>Hello, this message tests form submission and CSRF protection in Laravel Blade.</textarea>
            </div>

            <button type="submit" 
                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2.5 px-4 rounded-lg text-sm shadow transition cursor-pointer">
                Submit Inquiry (POST)
            </button>
        </form>

        <x-slot name="footer">
            <span class="text-xs text-slate-500">Security: Protected by Laravel &#64;csrf middleware token.</span>
        </x-slot>
    </x-card>

</div>
@endsection

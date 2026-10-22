@extends('layouts.app')

@section('title', 'Home - Practical 8: Reusable Blade Template System')

@section('content')
<div class="max-w-6xl mx-auto space-y-8 py-4">

    <!-- Reusable Component 1: Alert Component with props and $slot -->
    <x-alert type="success" title="Blade Components Working Successfully!">
        This notification is rendered using the custom <strong>&lt;x-alert&gt;</strong> Blade component with <code>&#64;props(['type', 'title'])</code> and dynamic <code>$slot</code> injection.
    </x-alert>

    <!-- Hero Section -->
    <div class="text-center py-6 bg-gradient-to-r from-indigo-50 via-white to-indigo-50 border border-indigo-100 rounded-2xl p-8 shadow-sm">
        <span class="inline-block px-3 py-1 bg-indigo-100 text-indigo-700 font-semibold text-xs rounded-full uppercase tracking-wider mb-3">
            Practical 8 · Blade Templating Engine
        </span>
        <h1 class="text-3xl font-extrabold text-slate-800 tracking-tight sm:text-4xl">
            Reusable Blade Templates &amp; Layouts
        </h1>
        <p class="mt-3 text-base text-slate-600 max-w-2xl mx-auto leading-relaxed">
            Built with Laravel 11 and Tailwind CSS CDN. Demonstrates Master Layouts (<code>&#64;extends</code>, <code>&#64;yield</code>), Partials (<code>&#64;include</code>), and Reusable Components (<code>&lt;x-card&gt;</code> &amp; <code>&lt;x-alert&gt;</code>).
        </p>
    </div>

    <!-- Reusable Component 2: Card Components in Grid with named slots and props -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        
        <x-card title="Master Layout" subtitle="layouts/app.blade.php">
            <p class="text-sm leading-relaxed mb-4">
                Provides the common HTML structure, meta tags, Tailwind CDN, and placeholders using <code>&#64;yield('title')</code>, <code>&#64;yield('content')</code>, and asset stacks.
            </p>
            <x-slot name="footer">
                <div class="flex items-center justify-between text-xs font-semibold text-indigo-600">
                    <span>Directive: &#64;extends</span>
                    <span>✓ Active</span>
                </div>
            </x-slot>
        </x-card>

        <x-card title="Partials System" subtitle="partials/navbar &amp; footer">
            <p class="text-sm leading-relaxed mb-4">
                Modular navigation and footer files included via <code>&#64;include('partials.navbar')</code> with active route highlighting powered by <code>request()->routeIs()</code>.
            </p>
            <x-slot name="footer">
                <div class="flex items-center justify-between text-xs font-semibold text-indigo-600">
                    <span>Directive: &#64;include</span>
                    <span>✓ Active</span>
                </div>
            </x-slot>
        </x-card>

        <x-card title="Blade Components" subtitle="components/alert &amp; card">
            <p class="text-sm leading-relaxed mb-4">
                Autonomous UI building blocks created via <code>&lt;x-alert&gt;</code> and <code>&lt;x-card&gt;</code> supporting typed properties, attribute merging, and scoped slots.
            </p>
            <x-slot name="footer">
                <div class="flex items-center justify-between text-xs font-semibold text-indigo-600">
                    <span>Syntax: &lt;x-component&gt;</span>
                    <span>✓ Active</span>
                </div>
            </x-slot>
        </x-card>

    </div>

    <!-- Additional Demo Card -->
    <x-card title="Blade Features Verified in This View" subtitle="Laravel 11 Best Practices">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
            <div class="p-3 bg-slate-50 rounded-lg border border-slate-200">
                <span class="font-bold text-slate-800">1. Escaped Output:</span>
                <p class="text-slate-600 text-xs mt-1">Using <code>&#123;&#123; $variable &#125;&#125;</code> for automatic XSS protection.</p>
            </div>
            <div class="p-3 bg-slate-50 rounded-lg border border-slate-200">
                <span class="font-bold text-slate-800">2. Active Route Highlighting:</span>
                <p class="text-slate-600 text-xs mt-1">Navbar links dynamically toggle active styling via <code>request()->routeIs('home')</code>.</p>
            </div>
            <div class="p-3 bg-slate-50 rounded-lg border border-slate-200">
                <span class="font-bold text-slate-800">3. CSRF Protection:</span>
                <p class="text-slate-600 text-xs mt-1">All forms are secured using the <code>&#64;csrf</code> directive.</p>
            </div>
            <div class="p-3 bg-slate-50 rounded-lg border border-slate-200">
                <span class="font-bold text-slate-800">4. Component Slots:</span>
                <p class="text-slate-600 text-xs mt-1">Custom default <code>$slot</code> and named <code>&lt;x-slot name="footer"&gt;</code> support.</p>
            </div>
        </div>
    </x-card>

</div>
@endsection

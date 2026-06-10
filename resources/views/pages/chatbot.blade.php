@extends('layouts.app')

@section('title', 'Chatbot - RepairMax')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-900 mb-2">RepairMax Chatbot</h1>
            <p class="text-lg text-gray-600">Chat with our AI assistant about repairs, bookings, and more</p>
        </div>

        <!-- Chatbot Container -->
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
            <!-- Chatbot Widget -->
            <div class="lg:col-span-3">
                <div class="bg-white rounded-lg shadow-xl overflow-hidden">
                    @livewire('chatbot-widget')
                </div>
            </div>

            <!-- Info Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-lg p-6 sticky top-4">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">What can I help with?</h3>
                    
                    <div class="space-y-4">
                        <!-- Repair Status -->
                        <div class="flex items-start gap-3">
                            <div class="flex-shrink-0">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">Repair Status</p>
                                <p class="text-sm text-gray-600">Check your repair progress</p>
                            </div>
                        </div>

                        <!-- Bookings -->
                        <div class="flex items-start gap-3">
                            <div class="flex-shrink-0">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">Book Appointment</p>
                                <p class="text-sm text-gray-600">Schedule repairs at your convenience</p>
                            </div>
                        </div>

                        <!-- Tracking -->
                        <div class="flex items-start gap-3">
                            <div class="flex-shrink-0">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l-5 5m11-5v13l5-5"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">Track Order</p>
                                <p class="text-sm text-gray-600">Real-time repair updates</p>
                            </div>
                        </div>

                        <!-- Support -->
                        <div class="flex items-start gap-3">
                            <div class="flex-shrink-0">
                                <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.172l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">Get Support</p>
                                <p class="text-sm text-gray-600">Connect with our support team</p>
                            </div>
                        </div>

                        <!-- Products -->
                        <div class="flex items-start gap-3">
                            <div class="flex-shrink-0">
                                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">Products</p>
                                <p class="text-sm text-gray-600">Recommended parts & accessories</p>
                            </div>
                        </div>
                    </div>

                    <!-- Divider -->
                    <div class="my-6 border-t border-gray-200"></div>

                    <!-- Quick Actions -->
                    <h4 class="font-semibold text-gray-900 mb-3">Try asking:</h4>
                    <div class="space-y-2">
                        <button class="w-full text-left px-3 py-2 rounded-full hover:bg-blue-50 text-sm text-gray-700 transition">
                            📱 "Where is my repair?"
                        </button>
                        <button class="w-full text-left px-3 py-2 rounded-full hover:bg-blue-50 text-sm text-gray-700 transition">
                            📅 "Book an appointment"
                        </button>
                        <button class="w-full text-left px-3 py-2 rounded-full hover:bg-blue-50 text-sm text-gray-700 transition">
                            💰 "What parts do you have?"
                        </button>
                        <button class="w-full text-left px-3 py-2 rounded-full hover:bg-blue-50 text-sm text-gray-700 transition">
                            ❓ "How much does it cost?"
                        </button>
                    </div>

                    <!-- Status -->
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">Status:</span>
                            <span class="inline-flex items-center gap-1 text-sm">
                                <span class="h-2 w-2 bg-green-500 rounded-full"></span>
                                <span class="text-green-700">Online</span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Features Grid -->
        <div class="mt-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Features</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white rounded-lg p-6 shadow-md hover:shadow-lg transition">
                    <div class="text-2xl mb-2">⚡</div>
                    <h3 class="font-semibold text-gray-900 mb-1">Instant Responses</h3>
                    <p class="text-sm text-gray-600">Get answers immediately to common questions</p>
                </div>

                <div class="bg-white rounded-lg p-6 shadow-md hover:shadow-lg transition">
                    <div class="text-2xl mb-2">🔒</div>
                    <h3 class="font-semibold text-gray-900 mb-1">Secure & Private</h3>
                    <p class="text-sm text-gray-600">Your data is encrypted and protected</p>
                </div>

                <div class="bg-white rounded-lg p-6 shadow-md hover:shadow-lg transition">
                    <div class="text-2xl mb-2">📱</div>
                    <h3 class="font-semibold text-gray-900 mb-1">Mobile Friendly</h3>
                    <p class="text-sm text-gray-600">Chat from any device, anytime</p>
                </div>

                <div class="bg-white rounded-lg p-6 shadow-md hover:shadow-lg transition">
                    <div class="text-2xl mb-2">🤖</div>
                    <h3 class="font-semibold text-gray-900 mb-1">AI Powered</h3>
                    <p class="text-sm text-gray-600">Intelligent conversations powered by n8n</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body {
                background: linear-gradient(135deg, #065f46 0%, #047857 100%);
                min-height: 100vh;
                position: relative;
                overflow-x: hidden;
            }

            body::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: 
                    radial-gradient(circle at 20% 80%, rgba(5, 150, 105, 0.3) 0%, transparent 50%),
                    radial-gradient(circle at 80% 20%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
                    radial-gradient(circle at 40% 40%, rgba(5, 150, 105, 0.2) 0%, transparent 50%);
                animation: float 20s ease-in-out infinite;
            }

            @keyframes float {
                0%, 100% { transform: translateY(0px) rotate(0deg); }
                33% { transform: translateY(-10px) rotate(1deg); }
                66% { transform: translateY(5px) rotate(-1deg); }
            }

            .login-card {
                background: rgba(255, 255, 255, 0.98);
                backdrop-filter: blur(20px);
                border: 1px solid rgba(255, 255, 255, 0.3);
                box-shadow: 
                    0 25px 50px -12px rgba(0, 0, 0, 0.25),
                    0 0 0 1px rgba(255, 255, 255, 0.05),
                    inset 0 1px 0 rgba(255, 255, 255, 0.1);
                animation: slideUp 0.8s ease-out;
                position: relative;
                overflow: hidden;
            }

            .login-card::before {
                content: '';
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
                animation: shimmer 3s infinite;
            }

            @keyframes slideUp {
                from {
                    opacity: 0;
                    transform: translateY(30px) scale(0.95);
                }
                to {
                    opacity: 1;
                    transform: translateY(0) scale(1);
                }
            }

            @keyframes shimmer {
                0% { left: -100%; }
                100% { left: 100%; }
            }

            .btn-primary {
                background: linear-gradient(135deg, #059669 0%, #047857 100%);
                border: none;
                position: relative;
                overflow: hidden;
                transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
                box-shadow: 0 4px 15px rgba(5, 150, 105, 0.4);
            }

            .btn-primary::before {
                content: '';
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
                transition: left 0.5s;
            }

            .btn-primary:hover::before {
                left: 100%;
            }

            .btn-primary:hover {
                background: linear-gradient(135deg, #047857 0%, #065f46 100%);
                transform: translateY(-2px) scale(1.02);
                box-shadow: 0 8px 25px rgba(5, 150, 105, 0.6);
            }

            .btn-primary:active {
                transform: translateY(0) scale(1);
                transition: all 0.1s;
            }

            .form-input {
                border: 2px solid rgba(255, 255, 255, 0.2);
                background: rgba(255, 255, 255, 0.8);
                backdrop-filter: blur(10px);
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                position: relative;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            }

            .form-input:focus {
                border-color: #059669;
                background: rgba(255, 255, 255, 0.95);
                box-shadow: 
                    0 0 0 3px rgba(5, 150, 105, 0.1),
                    0 4px 20px rgba(5, 150, 105, 0.15);
                transform: translateY(-1px);
            }

            .form-input:hover {
                border-color: rgba(5, 150, 105, 0.3);
            }

            .logo-container {
                background: linear-gradient(135deg, #059669 0%, #047857 100%);
                box-shadow: 
                    0 15px 35px rgba(5, 150, 105, 0.4),
                    0 5px 15px rgba(4, 120, 87, 0.3);
                animation: logoPulse 2s ease-in-out infinite;
                position: relative;
                overflow: hidden;
            }

            .logo-container::before {
                content: '';
                position: absolute;
                top: -50%;
                left: -50%;
                width: 200%;
                height: 200%;
                background: conic-gradient(from 0deg, transparent, rgba(255, 255, 255, 0.1), transparent);
                animation: rotate 4s linear infinite;
            }

            @keyframes logoPulse {
                0%, 100% { transform: scale(1); }
                50% { transform: scale(1.05); }
            }

            @keyframes rotate {
                from { transform: rotate(0deg); }
                to { transform: rotate(360deg); }
            }

            .input-icon {
                position: absolute;
                right: 12px;
                top: 50%;
                transform: translateY(-50%);
                color: #9ca3af;
                transition: color 0.3s ease;
            }

            .form-input:focus + .input-icon {
                color: #059669;
            }

            .checkbox-custom {
                appearance: none;
                width: 20px;
                height: 20px;
                border: 2px solid rgba(255, 255, 255, 0.3);
                border-radius: 4px;
                background: rgba(255, 255, 255, 0.8);
                position: relative;
                cursor: pointer;
                transition: all 0.3s ease;
            }

            .checkbox-custom:checked {
                background: linear-gradient(135deg, #059669 0%, #047857 100%);
                border-color: #059669;
            }

            .checkbox-custom:checked::after {
                content: '✓';
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                color: white;
                font-size: 12px;
                font-weight: bold;
            }

            .link-forgot {
                position: relative;
                overflow: hidden;
            }

            .link-forgot::before {
                content: '';
                position: absolute;
                bottom: 0;
                left: 0;
                width: 0;
                height: 1px;
                background: linear-gradient(90deg, #059669, #047857);
                transition: width 0.3s ease;
            }

            .link-forgot:hover::before {
                width: 100%;
            }

            .welcome-text {
                background: linear-gradient(135deg, #059669 0%, #047857 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
                animation: textGlow 2s ease-in-out infinite alternate;
            }

            @keyframes textGlow {
                from { filter: brightness(1); }
                to { filter: brightness(1.2); }
            }

            /* Additional responsive improvements */
            @media (max-width: 640px) {
                .login-card {
                    margin: 0 1rem;
                    animation: none;
                    transform: none !important;
                }
                
                body::before {
                    display: none;
                }
                
                .welcome-text {
                    font-size: 2rem;
                }
            }

            /* Focus improvements for accessibility */
            .form-input:focus,
            .checkbox-custom:focus,
            .btn-primary:focus {
                outline: 2px solid #059669;
                outline-offset: 2px;
            }

            /* Loading state for button */
            .btn-primary.loading {
                pointer-events: none;
                position: relative;
            }

            .btn-primary.loading::after {
                content: '';
                position: absolute;
                width: 20px;
                height: 20px;
                margin: auto;
                border: 2px solid transparent;
                border-top-color: #ffffff;
                border-radius: 50%;
                animation: spin 1s linear infinite;
            }

            /* Smooth transitions for all interactive elements */
            * {
                transition-property: color, background-color, border-color, text-decoration-color, fill, stroke, opacity, box-shadow, transform, filter, backdrop-filter;
                transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
                transition-duration: 300ms;
            }
        </style>
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased">
        @php
            $settings = \App\Models\Setting::first();
        @endphp
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 px-4">
            <div class="logo-container w-20 h-20 rounded-2xl flex items-center justify-center mb-8">
                <a href="/">
                    @if($settings && $settings->logo)
                        <img src="{{ asset('storage/' . $settings->logo) }}" alt="Logo" class="w-16 h-16 object-contain">
                    @else
                        <x-application-logo class="w-12 h-12 fill-current text-white" />
                    @endif
                </a>
            </div>

            <div class="w-full sm:max-w-md">
                <div class="login-card overflow-hidden rounded-2xl">
                    <div class="px-8 py-12">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const form = document.querySelector('form');
                const submitBtn = document.querySelector('.btn-primary');

                if (form && submitBtn) {
                    form.addEventListener('submit', function() {
                        submitBtn.classList.add('loading');
                        submitBtn.innerHTML = '<span class="flex items-center justify-center"><span class="animate-spin rounded-full h-5 w-5 border-b-2 border-white mr-2"></span>Memproses...</span>';
                        submitBtn.disabled = true;
                    });
                }

                // Add subtle animation to inputs on focus
                const inputs = document.querySelectorAll('.form-input');
                inputs.forEach(input => {
                    input.addEventListener('focus', function() {
                        this.parentElement.style.transform = 'scale(1.02)';
                    });
                    
                    input.addEventListener('blur', function() {
                        this.parentElement.style.transform = 'scale(1)';
                    });
                });

                // Add ripple effect to button
                submitBtn.addEventListener('click', function(e) {
                    const ripple = document.createElement('span');
                    ripple.style.position = 'absolute';
                    ripple.style.borderRadius = '50%';
                    ripple.style.background = 'rgba(255, 255, 255, 0.6)';
                    ripple.style.transform = 'scale(0)';
                    ripple.style.animation = 'ripple 0.6s linear';
                    ripple.style.left = (e.offsetX - 10) + 'px';
                    ripple.style.top = (e.offsetY - 10) + 'px';
                    ripple.style.width = '20px';
                    ripple.style.height = '20px';
                    
                    this.appendChild(ripple);
                    
                    setTimeout(() => {
                        ripple.remove();
                    }, 600);
                });
            });

            // Add ripple animation
            const style = document.createElement('style');
            style.textContent = `
                @keyframes ripple {
                    to {
                        transform: scale(4);
                        opacity: 0;
                    }
                }
            `;
            document.head.appendChild(style);
        </script>

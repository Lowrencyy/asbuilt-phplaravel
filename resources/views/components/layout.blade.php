<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@stack('title', 'Dashboard') | Telcovantage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description">
    <meta content="Coderthemes" name="author">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    <!-- App css -->
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css">

    <!-- Icons css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css">

    <!-- Theme Config Js -->
    <script src="{{ asset('assets/js/config.js') }}"></script>

    <!-- Page Styles -->
    @stack('styles')

    <style>
        .app-header {
            padding-top: env(safe-area-inset-top);
        }

        body {
            padding-bottom: env(safe-area-inset-bottom);
        }

        :root {
            --helper-primary: #2563eb;
            --helper-primary-2: #1d4ed8;
            --helper-dark: #081225;
            --helper-dark-2: #0f172a;
            --helper-panel: rgba(255, 255, 255, 0.96);
            --helper-border: rgba(148, 163, 184, 0.22);
            --helper-muted: #64748b;
            --helper-user: linear-gradient(135deg, #2563eb, #1d4ed8);
            --helper-bot: #f8fafc;
            --helper-system: #fff7ed;
            --helper-shadow: 0 24px 60px rgba(2, 6, 23, 0.22);
            --helper-shadow-soft: 0 10px 25px rgba(15, 23, 42, 0.08);
            --helper-radius: 22px;
            --helper-z: 9999;
        }

        .helper-launcher {
            position: fixed;
            right: 22px;
            bottom: 22px;
            z-index: var(--helper-z);
            width: 60px;
            height: 60px;
            border: 0;
            border-radius: 9999px;
            background:
                radial-gradient(circle at 30% 30%, rgba(255,255,255,.22), transparent 35%),
                linear-gradient(135deg, var(--helper-primary), var(--helper-primary-2));
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 18px 40px rgba(37, 99, 235, 0.32);
            cursor: pointer;
            transition: transform .2s ease, box-shadow .2s ease, opacity .2s ease;
        }

        .helper-launcher:hover {
            transform: translateY(-3px) scale(1.03);
            box-shadow: 0 22px 45px rgba(37, 99, 235, 0.38);
        }

        .helper-launcher.hidden {
            display: none !important;
        }

        .helper-chat {
            position: fixed;
            right: 22px;
            bottom: 22px;
            z-index: calc(var(--helper-z) + 1);
            width: 390px;
            height: 640px;
            max-width: calc(100vw - 24px);
            max-height: calc(100vh - 24px);
            border-radius: var(--helper-radius);
            background: var(--helper-panel);
            border: 1px solid var(--helper-border);
            box-shadow: var(--helper-shadow);
            overflow: hidden;
            display: none;
            flex-direction: column;
            backdrop-filter: blur(16px);
        }

        .helper-chat.show {
            display: flex;
        }

        .helper-chat.minimized {
            height: 82px !important;
        }

        .helper-header {
            position: relative;
            flex-shrink: 0;
            padding: 14px 16px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            background:
                radial-gradient(circle at top left, rgba(59, 130, 246, 0.25), transparent 30%),
                linear-gradient(135deg, var(--helper-dark), var(--helper-dark-2));
            color: #fff;
            border-bottom: 1px solid rgba(255,255,255,0.06);
        }

        .helper-header::after {
            content: "";
            position: absolute;
            inset: auto 0 0 0;
            height: 1px;
            background: linear-gradient(to right, transparent, rgba(255,255,255,0.2), transparent);
        }

        .helper-header-left {
            display: flex;
            align-items: center;
            gap: 12px;
            min-width: 0;
        }

        .helper-logo {
            width: 42px;
            height: 42px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            background: linear-gradient(135deg, rgba(255,255,255,0.14), rgba(255,255,255,0.08));
            border: 1px solid rgba(255,255,255,0.10);
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.08);
        }

        .helper-title-wrap {
            min-width: 0;
        }

        .helper-title {
            margin: 0;
            font-size: 14px;
            font-weight: 700;
            line-height: 1.2;
            letter-spacing: .2px;
        }

        .helper-subtitle {
            margin-top: 3px;
            font-size: 11px;
            color: rgba(255,255,255,0.72);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .helper-actions {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-shrink: 0;
        }

        .helper-btn-icon {
            width: 34px;
            height: 34px;
            border: 0;
            border-radius: 11px;
            background: rgba(255,255,255,0.10);
            color: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: transform .18s ease, background .18s ease, opacity .18s ease;
        }

        .helper-btn-icon:hover {
            transform: scale(1.04);
            background: rgba(255,255,255,0.16);
        }

        .helper-body {
            display: flex;
            flex-direction: column;
            min-height: 0;
            flex: 1;
            background:
                radial-gradient(circle at top right, rgba(37, 99, 235, 0.07), transparent 24%),
                radial-gradient(circle at bottom left, rgba(14, 165, 233, 0.05), transparent 20%),
                linear-gradient(to bottom, #f8fbff, #ffffff);
        }

        .helper-chat.minimized .helper-body {
            display: none;
        }

        .helper-messages {
            flex: 1;
            min-height: 0;
            overflow-y: auto;
            padding: 18px;
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .helper-messages::-webkit-scrollbar {
            width: 6px;
        }

        .helper-messages::-webkit-scrollbar-thumb {
            background: rgba(148, 163, 184, 0.35);
            border-radius: 999px;
        }

        .helper-message-row {
            display: flex;
        }

        .helper-message-row.user {
            justify-content: flex-end;
        }

        .helper-message-row.bot,
        .helper-message-row.system {
            justify-content: flex-start;
        }

        .helper-bubble {
            max-width: 84%;
            padding: 13px 15px;
            border-radius: 18px;
            font-size: 13px;
            line-height: 1.55;
            white-space: pre-wrap;
            word-break: break-word;
            box-shadow: var(--helper-shadow-soft);
        }

        .helper-message-row.user .helper-bubble {
            background: var(--helper-user);
            color: #fff;
            border-bottom-right-radius: 7px;
        }

        .helper-message-row.bot .helper-bubble {
            background: var(--helper-bot);
            color: #0f172a;
            border: 1px solid rgba(226, 232, 240, 0.9);
            border-bottom-left-radius: 7px;
        }

        .helper-message-row.system .helper-bubble {
            background: var(--helper-system);
            color: #9a3412;
            border: 1px solid #fed7aa;
            border-bottom-left-radius: 7px;
        }

        .helper-typing {
            display: none;
            padding: 0 18px 12px;
            color: var(--helper-muted);
            font-size: 12px;
        }

        .helper-typing.show {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .helper-dots {
            display: inline-flex;
            gap: 4px;
            align-items: center;
        }

        .helper-dots span {
            width: 6px;
            height: 6px;
            border-radius: 999px;
            background: #94a3b8;
            animation: helper-bounce 1.2s infinite ease-in-out;
        }

        .helper-dots span:nth-child(2) {
            animation-delay: .15s;
        }

        .helper-dots span:nth-child(3) {
            animation-delay: .3s;
        }

        @keyframes helper-bounce {
            0%, 80%, 100% {
                transform: scale(.7);
                opacity: .55;
            }
            40% {
                transform: scale(1);
                opacity: 1;
            }
        }

        .helper-input-wrap {
            flex-shrink: 0;
            padding: 14px;
            border-top: 1px solid rgba(226, 232, 240, 0.9);
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(10px);
        }

        .helper-form {
            display: flex;
            align-items: flex-end;
            gap: 10px;
        }

        .helper-textarea {
            flex: 1;
            resize: none;
            min-height: 48px;
            max-height: 140px;
            border-radius: 16px;
            border: 1px solid #dbe4ee;
            background: #fff;
            padding: 13px 15px;
            font-size: 13px;
            line-height: 1.45;
            color: #0f172a;
            outline: none;
            box-shadow: inset 0 1px 2px rgba(15, 23, 42, 0.03);
            transition: border-color .18s ease, box-shadow .18s ease;
        }

        .helper-textarea:focus {
            border-color: #93c5fd;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.10);
        }

        .helper-send {
            width: 48px;
            height: 48px;
            flex-shrink: 0;
            border: 0;
            border-radius: 16px;
            color: #fff;
            background: linear-gradient(135deg, var(--helper-primary), var(--helper-primary-2));
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 14px 24px rgba(37, 99, 235, 0.24);
            transition: transform .18s ease, box-shadow .18s ease, opacity .18s ease;
        }

        .helper-send:hover {
            transform: translateY(-1px);
            box-shadow: 0 18px 28px rgba(37, 99, 235, 0.28);
        }

        .helper-send:disabled {
            opacity: .65;
            cursor: not-allowed;
        }

        .helper-footer-note {
            margin-top: 8px;
            text-align: center;
            font-size: 11px;
            color: var(--helper-muted);
        }

        @media (max-width: 640px) {
            .helper-launcher {
                right: 14px;
                bottom: 14px;
                width: 58px;
                height: 58px;
            }

            .helper-chat {
                right: 10px;
                left: 10px;
                bottom: 10px;
                width: auto;
                height: min(78vh, 650px);
                max-width: none;
            }
        }
    </style>
</head>

<body>

    <div class="flex wrapper">

        <!-- Sidenav Menu -->
        @include('partials._sidenav')
        <!-- Sidenav Menu End -->

        <div class="page-content">

            <!-- Topbar Start -->
            @include('partials._header')
            <!-- Topbar End -->

            <!-- Topbar Search Modal -->
            @include('partials._topbarsearchmodal')

            <main class="flex-grow p-6">

                <!-- Page Title Start -->
                @include('partials._pagetitle')
                <!-- Page Title End -->

                <div class="grid 2xl:grid-cols-4 gap-6 mb-6">
                    {{ $slot }}
                </div>

            </main>

            <!-- Footer Start -->
            @include('partials._footer')
            <!-- Footer End -->

        </div>
    </div>

    <!-- HELPER CHATBOT -->
    <button id="helperLauncher" class="helper-launcher" type="button" aria-label="Open Helper Chat">
        <i class="mgc_message_3_line text-2xl"></i>
    </button>

    <section id="helperChat" class="helper-chat" aria-hidden="true">
        <div class="helper-header">
            <div class="helper-header-left">
                <div class="helper-logo">
                    <i class="mgc_ai_line text-xl"></i>
                </div>
                <div class="helper-title-wrap">
                    <h3 class="helper-title">Telcovantage AsbuiltIQ</h3>
                    <div class="helper-subtitle">How Can I Help You?</div>
                </div>
            </div>

            <div class="helper-actions">
                <button id="helperMinimizeBtn" class="helper-btn-icon" type="button" title="Minimize">
                    <i class="mgc_minus_line text-lg"></i>
                </button>
                <button id="helperCloseBtn" class="helper-btn-icon" type="button" title="Close">
                    <i class="mgc_close_line text-lg"></i>
                </button>
            </div>
        </div>

        <div class="helper-body">
            <div id="helperMessages" class="helper-messages"></div>

            <div id="helperTyping" class="helper-typing">
                <span class="helper-dots">
                    <span></span>
                    <span></span>
                    <span></span>
                </span>
                <span>Asbuilt Iq Is Typing</span>
            </div>

            <div class="helper-input-wrap">
                <form id="helperForm" class="helper-form">
                    <textarea
                        id="helperInput"
                        class="helper-textarea"
                        placeholder="Ask about records, reports, tickets, clients, or any DB data..."
                        rows="1"></textarea>

                    <button id="helperSendBtn" class="helper-send" type="submit" aria-label="Send">
                        <i class="mgc_send_plane_fill text-lg"></i>
                    </button>
                </form>

                <div class="helper-footer-note">
                    Temporary chat only. Messages are cleared when closed.
                </div>
            </div>
        </div>
    </section>

    <!-- Plugin Js -->
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/libs/@frostui/tailwindcss/frostui.js') }}"></script>

    <!-- App Js -->
    <script src="{{ asset('assets/js/app.js') }}"></script>

    <script>
        (function () {
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

            const launcher = document.getElementById('helperLauncher');
            const chat = document.getElementById('helperChat');
            const closeBtn = document.getElementById('helperCloseBtn');
            const minimizeBtn = document.getElementById('helperMinimizeBtn');
            const form = document.getElementById('helperForm');
            const input = document.getElementById('helperInput');
            const sendBtn = document.getElementById('helperSendBtn');
            const messages = document.getElementById('helperMessages');
            const typing = document.getElementById('helperTyping');

            let isOpen = false;
            let isSending = false;
            let abortController = null;

            function autoResizeTextarea(el) {
                el.style.height = '48px';
                el.style.height = Math.min(el.scrollHeight, 140) + 'px';
            }

            function scrollToBottom() {
                messages.scrollTop = messages.scrollHeight;
            }

            function setTyping(state) {
                typing.classList.toggle('show', state);
                scrollToBottom();
            }

            function createMessage(content, type = 'bot') {
                const row = document.createElement('div');
                row.className = `helper-message-row ${type}`;

                const bubble = document.createElement('div');
                bubble.className = 'helper-bubble';
                bubble.textContent = content;

                row.appendChild(bubble);
                messages.appendChild(row);
                scrollToBottom();
            }

            function clearChatWindow() {
                messages.innerHTML = '';
                input.value = '';
                input.style.height = '48px';
                setTyping(false);

                if (abortController) {
                    abortController.abort();
                    abortController = null;
                }

                isSending = false;
                sendBtn.disabled = false;

                try {
                    sessionStorage.removeItem('helper_chat_draft');
                    localStorage.removeItem('helper_chat_draft');
                } catch (e) {}
            }

            function seedWelcomeMessage() {
                createMessage(
                    "Hi! I’m AsbuiltIQ.\n\nYou can ask me about database records, tickets, reports, customer data, and other helper queries connected to your Ollama endpoint.",
                    'bot'
                );
            }

            function openChat() {
                isOpen = true;
                chat.classList.add('show');
                chat.classList.remove('minimized');
                launcher.classList.add('hidden');
                chat.setAttribute('aria-hidden', 'false');

                if (!messages.children.length) {
                    seedWelcomeMessage();
                }

                setTimeout(() => input.focus(), 150);
            }

            function closeChat() {
                isOpen = false;
                chat.classList.remove('show', 'minimized');
                launcher.classList.remove('hidden');
                chat.setAttribute('aria-hidden', 'true');
                clearChatWindow();
            }

            function toggleMinimize() {
                chat.classList.toggle('minimized');
            }

            async function sendMessage(messageText) {
                const text = (messageText || '').trim();
                if (!text || isSending) return;

                isSending = true;
                sendBtn.disabled = true;

                createMessage(text, 'user');
                input.value = '';
                autoResizeTextarea(input);
                setTyping(true);

                abortController = new AbortController();

                try {
                    const response = await fetch('{{ url("/helper/chat") }}', {
                        method: 'POST',
                        signal: abortController.signal,
                        cache: 'no-store',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'Cache-Control': 'no-cache, no-store, must-revalidate',
                            'Pragma': 'no-cache',
                            'Expires': '0'
                        },
                        body: JSON.stringify({
                            message: text
                        })
                    });

                    const data = await response.json();

                    if (!response.ok) {
                        throw new Error(data?.message || 'Failed to get response from helper.');
                    }

                    createMessage(data?.reply || 'No response received from helper.', 'bot');
                } catch (error) {
                    if (error.name === 'AbortError') {
                        createMessage('Request cancelled.', 'system');
                    } else {
                        createMessage(error.message || 'Something went wrong while contacting the helper.', 'system');
                    }
                } finally {
                    setTyping(false);
                    isSending = false;
                    sendBtn.disabled = false;
                    abortController = null;
                    input.focus();
                }
            }

            launcher.addEventListener('click', openChat);
            closeBtn.addEventListener('click', closeChat);
            minimizeBtn.addEventListener('click', toggleMinimize);

            form.addEventListener('submit', function (e) {
                e.preventDefault();
                sendMessage(input.value);
            });

            input.addEventListener('input', function () {
                autoResizeTextarea(this);
            });

            input.addEventListener('keydown', function (e) {
                if (e.key === 'Enter' && !e.shiftKey) {
                    e.preventDefault();
                    form.requestSubmit();
                }
            });

            document.addEventListener('keydown', function (e) {
                if (!isOpen) return;

                if (e.key === 'Escape') {
                    closeChat();
                }
            });
        })();
    </script>

    <!-- Additional Page Scripts -->
    @stack('scripts')

</body>

</html>
@props(['order', 'userType', 'fetchUrl', 'sendUrl'])

<div class="custom-card animate__animated animate__fadeInUp d-flex flex-column shadow-sm" style="height: 520px; padding: 0; border-radius: 20px; border: 1px solid rgba(0,0,0,0.05); overflow: hidden;">
    <!-- Chat Header -->
    <div class="p-3 border-bottom d-flex align-items-center justify-content-between bg-white">
        <div class="d-flex align-items-center gap-2">
            <div style="width: 38px; height: 38px; background: linear-gradient(135deg, #E23744 0%, #FF6B35 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 1rem;">
                <i class="fas fa-comments"></i>
            </div>
            <div>
                <h6 class="fw-bold mb-0 text-dark" style="font-size: 0.95rem;">
                    @if($userType === 'user')
                        Chat with Chef
                    @else
                        Chat with Customer
                    @endif
                </h6>
                <small class="text-muted d-flex align-items-center gap-1" style="font-size: 0.75rem;">
                    <span class="pulse-dot"></span> Active Order Support
                </small>
            </div>
        </div>
        <span class="badge bg-light text-muted" style="font-size: 0.75rem;">Order #{{ $order->id }}</span>
    </div>

    <!-- Chat Messages Area -->
    <div id="chat-messages-container" class="flex-grow-1 p-3 overflow-y-auto d-flex flex-column gap-2" style="background: #f8fafc !important;">
        <!-- Loading spinner -->
        <div id="chat-loading" class="text-center py-5">
            <div class="spinner-border text-danger spinner-border-sm" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>

    <!-- Chat Input Form -->
    <form id="chat-form" class="p-3 border-top bg-white">
        <div class="input-group">
            <input type="text" id="chat-input" class="form-control rounded-pill px-3" placeholder="Type a message..." aria-label="Message text" maxlength="1000" required autocomplete="off" style="font-size: 0.9rem; border: 1px solid #cbd5e1; box-shadow: none;">
            <button class="btn btn-primary rounded-circle ms-2 d-flex align-items-center justify-content-center" type="submit" id="chat-send-btn" style="width: 40px; height: 40px; background: linear-gradient(135deg, #E23744 0%, #FF6B35 100%); border: none; box-shadow: 0 4px 10px rgba(226, 55, 68, 0.2);">
                <i class="fas fa-paper-plane text-white" style="font-size: 0.85rem;"></i>
            </button>
        </div>
    </form>
</div>

<style>
    .pulse-dot {
        width: 8px;
        height: 8px;
        background-color: #10b981;
        border-radius: 50%;
        display: inline-block;
        animation: pulse-animation 2s infinite ease-in-out;
    }

    @keyframes pulse-animation {
        0% { transform: scale(0.9); opacity: 1; }
        50% { transform: scale(1.2); opacity: 0.6; }
        100% { transform: scale(0.9); opacity: 1; }
    }

    /* Bubble styles */
    .bubble-wrapper {
        display: flex;
        flex-direction: column;
        max-width: 80%;
    }

    .bubble-wrapper.outgoing {
        align-self: flex-end;
        align-items: flex-end;
    }

    .bubble-wrapper.incoming {
        align-self: flex-start;
        align-items: flex-start;
    }

    .bubble-content {
        padding: 10px 14px;
        border-radius: 16px;
        font-size: 0.88rem;
        line-height: 1.4;
        word-break: break-word;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
    }

    .bubble-wrapper.outgoing .bubble-content {
        background: linear-gradient(135deg, #E23744 0%, #FF6B35 100%);
        color: white;
        border-bottom-right-radius: 4px;
    }

    .bubble-wrapper.incoming .bubble-content {
        background: white;
        color: #1f2937;
        border-bottom-left-radius: 4px;
        border: 1px solid #e2e8f0;
    }

    .bubble-meta {
        font-size: 0.7rem;
        color: #94a3b8;
        margin-top: 2px;
        padding: 0 4px;
    }

    /* Custom thin scrollbar */
    #chat-messages-container::-webkit-scrollbar {
        width: 5px;
    }
    #chat-messages-container::-webkit-scrollbar-track {
        background: transparent;
    }
    #chat-messages-container::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 10px;
    }
    #chat-messages-container::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const messagesContainer = document.getElementById('chat-messages-container');
    const chatForm = document.getElementById('chat-form');
    const chatInput = document.getElementById('chat-input');
    const fetchUrl = "{{ $fetchUrl }}";
    const sendUrl = "{{ $sendUrl }}";
    const userType = "{{ $userType }}";
    
    let messageIds = new Set();
    let isPolling = false;

    // Scroll to bottom helper
    function scrollToBottom(behavior = 'smooth') {
        messagesContainer.scrollTo({
            top: messagesContainer.scrollHeight,
            behavior: behavior
        });
    }

    // Format timestamp
    function formatTime(dateString) {
        const date = new Date(dateString);
        return date.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
    }

    // Render message item
    function renderMessage(message) {
        const isOutgoing = message.sender_type === userType;
        const wrapper = document.createElement('div');
        wrapper.className = `bubble-wrapper ${isOutgoing ? 'outgoing' : 'incoming'}`;
        wrapper.setAttribute('data-message-id', message.id);

        const content = document.createElement('div');
        content.className = 'bubble-content';
        content.textContent = message.message;

        const meta = document.createElement('div');
        meta.className = 'bubble-meta';
        meta.textContent = formatTime(message.created_at);

        wrapper.appendChild(content);
        wrapper.appendChild(meta);
        return wrapper;
    }

    // Fetch messages
    async function fetchMessages() {
        if (isPolling) return;
        isPolling = true;

        try {
            const response = await fetch(fetchUrl);
            if (!response.ok) throw new Error('Failed to fetch messages');
            
            const data = await response.json();
            const messages = data.messages || [];
            
            // Remove loading spinner on first load
            const loadingSpinner = document.getElementById('chat-loading');
            if (loadingSpinner) {
                loadingSpinner.remove();
            }

            // If empty and no messages in Set
            if (messages.length === 0 && messageIds.size === 0) {
                if (!document.getElementById('chat-empty-state')) {
                    const emptyState = document.createElement('div');
                    emptyState.id = 'chat-empty-state';
                    emptyState.className = 'text-center py-5 text-muted my-auto';
                    emptyState.innerHTML = `
                        <i class="far fa-comments fa-3x mb-3 text-danger" style="opacity: 0.3;"></i>
                        <p class="small mb-0 fw-medium">No messages yet</p>
                        <p class="small text-muted" style="font-size: 0.8rem;">Send a message to start the conversation!</p>
                    `;
                    messagesContainer.appendChild(emptyState);
                }
                isPolling = false;
                return;
            }

            let newMessagesAdded = false;

            messages.forEach(msg => {
                if (!messageIds.has(msg.id)) {
                    // Remove empty state if present
                    const emptyState = document.getElementById('chat-empty-state');
                    if (emptyState) emptyState.remove();

                    messageIds.add(msg.id);
                    const msgEl = renderMessage(msg);
                    messagesContainer.appendChild(msgEl);
                    newMessagesAdded = true;
                }
            });

            if (newMessagesAdded) {
                scrollToBottom(messageIds.size <= messages.length ? 'auto' : 'smooth');
            }

        } catch (error) {
            console.error('Error fetching messages:', error);
        } finally {
            isPolling = false;
        }
    }

    // Send message
    chatForm.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const messageText = chatInput.value.trim();
        if (!messageText) return;

        chatInput.value = '';
        chatInput.focus();

        try {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            
            const response = await fetch(sendUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ message: messageText })
            });

            if (!response.ok) throw new Error('Failed to send message');
            
            const data = await response.json();
            
            if (data.status === 'success') {
                // Immediately append sent message to feel fast
                const emptyState = document.getElementById('chat-empty-state');
                if (emptyState) emptyState.remove();

                if (!messageIds.has(data.message.id)) {
                    messageIds.add(data.message.id);
                    const msgEl = renderMessage(data.message);
                    messagesContainer.appendChild(msgEl);
                    scrollToBottom();
                }
            }

        } catch (error) {
            console.error('Error sending message:', error);
            alert('Failed to send message. Please try again.');
        }
    });

    // Start Polling
    fetchMessages(); // initial load
    setInterval(fetchMessages, 3000); // Poll every 3 seconds
});
</script>

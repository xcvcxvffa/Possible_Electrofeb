<style>
    .custom-toast {
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(0, 0, 0, 0.04);
        padding: 16px;
        width: 380px;
        max-width: 100%;
        display: flex;
        align-items: flex-start;
        gap: 16px;
        margin-bottom: 16px;
        position: relative;
        overflow: hidden;
    }
    
    /* Background gradients matching the screenshot */
    .custom-toast.toast-success::before {
        content: '';
        position: absolute;
        top: 0; left: 0; width: 100px; height: 100%;
        background: radial-gradient(circle at top left, rgba(16, 185, 129, 0.15), transparent 70%);
        pointer-events: none;
    }
    .custom-toast.toast-error::before {
        content: '';
        position: absolute;
        top: 0; left: 0; width: 100px; height: 100%;
        background: radial-gradient(circle at top left, rgba(239, 68, 68, 0.15), transparent 70%);
        pointer-events: none;
    }
    .custom-toast.toast-warning::before {
        content: '';
        position: absolute;
        top: 0; left: 0; width: 100px; height: 100%;
        background: radial-gradient(circle at top left, rgba(245, 158, 11, 0.15), transparent 70%);
        pointer-events: none;
    }
    .custom-toast.toast-info::before {
        content: '';
        position: absolute;
        top: 0; left: 0; width: 100px; height: 100%;
        background: radial-gradient(circle at top left, rgba(59, 130, 246, 0.15), transparent 70%);
        pointer-events: none;
    }

    .custom-toast .toast-icon-wrapper {
        width: 40px;
        height: 40px;
        background: #ffffff;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        box-shadow: 0 4px 12px rgba(0,0,0,0.06);
        border: 1px solid rgba(0,0,0,0.03);
        position: relative;
        z-index: 1;
    }
    
    .custom-toast .toast-icon {
        font-size: 20px;
    }

    .custom-toast.toast-success .toast-icon { color: #10b981; }
    .custom-toast.toast-error .toast-icon { color: #ef4444; }
    .custom-toast.toast-warning .toast-icon { color: #f59e0b; }
    .custom-toast.toast-info .toast-icon { color: #3b82f6; }

    .custom-toast-content {
        flex-grow: 1;
        position: relative;
        z-index: 1;
        padding-top: 2px;
    }
    .custom-toast-title {
        font-weight: 600;
        color: #111827;
        font-size: 15px;
        margin-bottom: 4px;
    }
    .custom-toast-msg {
        color: #6b7280;
        font-size: 14px;
        line-height: 1.4;
        margin: 0;
    }
    .custom-toast-close {
        background: none;
        border: none;
        color: #9ca3af;
        padding: 0;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: color 0.2s;
        position: relative;
        z-index: 1;
        font-size: 16px;
    }
    .custom-toast-close:hover {
        color: #4b5563;
    }
</style>

<div aria-live="polite" aria-atomic="true" style="position: relative; z-index: 9999;">
    <!-- Position bottom-0 end-0 per user request -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3 mb-2">
        
        <!-- Validation Errors -->
        @if($errors->any())
            @foreach($errors->all() as $error)
                <div class="toast custom-toast toast-error fade show" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="6000">
                    <div class="toast-icon-wrapper">
                        <i class="ti ti-exclamation-circle toast-icon"></i>
                    </div>
                    <div class="custom-toast-content">
                        <div class="custom-toast-title">Error</div>
                        <p class="custom-toast-msg">{{ $error }}</p>
                    </div>
                    <button type="button" class="custom-toast-close" data-bs-dismiss="toast" aria-label="Close">
                        <i class="ti ti-x"></i>
                    </button>
                </div>
            @endforeach
        @endif

        <!-- Success Flash -->
        @if(session('success'))
            <div class="toast custom-toast toast-success fade show" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="5000">
                <div class="toast-icon-wrapper">
                    <i class="ti ti-circle-check toast-icon"></i>
                </div>
                <div class="custom-toast-content">
                    <div class="custom-toast-title">Success</div>
                    <p class="custom-toast-msg">{{ session('success') }}</p>
                </div>
                <button type="button" class="custom-toast-close" data-bs-dismiss="toast" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
        @endif

        <!-- Error Flash -->
        @if(session('error'))
            <div class="toast custom-toast toast-error fade show" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="6000">
                <div class="toast-icon-wrapper">
                    <i class="ti ti-exclamation-circle toast-icon"></i>
                </div>
                <div class="custom-toast-content">
                    <div class="custom-toast-title">Error</div>
                    <p class="custom-toast-msg">{{ session('error') }}</p>
                </div>
                <button type="button" class="custom-toast-close" data-bs-dismiss="toast" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
        @endif

        <!-- Warning Flash -->
        @if(session('warning'))
            <div class="toast custom-toast toast-warning fade show" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="6000">
                <div class="toast-icon-wrapper">
                    <i class="ti ti-alert-triangle toast-icon"></i>
                </div>
                <div class="custom-toast-content">
                    <div class="custom-toast-title">Warning</div>
                    <p class="custom-toast-msg">{{ session('warning') }}</p>
                </div>
                <button type="button" class="custom-toast-close" data-bs-dismiss="toast" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
        @endif

        <!-- Info Flash -->
        @if(session('info') || session('status'))
            <div class="toast custom-toast toast-info fade show" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="5000">
                <div class="toast-icon-wrapper">
                    <i class="ti ti-info-circle toast-icon"></i>
                </div>
                <div class="custom-toast-content">
                    <div class="custom-toast-title">Information</div>
                    <p class="custom-toast-msg">{{ session('info') ?? session('status') }}</p>
                </div>
                <button type="button" class="custom-toast-close" data-bs-dismiss="toast" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
        @endif

    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var toastElList = [].slice.call(document.querySelectorAll('.toast'))
        var toastList = toastElList.map(function (toastEl) {
            var toast = new bootstrap.Toast(toastEl, {
                autohide: true,
                delay: parseInt(toastEl.getAttribute('data-bs-delay')) || 5000
            })
            toast.show()
            return toast
        })
    });
</script>

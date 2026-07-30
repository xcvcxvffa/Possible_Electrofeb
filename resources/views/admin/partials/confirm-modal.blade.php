{{-- Custom Confirm Dialog Modal — Modern Redesign --}}
<style>
    .custom-confirm-overlay {
        position: fixed;
        inset: 0;
        background: rgba(2, 6, 23, 0.6);
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        z-index: 99998;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 16px;
    }
    .custom-confirm-overlay.active {
        display: flex;
        animation: ccOverlayIn 0.22s ease forwards;
    }
    @keyframes ccOverlayIn {
        from { opacity: 0; }
        to   { opacity: 1; }
    }

    .custom-confirm-box {
        background: #ffffff;
        border-radius: 20px;
        width: 400px;
        max-width: 100%;
        box-shadow: 0 32px 80px rgba(0, 0, 0, 0.22), 0 0 0 1px rgba(0,0,0,0.04);
        overflow: hidden;
        position: relative;
        animation: ccBoxIn 0.28s cubic-bezier(0.22, 1, 0.36, 1) forwards;
    }
    @keyframes ccBoxIn {
        from { opacity: 0; transform: scale(0.9) translateY(24px); }
        to   { opacity: 1; transform: scale(1)   translateY(0); }
    }

    /* Top colored strip */
    .custom-confirm-strip {
        height: 5px;
        width: 100%;
    }
    .custom-confirm-strip.danger  { background: linear-gradient(90deg, #ef4444, #f97316); }
    .custom-confirm-strip.warning { background: linear-gradient(90deg, #f59e0b, #eab308); }

    .custom-confirm-body {
        padding: 36px 32px 32px;
        text-align: center;
    }

    /* Icon bubble */
    .custom-confirm-icon-wrap {
        width: 72px;
        height: 72px;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 22px;
        position: relative;
    }
    .custom-confirm-icon-wrap.danger  { background: linear-gradient(135deg, #fef2f2, #fee2e2); box-shadow: 0 8px 24px rgba(239,68,68,0.18); }
    .custom-confirm-icon-wrap.warning { background: linear-gradient(135deg, #fffbeb, #fef3c7); box-shadow: 0 8px 24px rgba(245,158,11,0.18); }
    .custom-confirm-icon-wrap .cc-icon {
        font-size: 30px;
    }
    .custom-confirm-icon-wrap.danger  .cc-icon { color: #ef4444; }
    .custom-confirm-icon-wrap.warning .cc-icon { color: #f59e0b; }

    /* Pulse ring */
    .custom-confirm-icon-wrap::before {
        content: '';
        position: absolute;
        inset: -6px;
        border-radius: 26px;
        opacity: 0.35;
        animation: ccPulse 2s ease-in-out infinite;
    }
    .custom-confirm-icon-wrap.danger::before  { border: 2px solid #ef4444; }
    .custom-confirm-icon-wrap.warning::before { border: 2px solid #f59e0b; }
    @keyframes ccPulse {
        0%, 100% { transform: scale(1); opacity: 0.35; }
        50%       { transform: scale(1.08); opacity: 0.1; }
    }

    .custom-confirm-title {
        font-size: 20px;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 10px;
        letter-spacing: -0.3px;
    }
    .custom-confirm-message {
        font-size: 14px;
        color: #64748b;
        line-height: 1.65;
        margin-bottom: 30px;
        max-width: 300px;
        margin-left: auto;
        margin-right: auto;
    }

    /* Actions */
    .custom-confirm-actions {
        display: flex;
        gap: 10px;
    }
    .cc-btn {
        flex: 1;
        padding: 13px 18px;
        border-radius: 12px;
        font-size: 14px;
        font-weight: 600;
        border: none;
        cursor: pointer;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        letter-spacing: 0.1px;
    }
    .cc-btn-cancel {
        background: #f1f5f9;
        color: #475569;
        border: 1.5px solid #e2e8f0;
    }
    .cc-btn-cancel:hover {
        background: #e2e8f0;
        color: #1e293b;
        transform: translateY(-1px);
    }
    .cc-btn-ok {
        color: #fff;
        position: relative;
        overflow: hidden;
    }
    .cc-btn-ok::after {
        content: '';
        position: absolute;
        inset: 0;
        background: rgba(255,255,255,0);
        transition: background 0.2s;
    }
    .cc-btn-ok:hover::after { background: rgba(255,255,255,0.12); }
    .cc-btn-ok:hover { transform: translateY(-2px); }
    .cc-btn-ok:active { transform: translateY(0); }

    .cc-btn-ok.danger-btn  { background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); box-shadow: 0 6px 20px rgba(239,68,68,0.4); }
    .cc-btn-ok.danger-btn:hover  { box-shadow: 0 10px 28px rgba(239,68,68,0.5); }
    .cc-btn-ok.warning-btn { background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); box-shadow: 0 6px 20px rgba(245,158,11,0.4); }
    .cc-btn-ok.warning-btn:hover { box-shadow: 0 10px 28px rgba(245,158,11,0.5); }

    /* Bottom hint line */
    .custom-confirm-hint {
        padding: 13px 32px;
        background: #f8fafc;
        border-top: 1px solid #f1f5f9;
        font-size: 12px;
        color: #94a3b8;
        text-align: center;
    }
    .custom-confirm-hint kbd {
        background: #e2e8f0;
        border-radius: 4px;
        padding: 1px 5px;
        font-size: 11px;
        color: #64748b;
        font-family: inherit;
    }
</style>

<div class="custom-confirm-overlay" id="customConfirmOverlay">
    <div class="custom-confirm-box" id="customConfirmBox">
        <div class="custom-confirm-strip danger" id="customConfirmStrip"></div>
        <div class="custom-confirm-body">
            <div class="custom-confirm-icon-wrap danger" id="customConfirmIconWrap">
                <i class="ti ti-trash cc-icon" id="customConfirmIconEl"></i>
            </div>
            <div class="custom-confirm-title" id="customConfirmTitle">Are you sure?</div>
            <div class="custom-confirm-message" id="customConfirmMessage">This action cannot be undone.</div>
            <div class="custom-confirm-actions">
                <button class="cc-btn cc-btn-cancel" onclick="closeCustomConfirm()">
                    <i class="ti ti-x"></i> Cancel
                </button>
                <button class="cc-btn cc-btn-ok danger-btn" id="customConfirmOkBtn" onclick="executeCustomConfirm()">
                    <i class="ti ti-check" id="customConfirmOkIcon"></i>
                    <span id="customConfirmOkText">Confirm</span>
                </button>
            </div>
        </div>
        <div class="custom-confirm-hint">
            Press <kbd>Esc</kbd> to cancel
        </div>
    </div>
</div>

<script>
    let _confirmCallback = null;

    function showConfirm(opts) {
        const defaults = {
            title: 'Are you sure?',
            message: 'This action cannot be undone.',
            okText: 'Confirm',
            type: 'danger',
            icon: 'ti-trash',
            onConfirm: () => {}
        };
        const o = Object.assign({}, defaults, opts);

        document.getElementById('customConfirmTitle').textContent   = o.title;
        document.getElementById('customConfirmMessage').textContent = o.message;
        document.getElementById('customConfirmOkText').textContent  = o.okText;

        // Icon
        const iconEl = document.getElementById('customConfirmIconEl');
        iconEl.className = 'ti ' + o.icon + ' cc-icon';

        // Color type
        const iconWrap = document.getElementById('customConfirmIconWrap');
        const strip    = document.getElementById('customConfirmStrip');
        const okBtn    = document.getElementById('customConfirmOkBtn');

        iconWrap.className = 'custom-confirm-icon-wrap ' + o.type;
        strip.className    = 'custom-confirm-strip ' + o.type;
        okBtn.className    = 'cc-btn cc-btn-ok ' + o.type + '-btn';

        _confirmCallback = o.onConfirm;
        document.getElementById('customConfirmOverlay').classList.add('active');
    }

    function closeCustomConfirm() {
        document.getElementById('customConfirmOverlay').classList.remove('active');
        _confirmCallback = null;
    }

    function executeCustomConfirm() {
        if (typeof _confirmCallback === 'function') _confirmCallback();
        closeCustomConfirm();
    }

    document.getElementById('customConfirmOverlay').addEventListener('click', function(e) {
        if (e.target === this) closeCustomConfirm();
    });
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeCustomConfirm();
    });
</script>

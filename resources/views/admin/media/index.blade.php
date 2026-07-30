@extends('admin.layouts.app')

@section('content')
<style>
/* ═══════════════════════════════════════════════════
   FILE MANAGER — ULTRA PREMIUM UI
═══════════════════════════════════════════════════ */

/* Page */
.fm-wrap { display:flex;flex-direction:column;gap:0;min-height:calc(100vh - 90px); }

/* Stat Cards */
.fm-stat { border-radius:12px;border:1px solid #f1f5f9;background:#fff;transition:all .3s ease;overflow:visible;position:relative;box-shadow:0 4px 15px rgba(0,0,0,.02); }
.fm-stat:hover { box-shadow:0 12px 30px rgba(0,0,0,.06);transform:translateY(-3px); }
.fm-stat-num { font-size:26px;font-weight:700;line-height:1;letter-spacing:-0.5px;color:var(--ins-heading-color);margin-bottom:6px; }
.fm-stat-lbl { font-size:12px;color:#64748b;font-weight:600;text-transform:uppercase;letter-spacing:.05em; }
.fm-stat-icon { width:52px;height:52px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:1.6rem; }

/* Sidebar */
.fm-sidebar { background:#fff;border-radius:12px;border:none;box-shadow:0 4px 20px rgba(0,0,0,.03);overflow:hidden;position:sticky;top:80px; }
.fm-sidebar-head { padding:24px 20px;border-bottom:none;display:flex;align-items:center;justify-content:space-between; }
.fm-nav-item { display:flex;align-items:center;gap:12px;padding:12px 18px;border-radius:50px;text-decoration:none;color:#64748b;font-size:14px;font-weight:500;transition:all .2s ease;margin-bottom:6px;cursor:pointer;border:none;background:none;width:100%;text-align:left; }
.fm-nav-item:hover { background-color:#f1f5f9;color:var(--tl-color-theme-primary); }
.fm-nav-item.active { background-color:rgba(0, 151, 160, 0.08);color:var(--tl-color-theme-primary);font-weight:600; }
.fm-nav-item .nav-icon { font-size:1.2rem;width:20px;text-align:center;flex-shrink:0; }
.fm-nav-item .nav-badge { margin-left:auto;font-size:11.5px;padding:2px 8px;border-radius:20px;background:#f1f5f9;color:#64748b;font-weight:600; }
.fm-nav-item.active .nav-badge { background-color:#ffffff !important;color:var(--tl-color-theme-primary) !important;box-shadow:0 2px 6px rgba(0, 151, 160, 0.15); }
.fm-folder-row { display:flex;align-items:center;position:relative; }
.fm-folder-row .fm-nav-item { flex:1;min-width:0; }
.fm-folder-row .fm-folder-dots { flex-shrink:0;opacity:0;transition:opacity .15s;border:none;background:none;padding:4px;border-radius:6px;color:#94a3b8;cursor:pointer; }
.fm-folder-row:hover .fm-folder-dots { opacity:1; }
.fm-folder-row .fm-folder-dots:hover { background:#f1f5f9;color:var(--tl-color-theme-primary); }
.fm-type-section { padding:0 12px 12px; }
.fm-section-label { font-size:11px;text-transform:uppercase;letter-spacing:.08em;color:#94a3b8;font-weight:700;padding:12px 16px 8px;display:block; }

/* Toolbar */
.fm-toolbar { background:#fff;border-radius:12px;border:none;box-shadow:0 4px 20px rgba(0,0,0,.03);padding:14px 20px; }
.fm-search-wrap { position:relative;max-width:260px; }
.fm-search-wrap .fm-search-icon { position:absolute;left:10px;top:50%;transform:translateY(-50%);color:#94a3b8;font-size:14px;pointer-events:none; }
.fm-search-wrap input { padding-left:32px;padding-right:36px;height:38px;font-size:14px;border-radius:8px;border:1px solid #e2e8f0; }
.fm-search-wrap input:focus { border-color:var(--tl-color-theme-primary);box-shadow:0 0 0 0.25rem rgba(0, 151, 160, 0.1); }
.fm-search-clear { position:absolute;right:8px;top:50%;transform:translateY(-50%);background:none;border:none;color:#94a3b8;cursor:pointer;padding:0;font-size:14px; }
.fm-sort-select { height:38px;font-size:14px;border-radius:8px;border:1px solid #e2e8f0;padding:0 12px;cursor:pointer; }
.fm-sort-select:focus { border-color:var(--tl-color-theme-primary);box-shadow:0 0 0 0.25rem rgba(0, 151, 160, 0.1);outline:none; }
.view-toggle-btn { background: transparent; color: #64748b; border: none; }
.view-toggle-btn.active { background: #fff !important; color: var(--tl-color-theme-primary) !important; box-shadow: 0 2px 6px rgba(0,0,0,0.06); font-weight:bold; }
.fm-view-btn:hover { border-color:var(--tl-color-theme-primary);color:var(--tl-color-theme-primary); }
.fm-view-btn.active { background:var(--tl-color-theme-primary);border-color:var(--tl-color-theme-primary);color:#fff; }

/* Upload progress */
.fm-progress-wrap { background:#f8fafc;border:1px solid #e2e8f0;border-radius:12px;padding:16px; }
.fm-progress-bar-track { height:6px;background:#e2e8f0;border-radius:3px;overflow:hidden; }
.fm-progress-bar-fill { height:100%;background:var(--tl-color-theme-primary);border-radius:3px;transition:width .25s ease; }

/* Drop overlay */
.fm-drop-overlay { display:none;position:fixed;inset:0;background:rgba(255,255,255,.8);backdrop-filter:blur(5px);z-index:2000;border:4px dashed var(--tl-color-theme-primary);border-radius:0;pointer-events:none; }
.fm-drop-overlay.active { display:flex;align-items:center;justify-content:center; }
.fm-drop-overlay-inner { background:#fff;border-radius:16px;padding:48px 56px;text-align:center;box-shadow:0 24px 60px rgba(0,0,0,.1); }

/* Grid card */
.fm-grid { display:grid;grid-template-columns:repeat(auto-fill,minmax(180px,1fr));gap:20px; }
.fm-card { background:#fff;border-radius:12px;border:1px solid #e2e8f0;overflow:hidden;cursor:pointer;transition:all .3s ease;position:relative;user-select:none; }
.fm-card:hover { box-shadow:0 8px 30px rgba(0,0,0,.08);border-color:#cbd5e1;transform:translateY(-3px); }
.fm-card.fm-selected { border-color:var(--tl-color-theme-primary);box-shadow:0 0 0 3px rgba(0, 151, 160, 0.2); }

/* Card checkbox */
.fm-card-check { position:absolute;top:10px;left:10px;z-index:20;width:20px;height:20px;border-radius:4px;border:1.5px solid rgba(255,255,255,0.8);background:rgba(0,0,0,.15);display:flex;align-items:center;justify-content:center;transition:all .2s ease;backdrop-filter:blur(4px); }
.fm-card-check input { position:absolute;inset:0;opacity:0;cursor:pointer;margin:0;width:100%;height:100%;z-index:21; }
.fm-card-check .check-icon { display:none;color:#fff;font-size:11px;font-weight:bold;pointer-events:none; }
.fm-card.fm-selected .fm-card-check { background:var(--tl-color-theme-primary);border-color:var(--tl-color-theme-primary);box-shadow:0 4px 12px rgba(0, 151, 160, 0.3); }
.fm-card.fm-selected .fm-card-check .check-icon { display:block;color:#fff; }

/* Card thumb & Hover Actions */
.fm-thumb { height:160px;display:flex;align-items:center;justify-content:center;background:#f8fafc;position:relative;overflow:hidden; border-bottom:1px solid #f1f5f9; }
.fm-thumb img { width:100%;height:100%;object-fit:cover;transition:transform .5s cubic-bezier(0.165, 0.84, 0.44, 1); }
.fm-card:hover .fm-thumb img { transform:scale(1.05); }

.fm-thumb-overlay-subtle { position:absolute;inset:0;background:linear-gradient(180deg, rgba(0,0,0,0.15) 0%, rgba(0,0,0,0) 40%, rgba(0,0,0,0) 100%); opacity:0; transition:all .3s ease; pointer-events:none; }
.fm-card:hover .fm-thumb-overlay-subtle { opacity:1; }

.hover-actions { opacity: 0; transform: scale(0.9) translateY(-5px); transition: all 0.25s cubic-bezier(0.165, 0.84, 0.44, 1); pointer-events:none; }
.fm-card:hover .hover-actions { opacity: 1; transform: scale(1) translateY(0); pointer-events:auto; }
.hover-actions .btn { transition: all 0.2s ease; }
.hover-actions .btn:hover { background:var(--tl-color-theme-primary) !important; color:#fff !important; border-color:var(--tl-color-theme-primary) !important; transform: scale(1.1); }

/* Card footer */
.fm-card-foot { padding:14px 16px; background:#fff; }
.fm-card-name { font-size:14px;font-weight:600;color:#1e2340;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;margin-bottom:6px; }
.fm-card-meta { display:flex;justify-content:space-between;align-items:center;font-size:12px;color:#64748b;font-weight:500; }
.fm-ext-badge { display:inline-flex;align-items:center;padding:2px 6px;border-radius:4px;font-size:11px;font-weight:700;letter-spacing:.05em; }

/* File type colors */
.ft-image    { background:#e0f2f1;  color:#009688; }
.ft-video    { background:#ffebee;  color:#f44336; }
.ft-pdf      { background:#ffebee;  color:#f44336; }
.ft-excel    { background:#e8f5e9;  color:#4caf50; }
.ft-word     { background:#e3f2fd;  color:#2196f3; }
.ft-ppt      { background:#fff8e1;  color:#ffc107; }
.ft-zip      { background:#f3e5f5;  color:#9c27b0; }
.ft-default  { background:#f1f5f9;  color:#64748b; }

/* File icons */
.fi { font-size:3rem; }
.fi-video    { color:#f44336; }
.fi-pdf      { color:#f44336; }
.fi-excel    { color:#4caf50; }
.fi-word     { color:#2196f3; }
.fi-ppt      { color:#ffb300; }
.fi-zip      { color:#9c27b0; }
.fi-default  { color:#94a3b8; }

/* List view */
.fm-list-table { border-collapse: separate; border-spacing: 0 4px; }
.fm-list-table th { font-size:12px;text-transform:uppercase;letter-spacing:.05em;color:#94a3b8;font-weight:600;background:transparent;border:none;padding:12px 16px; }
.fm-list-table td { vertical-align:middle;border-bottom:1px solid #f1f5f9;border-top:1px solid #f1f5f9;padding:12px 16px;font-size:14px; color:#475569; background:#fff; transition: background .15s ease; }
.fm-list-table td:first-child { border-left:1px solid #f1f5f9; border-top-left-radius:8px; border-bottom-left-radius:8px; }
.fm-list-table td:last-child { border-right:1px solid #f1f5f9; border-top-right-radius:8px; border-bottom-right-radius:8px; }
.fm-list-table tbody tr { cursor:pointer; }
.fm-list-table tbody tr:hover td { background:#f8fafc; border-color:#e2e8f0; }
.fm-list-thumb { width:42px;height:42px;object-fit:cover;border-radius:8px; border:none; }
.fm-list-actions { opacity: 0; transition: opacity 0.2s; }
.fm-list-table tbody tr:hover .fm-list-actions { opacity: 1; }
.fm-list-table .btn-light { border:none; background:#f1f5f9; color:#64748b; border-radius:8px; }
.fm-list-table .btn-light:hover { background:var(--tl-color-theme-primary); color:#fff; }

/* Empty state */
.fm-empty { text-align:center;padding:80px 20px; }
.fm-empty-blob { width:90px;height:90px;background:rgba(0, 151, 160, 0.08);border-radius:24px;display:flex;align-items:center;justify-content:center;font-size:2.5rem;color:var(--tl-color-theme-primary);margin:0 auto 24px; }

/* Breadcrumb */
.fm-bc { display:flex;align-items:center;gap:8px;font-size:14px;padding:10px 0 16px;flex-wrap:wrap; }
.fm-bc a { color:var(--tl-color-theme-primary);text-decoration:none;font-weight:500; }
.fm-bc a:hover { text-decoration:underline; }
.fm-bc .sep { color:#94a3b8;font-size:12px; }
.fm-bc .cur { color:var(--ins-heading-color);font-weight:600; }

/* Bulk floating bar */
.fm-bulk { position:fixed;bottom:30px;left:50%;transform:translateX(-50%);background:rgba(30, 41, 59, 0.95);backdrop-filter:blur(10px);color:#fff;border-radius:50px;padding:10px 14px;display:none;align-items:center;gap:12px;z-index:1100;box-shadow:0 20px 40px rgba(0,0,0,.15), 0 0 0 1px rgba(255,255,255,0.1);animation:fmSlideUp .3s cubic-bezier(.16, 1, .3, 1); }
.fm-bulk.show { display:flex; }
@keyframes fmSlideUp { from{opacity:0;transform:translateX(-50%) translateY(20px) scale(0.95)}to{opacity:1;transform:translateX(-50%) translateY(0) scale(1)} }
.fm-bulk-pill { font-size:14px;font-weight:600;background:rgba(255,255,255,.1);padding:6px 16px;border-radius:30px; letter-spacing: 0.02em; }
.fm-bulk-sep { width:1px;height:20px;background:rgba(255,255,255,.15); }
.fm-bulk-btn { background:transparent;color:#f1f5f9;border:none;padding:6px 14px;border-radius:30px;font-size:14px;font-weight:500;transition:all .2s ease; display:flex; align-items:center; gap:6px; }
.fm-bulk-btn:hover { background:rgba(255,255,255,.1);color:#fff; }
.fm-bulk-btn.btn-danger-hover:hover { background:rgba(239, 68, 68, 0.2);color:#ef4444; }

/* Move to folder - folder picker */
.fm-folder-pick { display:grid;grid-template-columns:1fr 1fr;gap:12px;max-height:280px;overflow-y:auto;padding-right:6px; }
.fm-folder-pick-item { display:flex;align-items:center;gap:12px;padding:12px 16px;border-radius:10px;border:1px solid #e2e8f0;cursor:pointer;transition:all .2s ease;font-size:14px;font-weight:500;color:#475569;background:#fff; }
.fm-folder-pick-item:hover { border-color:var(--tl-color-theme-primary);background:#f8fafc;color:var(--tl-color-theme-primary); }
.fm-folder-pick-item.selected { border-color:var(--tl-color-theme-primary);background:#f8fafc;color:var(--tl-color-theme-primary);font-weight:600; box-shadow: 0 2px 10px rgba(0,151,160,.05); }
.fm-folder-pick-item i { font-size:1.4rem;color:#f59e0b; }
.fm-folder-pick-item.root-item i { color:var(--tl-color-theme-primary); }
.fm-folder-pick-item.selected i { color:var(--tl-color-theme-primary); }

/* Detail modal */
.fm-detail-preview { background:#f1f5f9;border-radius:12px;overflow:hidden;display:flex;align-items:center;justify-content:center;min-height:240px;max-height:300px; }
.fm-detail-preview img { width:100%;height:100%;object-fit:contain;max-height:300px; }
.fm-meta-grid { display:grid;grid-template-columns:1fr 1fr;gap:12px; }
.fm-meta-box { background:#f8fafc;border-radius:10px;border:1px solid #e2e8f0;padding:12px 16px;text-align:center; }
.fm-meta-box .val { font-size:14px;font-weight:700;color:#1e2340;margin-bottom:4px; }
.fm-meta-box .key { font-size:12px;color:#64748b;font-weight:500; text-transform: uppercase; letter-spacing: 0.05em; }

/* Scrollbar for folder picker */
.fm-folder-pick::-webkit-scrollbar { width:6px; }
.fm-folder-pick::-webkit-scrollbar-track { background:#f1f5f9; border-radius:3px; }
.fm-folder-pick::-webkit-scrollbar-thumb { background:#cbd5e1;border-radius:3px; }
.fm-folder-pick::-webkit-scrollbar-thumb:hover { background:#94a3b8; }
</style>

{{-- DROP OVERLAY --}}
<div class="fm-drop-overlay" id="fm-drop-overlay">
  <div class="fm-drop-overlay-inner">
    <div style="width:64px;height:64px;background:rgba(67,97,238,.1);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;">
      <i class="ti ti-cloud-upload" style="font-size:2rem;color:#4361ee;"></i>
    </div>
    <h5 class="fw-bold mb-1">Release to Upload</h5>
    <p class="text-muted fs-13 mb-0">Files will be uploaded to the current folder</p>
  </div>
</div>

<div class="content">
  <div class="container-fluid">

    {{-- ── HEADER ────────────────────────────────────── --}}
    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mt-4 mb-4">
      <div>
        <h4 class="fw-bold mb-1" style="color:#1e2340;">File Manager</h4>
        <p class="text-muted fs-13 mb-0">Upload, organize and manage your media library</p>
      </div>
      <div class="d-flex gap-2">
        <button class="btn btn-light fw-medium" data-bs-toggle="modal" data-bs-target="#createFolderModal">
          <i class="ti ti-folder-plus me-1"></i>New Folder
        </button>
        <button class="btn btn-primary fw-medium" id="upload-trigger-btn">
          <i class="ti ti-upload me-1"></i>Upload Files
        </button>
      </div>
    </div>

    {{-- ── STATS ─────────────────────────────────────── --}}
    <div class="row g-3 mb-4">
      <div class="col-6 col-xl-3">
        <div class="card fm-stat mb-0 p-3">
          <div class="d-flex align-items-center gap-3">
            <div class="fm-stat-icon" style="background:rgba(67,97,238,.1);">
              <i class="ti ti-files" style="color:#4361ee;"></i>
            </div>
            <div>
              <div class="fm-stat-num">{{ $stats['total'] }}</div>
              <div class="fm-stat-lbl">Total Files</div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-6 col-xl-3">
        <div class="card fm-stat mb-0 p-3">
          <div class="d-flex align-items-center gap-3">
            <div class="fm-stat-icon" style="background:rgba(16,185,129,.1);">
              <i class="ti ti-photo" style="color:#10b981;"></i>
            </div>
            <div>
              <div class="fm-stat-num">{{ $stats['images'] }}</div>
              <div class="fm-stat-lbl">Images</div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-6 col-xl-3">
        <div class="card fm-stat mb-0 p-3">
          <div class="d-flex align-items-center gap-3">
            <div class="fm-stat-icon" style="background:rgba(59,130,246,.1);">
              <i class="ti ti-file-text" style="color:#3b82f6;"></i>
            </div>
            <div>
              <div class="fm-stat-num">{{ $stats['documents'] }}</div>
              <div class="fm-stat-lbl">Documents</div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-6 col-xl-3">
        <div class="card fm-stat mb-0 p-3">
          <div class="d-flex align-items-center gap-3">
            <div class="fm-stat-icon" style="background:rgba(245,158,11,.1);">
              <i class="ti ti-database" style="color:#f59e0b;"></i>
            </div>
            <div>
              <div class="fm-stat-num">
                {{ $stats['storage'] > 0 ? number_format($stats['storage']/1048576,1) : '0' }}
                <span style="font-size:16px;font-weight:700;">MB</span>
              </div>
              <div class="fm-stat-lbl">Storage Used</div>
            </div>
          </div>
        </div>
      </div>
    </div>

    {{-- ── MAIN LAYOUT ───────────────────────────────── --}}
    <div class="row g-3">

      {{-- SIDEBAR ──────────────────────────── --}}
      <div class="col-xl-3 col-lg-4 d-none d-lg-block">
        <div class="fm-sidebar">
          <div class="fm-sidebar-head">
            <span class="fw-semibold fs-14" style="color:#1e2340;">
              <i class="ti ti-folder me-2 text-primary"></i>Folders
            </span>
            <button class="btn btn-sm btn-light rounded-pill px-2 py-1 fs-12"
                    data-bs-toggle="modal" data-bs-target="#createFolderModal">
              <i class="ti ti-plus me-1"></i>New
            </button>
          </div>
          <div class="p-2">
            {{-- All Files --}}
            <a href="{{ route('admin.media.index') }}"
               class="fm-nav-item {{ !request('folder_id') && !request('type') ? 'active' : '' }}">
              <i class="ti ti-layout-grid nav-icon"></i>
              <span>All Files</span>
              <span class="nav-badge">{{ $stats['total'] }}</span>
            </a>

            {{-- Type Filters --}}
            <span class="fm-section-label">By Type</span>
            <div class="fm-type-section">
              <a href="{{ route('admin.media.index', array_merge(request()->only('folder_id'),['type'=>'image'])) }}"
                 class="fm-nav-item {{ request('type')=='image' ? 'active' : '' }}">
                <i class="ti ti-photo nav-icon" style="color:#10b981;"></i>
                <span>Images</span>
                <span class="nav-badge">{{ $stats['images'] }}</span>
              </a>
              <a href="{{ route('admin.media.index', array_merge(request()->only('folder_id'),['type'=>'document'])) }}"
                 class="fm-nav-item {{ request('type')=='document' ? 'active' : '' }}">
                <i class="ti ti-file-text nav-icon" style="color:#3b82f6;"></i>
                <span>Documents</span>
                <span class="nav-badge">{{ $stats['documents'] }}</span>
              </a>
              <a href="{{ route('admin.media.index', array_merge(request()->only('folder_id'),['type'=>'video'])) }}"
                 class="fm-nav-item {{ request('type')=='video' ? 'active' : '' }}">
                <i class="ti ti-video nav-icon" style="color:#ef4444;"></i>
                <span>Videos</span>
                <span class="nav-badge">{{ $stats['videos'] ?? 0 }}</span>
              </a>
              @if(request('type'))
              <a href="{{ route('admin.media.index', request()->only('folder_id')) }}"
                 class="fm-nav-item" style="color:#94a3b8;">
                <i class="ti ti-x nav-icon"></i><span>Clear Filter</span>
              </a>
              @endif
            </div>

            {{-- Folders --}}
            @if($folders->count())
            <span class="fm-section-label">My Folders</span>
            <div class="px-1">
@php
if (!function_exists('renderFolderTree')) {
    function renderFolderTree($folderList, $level = 0, $activeId = null) {
        foreach($folderList as $folder) {
            $isActive = ($activeId == $folder->id);
            $padding = $level * 14;
            $icon = $isActive ? 'ti-folder-open' : 'ti-folder';
            echo '<div class="fm-folder-row">';
            echo '<a href="'.route('admin.media.index', ['folder_id' => $folder->id]).'" class="fm-nav-item '.($isActive ? 'active' : '').'" style="padding-left: '.($padding + 12).'px;">';
            echo '<i class="ti '.$icon.' nav-icon" style="color:#f59e0b;"></i>';
            echo '<span class="text-truncate" style="max-width:'.(110 - $padding).'px;" title="'.e($folder->name).'">'.e($folder->name).'</span>';
            echo '</a>';
            echo '<div class="dropdown">';
            echo '<button class="fm-folder-dots" data-bs-toggle="dropdown"><i class="ti ti-dots-vertical fs-14"></i></button>';
            echo '<ul class="dropdown-menu dropdown-menu-end shadow-sm py-1" style="min-width:130px;font-size:13px;">';
            echo '<li><a class="dropdown-item" href="#" onclick="renameFolder('.$folder->id.',\''.addslashes($folder->name).'\')"><i class="ti ti-edit me-2 text-muted"></i>Rename</a></li>';
            echo '<li><a class="dropdown-item text-danger" href="#" onclick="deleteFolder('.$folder->id.')"><i class="ti ti-trash me-2"></i>Delete</a></li>';
            echo '</ul>';
            echo '</div>';
            echo '</div>';
            
            if ($folder->children && $folder->children->count()) {
                renderFolderTree($folder->children, $level + 1, $activeId);
            }
        }
    }
}
@endphp
              {{ renderFolderTree($folders, 0, request('folder_id')) }}
            </div>
            @endif
          </div>
        </div>
      </div>

      {{-- FILES PANEL ──────────────────────── --}}
      <div class="col-xl-9 col-lg-8">

        {{-- Breadcrumb --}}
        @if($activeFolder)
        <div class="fm-bc">
          <i class="ti ti-home text-muted"></i>
          <a href="{{ route('admin.media.index') }}">All Files</a>
          @foreach($breadcrumbs as $bc)
            <span class="sep"><i class="ti ti-chevron-right"></i></span>
            @if($loop->last)
              <span class="cur">{{ $bc->name }}</span>
            @else
              <a href="{{ route('admin.media.index', ['folder_id' => $bc->id]) }}">{{ $bc->name }}</a>
            @endif
          @endforeach
        </div>
        @endif

        {{-- Toolbar --}}
        <div class="fm-toolbar mb-4 d-flex align-items-center justify-content-between flex-wrap gap-3" style="padding: 12px 20px;">
          <form action="{{ route('admin.media.index') }}" method="GET" id="filter-form" class="d-flex align-items-center gap-3 flex-grow-1 flex-wrap m-0">
            @if(request('folder_id'))
              <input type="hidden" name="folder_id" value="{{ request('folder_id') }}">
            @endif
            @if(request('type'))
              <input type="hidden" name="type" value="{{ request('type') }}">
            @endif

            {{-- Modern Search Bar --}}
            <div class="position-relative" style="max-width: 340px; width: 100%;">
              <i class="ti ti-search position-absolute text-muted" style="left: 14px; top: 50%; transform: translateY(-50%); font-size: 16px;"></i>
              <input type="text" name="search" value="{{ request('search') }}" class="form-control shadow-sm" placeholder="Search your files..." autocomplete="off" style="padding-left: 40px; padding-right: 36px; border-radius: 10px; border: 1px solid #e2e8f0; height: 42px; background: #f8fafc; font-size: 14px; transition: all 0.2s;">
              @if(request('search'))
                <button type="button" class="position-absolute bg-transparent border-0 text-muted" onclick="clearSearch()" style="right: 10px; top: 50%; transform: translateY(-50%);">
                  <i class="ti ti-x"></i>
                </button>
              @endif
            </div>

            {{-- Modern Sort Dropdown --}}
            <div class="d-flex align-items-center gap-2">
              <span class="text-muted fs-13 fw-medium d-none d-sm-inline">Sort:</span>
              <select class="form-select shadow-sm text-dark fw-medium" name="sort" onchange="this.form.submit()" style="width: 150px; height: 42px; border-radius: 10px; border: 1px solid #e2e8f0; background-color: #f8fafc; cursor: pointer; font-size: 14px;">
                <option value="created_at"    {{ request('sort','created_at')=='created_at'   ?'selected':'' }}>Newest First</option>
                <option value="original_name" {{ request('sort')=='original_name'?'selected':'' }}>Name A–Z</option>
                <option value="file_size"     {{ request('sort')=='file_size'    ?'selected':'' }}>Largest First</option>
              </select>
            </div>
          </form>

          {{-- Modern View Toggle (Segmented Control) --}}
          <div class="d-flex align-items-center p-1 shadow-sm flex-shrink-0" style="background: #f1f5f9; border-radius: 10px; border: 1px solid #e2e8f0;">
            <button class="btn btn-sm d-flex align-items-center justify-content-center view-toggle-btn active" id="btn-grid" title="Grid View" style="width: 40px; height: 34px; border-radius: 8px; transition: all 0.2s;">
              <i class="ti ti-layout-grid fs-16"></i>
            </button>
            <button class="btn btn-sm d-flex align-items-center justify-content-center view-toggle-btn" id="btn-list" title="List View" style="width: 40px; height: 34px; border-radius: 8px; transition: all 0.2s;">
              <i class="ti ti-list fs-16"></i>
            </button>
          </div>
        </div>

        {{-- Hidden file input --}}
        <input type="file" id="file-upload-input" multiple
               accept="image/*,video/*,.pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.txt,.zip,.rar"
               style="display:none;">

        {{-- Upload Progress --}}
        <div id="upload-progress-wrap" class="fm-progress-wrap mb-3" style="display:none;">
          <div class="d-flex justify-content-between align-items-center mb-2">
            <div class="d-flex align-items-center gap-2">
              <div class="spinner-border spinner-border-sm text-primary" style="width:13px;height:13px;border-width:2px;"></div>
              <span class="fw-semibold fs-13">Uploading…</span>
            </div>
            <span class="fw-bold text-primary fs-13" id="upload-pct">0%</span>
          </div>
          <div class="fm-progress-bar-track">
            <div class="fm-progress-bar-fill" id="upload-bar" style="width:0%;"></div>
          </div>
          <p class="text-muted fs-12 mb-0 mt-1" id="upload-names"></p>
        </div>

        {{-- ── GRID VIEW ──────────────────── --}}
        <div id="view-grid">
          @if($files->isEmpty() && $currentFolders->isEmpty())
          <div class="card mb-0">
            <div class="fm-empty">
              <div class="fm-empty-blob">
                <i class="ti ti-cloud-upload"></i>
              </div>
              <h5 class="fw-bold mb-2">No files or folders yet</h5>
              <p class="text-muted fs-13 mb-3">
                Drag &amp; drop files anywhere on this page, or click the button below.
              </p>
              <button class="btn btn-primary" id="empty-upload-btn">
                <i class="ti ti-upload me-1"></i>Upload Files
              </button>
            </div>
          </div>
          @else
          {{-- Folders First (Separate Grid) --}}
          @if($currentFolders->isNotEmpty())
          <h6 class="text-muted fw-bold mb-3 fs-12 text-uppercase" style="letter-spacing:1px;">Folders</h6>
          <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(240px,1fr));gap:16px;margin-bottom:28px;">
            @foreach($currentFolders as $cf)
            <div class="card mb-0 shadow-sm border-0" style="border-radius:14px;cursor:pointer;transition:all .2s;background:#fff;" 
                 onclick="window.location.href='{{ route('admin.media.index', ['folder_id' => $cf->id]) }}'"
                 onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 8px 24px rgba(67,97,238,.12)'"
                 onmouseout="this.style.transform='none';this.style.boxShadow='0 .125rem .25rem rgba(0,0,0,.075)'">
              <div class="card-body p-3 d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-3" style="min-width:0;">
                  <div style="width:48px;height:48px;border-radius:12px;background:rgba(245,158,11,.12);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <i class="ti ti-folder" style="font-size:1.7rem;color:#f59e0b;"></i>
                  </div>
                  <div class="text-truncate fw-bold" style="color:#1e2340;font-size:15px;max-width:140px;" title="{{ $cf->name }}">{{ $cf->name }}</div>
                </div>
                <button class="btn btn-sm btn-light p-2" style="border-radius:10px;flex-shrink:0;background:rgba(239,68,68,.05);border:none;" onclick="event.stopPropagation();deleteFolder({{ $cf->id }})" title="Delete Folder">
                  <i class="ti ti-trash text-danger" style="font-size:1.15rem;opacity:0.8;"></i>
                </button>
              </div>
            </div>
            @endforeach
          </div>
          @endif

          @if($files->isNotEmpty())
          <h6 class="text-muted fw-bold mb-3 fs-12 text-uppercase" style="letter-spacing:1px;">Files</h6>
          @endif
          <div class="row g-4" id="media-grid">
            {{-- Files --}}
            @foreach($files as $file)
            @php
              $ext = strtolower($file->extension);
              $extClass = match(true) {
                $file->file_type==='image'              => 'ft-image',
                $file->file_type==='video'              => 'ft-video',
                $ext==='pdf'                            => 'ft-pdf',
                in_array($ext,['xls','xlsx'])           => 'ft-excel',
                in_array($ext,['doc','docx'])           => 'ft-word',
                in_array($ext,['ppt','pptx'])           => 'ft-ppt',
                in_array($ext,['zip','rar','7z'])       => 'ft-zip',
                default                                 => 'ft-default',
              };
              $iconClass = match(true) {
                $file->file_type==='video'              => 'ti-video fi-video',
                $ext==='pdf'                            => 'ti-file-type-pdf fi-pdf',
                in_array($ext,['xls','xlsx'])           => 'ti-file-spreadsheet fi-excel',
                in_array($ext,['doc','docx'])           => 'ti-file-word fi-word',
                in_array($ext,['ppt','pptx'])           => 'ti-file-presentation fi-ppt',
                in_array($ext,['zip','rar','7z'])       => 'ti-file-zip fi-zip',
                default                                 => 'ti-file-text fi-default',
              };
              $fileJson = json_encode($file);
            @endphp
            <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                <div class="fm-card h-100 skeleton-target" data-id="{{ $file->id }}">
                  {{-- Checkbox --}}
                  <div class="fm-card-check">
                    <input type="checkbox" class="file-cb" value="{{ $file->id }}" onchange="toggleCardState(this, {{ $file->id }})">
                    <i class="ti ti-check check-icon"></i>
                  </div>

                  {{-- Compact Action Bar (Top Right) --}}
                  <div class="position-absolute d-flex flex-column gap-2 opacity-0 hover-actions" style="top: 10px; right: 10px; z-index: 10;">
                      <button class="btn btn-light rounded-circle shadow-sm d-flex align-items-center justify-content-center p-0" style="width: 30px; height: 30px;" title="Preview" onclick="event.stopPropagation();openDetail({{ $file->id }},{{ $fileJson }})">
                          <i class="ti ti-eye fs-14"></i>
                      </button>
                      <a class="btn btn-light rounded-circle shadow-sm d-flex align-items-center justify-content-center p-0 text-dark" style="width: 30px; height: 30px; text-decoration: none;" href="{{ $file->url }}" download title="Download" onclick="event.stopPropagation()">
                          <i class="ti ti-download fs-14"></i>
                      </a>
                      <button class="btn btn-light rounded-circle shadow-sm d-flex align-items-center justify-content-center p-0" style="width: 30px; height: 30px;" title="Move to folder" onclick="event.stopPropagation();openMove({{ $file->id }})">
                          <i class="ti ti-folders fs-14"></i>
                      </button>
                      <button class="btn btn-danger rounded-circle shadow-sm d-flex align-items-center justify-content-center p-0" style="width: 30px; height: 30px;" title="Delete" onclick="event.stopPropagation();deleteFile({{ $file->id }})">
                          <i class="ti ti-trash fs-14"></i>
                      </button>
                  </div>

                  {{-- Thumb --}}
                  <div class="fm-thumb" onclick="openDetail({{ $file->id }},{{ $fileJson }})">
                    @if($file->file_type === 'image')
                      <img src="{{ $file->thumbnail_url }}" loading="lazy" onerror="this.style.display='none'">
                      <div class="fm-thumb-overlay-subtle"></div>
                    @else
                      <i class="ti {{ $iconClass }} fi"></i>
                    @endif
                  </div>
                  
                  {{-- Footer --}}
                  <div class="fm-card-foot">
                    <div class="fm-card-name" title="{{ $file->original_name }}">{{ $file->original_name }}</div>
                    <div class="fm-card-meta">
                      <span class="fm-ext-badge {{ $extClass }}">{{ strtoupper($ext) }}</span>
                      <span>{{ $file->file_size > 0 ? number_format($file->file_size/1024,1).' KB' : '—' }}</span>
                    </div>
                  </div>
                </div>
            </div>
            @endforeach
          </div>
          @endif
        </div>

        {{-- ── LIST VIEW ──────────────────── --}}
        <div id="view-list" style="display:none;">
          <div class="border-0 bg-transparent mb-0">
            <div class="table-responsive">
              <table class="table fm-list-table mb-0" style="border-collapse: separate; border-spacing: 0 4px;">
                <thead>
                  <tr>
                    <th style="width:36px;">
                      <input type="checkbox" class="form-check-input" id="check-all" onchange="selectAll(this)">
                    </th>
                    <th>File</th>
                    <th>Type</th>
                    <th>Size</th>
                    <th>Folder</th>
                    <th>Date</th>
                    <th class="text-end">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  {{-- Folders First --}}
                  @foreach($currentFolders as $cf)
                  <tr style="cursor:pointer;" onclick="window.location.href='{{ route('admin.media.index', ['folder_id' => $cf->id]) }}'">
                    <td></td>
                    <td>
                      <div class="d-flex align-items-center gap-2">
                        <div style="width:38px;height:38px;border-radius:9px;display:flex;align-items:center;justify-content:center;background:#fff3cd;">
                          <i class="ti ti-folder" style="color:#f59e0b;font-size:1.2rem;"></i>
                        </div>
                        <div class="fw-semibold fs-13">{{ $cf->name }}</div>
                      </div>
                    </td>
                    <td>
                      <span class="badge bg-warning-subtle text-warning rounded-pill fs-11">Folder</span>
                    </td>
                    <td class="text-muted fs-13">—</td>
                    <td class="text-muted fs-13">
                      {{ $cf->parent ? $cf->parent->name : 'Root' }}
                    </td>
                    <td class="text-muted fs-13">{{ $cf->created_at->format('d M Y') }}</td>
                    <td>
                      <div class="d-flex justify-content-end gap-1 fm-list-actions">
                        <button class="btn btn-sm btn-light" style="color:#ef4444;" title="Delete Folder"
                                onclick="event.stopPropagation();deleteFolder({{ $cf->id }})">
                          <i class="ti ti-trash"></i>
                        </button>
                      </div>
                    </td>
                  </tr>
                  @endforeach

                  {{-- Files --}}
                  @forelse($files as $file)
                  @php $ext = strtolower($file->extension); @endphp
                  <tr>
                    <td>
                      <input type="checkbox" class="form-check-input file-cb" value="{{ $file->id }}" onchange="updateBulk()">
                    </td>
                    <td>
                      <div class="d-flex align-items-center gap-2">
                        @if($file->file_type==='image')
                          <img src="{{ $file->thumbnail_url }}" class="fm-list-thumb" loading="lazy"
                               onerror="this.style.display='none'">
                        @else
                          <div style="width:38px;height:38px;border-radius:9px;display:flex;align-items:center;justify-content:center;background:#f8f9fc;">
                            @if($ext==='pdf') <i class="ti ti-file-type-pdf" style="color:#ef4444;font-size:1.2rem;"></i>
                            @elseif(in_array($ext,['xls','xlsx'])) <i class="ti ti-file-spreadsheet" style="color:#10b981;font-size:1.2rem;"></i>
                            @elseif(in_array($ext,['doc','docx'])) <i class="ti ti-file-word" style="color:#3b82f6;font-size:1.2rem;"></i>
                            @else <i class="ti ti-file" style="color:#64748b;font-size:1.2rem;"></i>
                            @endif
                          </div>
                        @endif
                        <div style="min-width:0;">
                          <div class="fw-semibold fs-13" style="white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:180px;" title="{{ $file->original_name }}">
                            {{ $file->original_name }}
                          </div>
                          <div class="text-muted fs-11">{{ strtoupper($ext) }}</div>
                        </div>
                      </div>
                    </td>
                    <td>
                      @php
                        $badgeCls = match($file->file_type) {
                          'image'    => 'bg-success-subtle text-success',
                          'video'    => 'bg-danger-subtle text-danger',
                          'document' => 'bg-primary-subtle text-primary',
                          default    => 'bg-secondary-subtle text-secondary',
                        };
                      @endphp
                      <span class="badge {{ $badgeCls }} rounded-pill fs-11">{{ ucfirst($file->file_type) }}</span>
                    </td>
                    <td class="text-muted fs-13">
                      {{ $file->file_size > 0 ? number_format($file->file_size/1024,1).' KB' : '—' }}
                    </td>
                    <td class="fs-13">
                      @if($file->folder)
                        <span class="d-flex align-items-center gap-1">
                          <i class="ti ti-folder text-warning"></i>{{ $file->folder->name }}
                        </span>
                      @else
                        <span class="text-muted">Root</span>
                      @endif
                    </td>
                    <td class="text-muted fs-13">{{ $file->created_at->format('d M Y') }}</td>
                    <td>
                      <div class="d-flex justify-content-end gap-1 fm-list-actions">
                        <button class="btn btn-sm btn-light" title="Details"
                                onclick="openDetail({{ $file->id }},{{ json_encode($file) }})">
                          <i class="ti ti-eye"></i>
                        </button>
                        <button class="btn btn-sm btn-light" title="Move to Folder"
                                onclick="openMove({{ $file->id }})">
                          <i class="ti ti-folders"></i>
                        </button>
                        <a class="btn btn-sm btn-light" href="{{ $file->url }}" download title="Download">
                          <i class="ti ti-download"></i>
                        </a>
                        <button class="btn btn-sm btn-light" style="color:#ef4444;" title="Delete"
                                onclick="deleteFile({{ $file->id }})">
                          <i class="ti ti-trash"></i>
                        </button>
                      </div>
                    </td>
                  </tr>
                  @empty
                  <tr>
                    <td colspan="7" class="text-center text-muted py-5">No files found.</td>
                  </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div>

        {{-- Pagination --}}
        <div class="mt-3">{{ $files->withQueryString()->links('pagination::bootstrap-5') }}</div>
      </div>
    </div>

  </div>
</div>

{{-- ═══ BULK ACTION BAR ════════════════════════════════ --}}
<div class="fm-bulk" id="fm-bulk">
  <span class="fm-bulk-pill" id="bulk-label">0 selected</span>
  <div class="fm-bulk-sep"></div>
  <button class="fm-bulk-btn" onclick="openBulkMove()">
    <i class="ti ti-folders"></i>Move
  </button>
  <button class="fm-bulk-btn btn-danger-hover" onclick="bulkDelete()">
    <i class="ti ti-trash"></i>Delete
  </button>
  <div class="fm-bulk-sep"></div>
  <button class="fm-bulk-btn" onclick="clearAll()">
    <i class="ti ti-x"></i>Cancel
  </button>
</div>

{{-- ═══ MODALS ═════════════════════════════════════════ --}}

{{-- Create Folder --}}
<div class="modal fade" id="createFolderModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm">
    <div class="modal-content">
      <div class="modal-header border-0 pb-0">
        <h5 class="modal-title fs-15 fw-bold">
          <i class="ti ti-folder-plus me-2" style="color:#4361ee;"></i>New Folder
        </h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="create-folder-form">
          @csrf
          <input type="hidden" name="parent_id" value="{{ request('folder_id') }}">
          <div class="mb-3">
            <input type="text" name="name" id="folder-name-input" class="form-control"
                   required placeholder="e.g. Product Images" autocomplete="off">
          </div>
          <div class="d-flex gap-2">
            <button type="button" class="btn btn-light flex-fill" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary flex-fill" id="create-folder-btn">
              Create
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

{{-- Rename Folder --}}
<div class="modal fade" id="renameFolderModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm">
    <div class="modal-content">
      <div class="modal-header border-0 pb-0">
        <h5 class="modal-title fs-15 fw-bold">
          <i class="ti ti-edit me-2 text-warning"></i>Rename Folder
        </h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="rename-folder-form">
          <input type="hidden" id="rename-folder-id">
          <div class="mb-3">
            <input type="text" id="rename-folder-input" class="form-control" required>
          </div>
          <div class="d-flex gap-2">
            <button type="button" class="btn btn-light flex-fill" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary flex-fill">Rename</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

{{-- Move to Folder Modal --}}
<div class="modal fade" id="moveModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header border-0 pb-0">
        <div>
          <h5 class="modal-title fs-15 fw-bold mb-1">
            <i class="ti ti-folders me-2" style="color:#4361ee;"></i>Move to Folder
          </h5>
          <p class="text-muted fs-12 mb-0" id="move-subtitle">Select destination folder</p>
        </div>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body pt-3">
        <input type="hidden" id="move-file-ids" value="">
        <div class="mb-3">
          <input type="hidden" id="move-selected-folder" value="none">
          <div class="dropdown w-100">
            <button class="fm-custom-select-box dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              <span id="fm-custom-select-text" style="color:#94a3b8;">-- Select Destination --</span>
              <i class="ti ti-chevron-down arrow ms-auto" style="color:#94a3b8; transition:transform .2s; pointer-events:none;"></i>
            </button>
            <ul class="dropdown-menu w-100">
              <li>
                <a class="dropdown-item" href="#" onclick="event.preventDefault(); selectCustomFolder('', 'Root (All Files)', this)">
                  <span>Root (All Files)</span>
                  <i class="ti ti-check check-icon"></i>
                </a>
              </li>
@php
if (!function_exists('getFolderPath')) {
    function getFolderPath($folder) {
        $path = $folder->name;
        $curr = $folder->parent;
        while ($curr) {
            $path = $curr->name . ' &rsaquo; ' . $path;
            $curr = $curr->parent;
        }
        return $path;
    }
}
@endphp
              @foreach($allFolders->sortBy(function($f){ return strip_tags(getFolderPath($f)); }) as $folder)
              <li>
                <a class="dropdown-item" href="#" onclick="event.preventDefault(); selectCustomFolder('{{ $folder->id }}', '{{ addslashes(strip_tags(getFolderPath($folder))) }}', this)">
                  <span>{!! strip_tags(getFolderPath($folder)) !!}</span>
                  <i class="ti ti-check check-icon"></i>
                </a>
              </li>
              @endforeach
            </ul>
          </div>
        </div>

        @if($allFolders->isEmpty())
        <div class="text-center text-muted py-3 fs-13">
          <i class="ti ti-folder-off fs-2 d-block mb-2 text-muted"></i>
          No folders yet.
          <a href="#" data-bs-toggle="modal" data-bs-target="#createFolderModal" class="text-primary">Create one?</a>
        </div>
        @endif

        <div class="d-flex gap-2 mt-3">
          <button type="button" class="btn btn-light flex-fill" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-primary flex-fill" id="move-confirm-btn" onclick="confirmMove()" disabled>
            <i class="ti ti-check me-1"></i>Move Here
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- File Detail Modal --}}
<div class="modal fade" id="detailModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
      <div class="modal-header border-0 pb-1">
        <h5 class="modal-title fw-bold fs-15 d-flex align-items-center gap-2">
          <i class="ti ti-info-circle" style="color:#4361ee;"></i>
          <span id="detail-title-text">File Details</span>
        </h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body pt-0">
        <div class="row g-4">
          {{-- Left: preview + quick info --}}
          <div class="col-md-5">
            <div class="fm-detail-preview mb-3" id="detail-preview-box"></div>
            <div class="fm-meta-grid mb-3">
              <div class="fm-meta-box">
                <div class="val" id="d-ext">—</div>
                <div class="key">Format</div>
              </div>
              <div class="fm-meta-box">
                <div class="val" id="d-size">—</div>
                <div class="key">Size</div>
              </div>
              <div class="fm-meta-box">
                <div class="val" id="d-dim">—</div>
                <div class="key">Dimensions</div>
              </div>
              <div class="fm-meta-box">
                <div class="val" id="d-date">—</div>
                <div class="key">Uploaded</div>
              </div>
            </div>
            <div class="d-flex gap-2">
              <a id="d-download" href="#" class="btn btn-primary flex-fill fs-13" download>
                <i class="ti ti-download me-1"></i>Download
              </a>
              <button class="btn btn-light flex-fill fs-13"
                      onclick="copyUrl(document.getElementById('d-url').value)">
                <i class="ti ti-link me-1"></i>Copy URL
              </button>
            </div>
            <div class="text-center mt-3">
              <button class="btn btn-light btn-sm me-2" onclick="openMoveFromDetail()">
                <i class="ti ti-folders me-1"></i>Move to Folder
              </button>
              <a href="#" class="text-danger fs-12 text-decoration-none" id="d-delete-link">
                <i class="ti ti-trash me-1"></i>Delete
              </a>
            </div>
          </div>
          {{-- Right: edit form --}}
          <div class="col-md-7">
            <form id="update-file-form">
              @csrf
              <input type="hidden" name="_method" value="PUT">
              <input type="hidden" id="detail-id">

              <div class="mb-3">
                <label class="form-label fs-12 text-muted mb-1">File Name</label>
                <input type="text" class="form-control form-control-sm bg-light" id="d-name" readonly>
              </div>
              <div class="mb-3">
                <label class="form-label fs-12 text-muted mb-1">Public URL</label>
                <div class="input-group input-group-sm">
                  <input type="text" class="form-control bg-light fs-12" id="d-url" readonly>
                  <button type="button" class="btn btn-outline-secondary px-2"
                          onclick="copyUrl(document.getElementById('d-url').value)">
                    <i class="ti ti-copy"></i>
                  </button>
                </div>
              </div>
              <div class="mb-3">
                <label class="form-label fs-12 text-muted mb-1">Folder</label>
                <input type="text" class="form-control form-control-sm bg-light" id="d-folder" readonly>
              </div>
              <hr class="my-3">
              <p class="fw-semibold fs-13 mb-2"><i class="ti ti-tag me-1 text-primary"></i>SEO / Accessibility</p>
              <div class="mb-2">
                <label class="form-label fs-12 text-muted mb-1">Alt Text</label>
                <input type="text" class="form-control form-control-sm" name="alt_text" id="d-alt"
                       placeholder="Describe the image…">
              </div>
              <div class="mb-3">
                <label class="form-label fs-12 text-muted mb-1">Title</label>
                <input type="text" class="form-control form-control-sm" name="title" id="d-ttl"
                       placeholder="Image title…">
              </div>
              <div class="d-flex gap-2">
                <button type="button" class="btn btn-light flex-fill" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary flex-fill" id="detail-save-btn">
                  <i class="ti ti-check me-1"></i>Save Changes
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- Custom Confirm Modal --}}
<div class="modal fade" id="confirmModal" tabindex="-1" aria-hidden="true" style="z-index: 1060;">
  <div class="modal-dialog modal-dialog-centered modal-sm">
    <div class="modal-content border-0 shadow-lg" style="border-radius: 16px; overflow: hidden;">
      <div class="modal-body p-4 text-center">
        <div class="mb-3 mx-auto" id="confirm-icon-wrap" style="width:64px;height:64px;border-radius:50%;display:flex;align-items:center;justify-content:center;background:rgba(239,68,68,.1);">
          <i class="ti ti-trash" id="confirm-icon" style="font-size:2.2rem;color:#ef4444;"></i>
        </div>
        <h5 class="fw-bold mb-2 text-dark" id="confirm-title">Are you sure?</h5>
        <p class="text-muted fs-14 mb-4" id="confirm-text">This action cannot be undone.</p>
        <div class="d-flex gap-2">
          <button type="button" class="btn btn-light flex-fill fw-medium" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-danger flex-fill fw-medium" id="confirm-btn">Yes, Delete</button>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@section('scripts')
<script>
// ─── CSRF TOKEN ────────────────────────────────────────────────────
const CSRF = document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}';
const STORAGE_BASE = '{{ asset("storage") }}';

// ─── TOAST ────────────────────────────────────────────────────────
function showToast(type, msg) {
    const cfg = {
        success:{ cls:'toast-success', icon:'ti-circle-check',      title:'Success' },
        error:  { cls:'toast-error',   icon:'ti-exclamation-circle', title:'Error' },
        warning:{ cls:'toast-warning', icon:'ti-alert-triangle',     title:'Warning' },
        info:   { cls:'toast-info',    icon:'ti-info-circle',        title:'Info' },
    };
    const c = cfg[type] || cfg.info;
    const el = document.createElement('div');
    el.className = `toast custom-toast ${c.cls} fade show`;
    el.setAttribute('data-bs-delay','4000');
    el.innerHTML = `<div class="toast-icon-wrapper"><i class="ti ${c.icon} toast-icon"></i></div>
        <div class="custom-toast-content"><div class="custom-toast-title">${c.title}</div>
        <p class="custom-toast-msg">${msg}</p></div>
        <button type="button" class="custom-toast-close" data-bs-dismiss="toast"><i class="ti ti-x"></i></button>`;
    
    let container = document.querySelector('.toast-container');
    if (!container) {
        container = document.createElement('div');
        container.className = 'toast-container position-fixed bottom-0 end-0 p-3 mb-2';
        container.style.zIndex = '1070';
        document.body.appendChild(container);
    }
    container.appendChild(el);
    const t = new bootstrap.Toast(el,{autohide:true,delay:4000});
    t.show();
    el.addEventListener('hidden.bs.toast',()=>el.remove());
}

// ─── COPY URL ─────────────────────────────────────────────────────
function copyUrl(url) {
    navigator.clipboard.writeText(url)
        .then(()=>showToast('success','URL copied to clipboard!'))
        .catch(()=>{
            const t=document.createElement('textarea');
            t.value=url; document.body.appendChild(t);
            t.select(); document.execCommand('copy');
            t.remove(); showToast('success','URL copied!');
        });
}

// ─── CUSTOM CONFIRM MODAL ─────────────────────────────────────────
let confirmAction = null;
function showConfirm(title, text, actionType, onConfirm) {
    document.getElementById('confirm-title').textContent = title;
    document.getElementById('confirm-text').textContent = text;
    
    const iconWrap = document.getElementById('confirm-icon-wrap');
    const icon = document.getElementById('confirm-icon');
    const btn = document.getElementById('confirm-btn');
    
    if (actionType === 'delete') {
        iconWrap.style.background = 'rgba(239,68,68,.1)';
        icon.className = 'ti ti-trash text-danger';
        btn.className = 'btn btn-danger flex-fill fw-medium';
        btn.innerHTML = 'Yes, Delete';
    } else {
        iconWrap.style.background = 'rgba(245,158,11,.1)';
        icon.className = 'ti ti-alert-triangle text-warning';
        btn.className = 'btn btn-warning flex-fill fw-medium text-white';
        btn.innerHTML = 'Yes, Proceed';
    }
    
    confirmAction = () => {
        bootstrap.Modal.getInstance(document.getElementById('confirmModal')).hide();
        onConfirm();
    };
    
    bootstrap.Modal.getOrCreateInstance(document.getElementById('confirmModal')).show();
}

document.getElementById('confirm-btn').addEventListener('click', () => {
    if(confirmAction) confirmAction();
});

// ─── OPEN FILE DETAIL ────────────────────────────────────────────
let currentFile = null;

function openDetail(id, file) {
    currentFile = file;
    document.getElementById('detail-id').value   = id;
    document.getElementById('d-name').value       = file.original_name;
    document.getElementById('d-alt').value        = file.alt_text || '';
    document.getElementById('d-ttl').value        = file.title || '';
    document.getElementById('detail-title-text').textContent = file.original_name;

    const url  = file.url  || `${STORAGE_BASE}/${file.file_path}`;
    const turl = file.thumbnail_url || url;
    document.getElementById('d-url').value        = url;
    document.getElementById('d-download').href    = url;
    document.getElementById('d-folder').value     = file.folder
        ? (typeof file.folder === 'object' ? file.folder.name : 'Folder') : 'Root';

    // Meta boxes
    const ext = (file.extension||'').toUpperCase();
    document.getElementById('d-ext').textContent  = ext || '—';
    document.getElementById('d-dim').textContent  = file.width ? `${file.width}×${file.height}` : 'N/A';
    document.getElementById('d-date').textContent = file.created_at
        ? new Date(file.created_at).toLocaleDateString('en-GB',{day:'2-digit',month:'short',year:'numeric'})
        : '—';
    const sz = file.file_size;
    document.getElementById('d-size').textContent = sz > 0
        ? (sz<1048576?(sz/1024).toFixed(1)+' KB':(sz/1048576).toFixed(2)+' MB') : '—';

    // Preview
    let preview = '';
    if (file.file_type === 'image') {
        preview = `<img src="${turl}" style="width:100%;max-height:270px;object-fit:contain;" onerror="this.src='${url}'">`;
    } else {
        const icons = {video:'ti-video fi-video',pdf:'ti-file-type-pdf fi-pdf'};
        const ic = icons[file.extension] || 'ti-file-text fi-default';
        preview = `<div class="py-5 text-center"><i class="ti ${ic}" style="font-size:4rem;"></i></div>`;
    }
    document.getElementById('detail-preview-box').innerHTML = preview;

    // Delete link
    document.getElementById('d-delete-link').onclick = (e) => {
        e.preventDefault();
        bootstrap.Modal.getInstance(document.getElementById('detailModal')).hide();
        setTimeout(() => deleteFile(id), 300);
    };

    bootstrap.Modal.getOrCreateInstance(document.getElementById('detailModal')).show();
}

// ─── SAVE FILE DETAILS ───────────────────────────────────────────
const updateForm = document.getElementById('update-file-form');
if (updateForm) {
updateForm.addEventListener('submit', function(e){
    e.preventDefault();
    const id  = document.getElementById('detail-id').value;
    const btn = document.getElementById('detail-save-btn');
    btn.disabled=true; btn.innerHTML='<span class="spinner-border spinner-border-sm me-1"></span>Saving…';
    fetch(`/admin/media/${id}`,{method:'POST',body:new FormData(this),headers:{'X-Requested-With':'XMLHttpRequest'}})
    .then(r=>r.json()).then(d=>{
        btn.disabled=false; btn.innerHTML='<i class="ti ti-check me-1"></i>Save Changes';
        if(d.success){ bootstrap.Modal.getInstance(document.getElementById('detailModal')).hide(); showToast('success',d.message||'Saved!'); }
        else showToast('error',d.message||'Failed.');
    }).catch(()=>{ btn.disabled=false; btn.innerHTML='<i class="ti ti-check me-1"></i>Save Changes'; showToast('error','Network error.'); });
});
}

// ─── DELETE FILE ─────────────────────────────────────────────────
function deleteFile(id) {
    showConfirm('Delete File', 'Are you sure you want to delete this file permanently?', 'delete', () => {
        fetch(`/admin/media/${id}`,{method:'DELETE',headers:{'X-CSRF-TOKEN':CSRF,'Content-Type':'application/json','X-Requested-With':'XMLHttpRequest'}})
        .then(r=>r.json()).then(d=>{
            if(d.success){ showToast('success',d.message||'Deleted.'); setTimeout(()=>location.reload(),700); }
            else showToast('error',d.message||'Failed.');
        }).catch(()=>showToast('error','Network error.'));
    });
}

// ─── MOVE TO FOLDER ──────────────────────────────────────────────
let moveFileIds = []; // can be single id or array

function openMove(id) {
    moveFileIds = [id];
    resetMoveModal('Move 1 File');
    bootstrap.Modal.getOrCreateInstance(document.getElementById('moveModal')).show();
}

function openMoveFromDetail() {
    const id = document.getElementById('detail-id').value;
    bootstrap.Modal.getInstance(document.getElementById('detailModal')).hide();
    setTimeout(() => {
        moveFileIds = [id];
        resetMoveModal('Move File');
        bootstrap.Modal.getOrCreateInstance(document.getElementById('moveModal')).show();
    }, 300);
}

function openBulkMove() {
    const ids = [...document.querySelectorAll('.file-cb:checked')].map(c=>c.value);
    if(!ids.length) return;
    moveFileIds = ids;
    resetMoveModal(`Move ${ids.length} File${ids.length>1?'s':''}`);
    bootstrap.Modal.getOrCreateInstance(document.getElementById('moveModal')).show();
}

function resetMoveModal(subtitle) {
    document.getElementById('move-subtitle').textContent = subtitle + ' — choose destination';
    document.getElementById('move-selected-folder').value = 'none';
    document.getElementById('fm-custom-select-text').textContent = '-- Select Destination --';
    document.getElementById('fm-custom-select-text').style.color = '#94a3b8';
    document.querySelectorAll('#moveModal .dropdown-item').forEach(o => o.classList.remove('selected'));
    document.getElementById('move-confirm-btn').disabled = true;
}

function selectCustomFolder(val, text, el) {
    document.getElementById('move-selected-folder').value = val;
    document.getElementById('fm-custom-select-text').textContent = text;
    document.getElementById('fm-custom-select-text').style.color = '#1e2340';
    document.querySelectorAll('#moveModal .dropdown-item').forEach(o => o.classList.remove('selected'));
    el.classList.add('selected');
    document.getElementById('move-confirm-btn').disabled = false;
}

function confirmMove() {
    const folderId = document.getElementById('move-selected-folder').value;
    const ids      = moveFileIds;
    if(!ids.length) return;

    const btn = document.getElementById('move-confirm-btn');
    btn.disabled = true;
    btn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span>Moving…';

    const isBulk = ids.length > 1;
    const url  = isBulk ? '{{ route("admin.media.bulk_move") }}' : `/admin/media/${ids[0]}/move`;
    const body = isBulk
        ? JSON.stringify({ ids, folder_id: folderId || null })
        : JSON.stringify({ folder_id: folderId || null });

    fetch(url, {
        method: 'POST',
        body,
        headers: { 'X-CSRF-TOKEN':CSRF, 'Content-Type':'application/json', 'X-Requested-With':'XMLHttpRequest' }
    })
    .then(r=>r.json())
    .then(d=>{
        btn.disabled=false; btn.innerHTML='<i class="ti ti-check me-1"></i>Move Here';
        if(d.success){
            bootstrap.Modal.getInstance(document.getElementById('moveModal')).hide();
            showToast('success', d.message||'Moved!');
            setTimeout(()=>location.reload(), 700);
        } else {
            showToast('error', d.message||'Move failed.');
        }
    })
    .catch(()=>{ btn.disabled=false; btn.innerHTML='<i class="ti ti-check me-1"></i>Move Here'; showToast('error','Network error.'); });
}

// ─── CREATE FOLDER ───────────────────────────────────────────────
const createForm = document.getElementById('create-folder-form');
if (createForm) {
createForm.addEventListener('submit', function(e){
    e.preventDefault();
    const btn = document.getElementById('create-folder-btn');
    btn.disabled=true;
    
    let fd = new FormData(this);
    if (!fd.get('parent_id')) {
        fd.delete('parent_id');
    }

    fetch('{{ route("admin.folders.store") }}',{method:'POST',body:fd,headers:{'X-Requested-With':'XMLHttpRequest'}})
    .then(async r => {
        const d = await r.json();
        if(!r.ok) throw d;
        return d;
    })
    .then(d=>{
        btn.disabled=false;
        bootstrap.Modal.getInstance(document.getElementById('createFolderModal')).hide();
        showToast('success',d.message||'Created!');
        setTimeout(()=>location.reload(),600);
    })
    .catch((err)=>{
        btn.disabled=false;
        let m = err.message || 'Failed to create folder.';
        if (err.errors) m += '\n' + Object.values(err.errors).flat().join('\n');
        showToast('error', m);
    });
});
}
const createModal = document.getElementById('createFolderModal');
if (createModal) {
createModal.addEventListener('show.bs.modal',()=>{
    const form = document.getElementById('create-folder-form');
    if(form) form.reset();
    const btn = document.getElementById('create-folder-btn');
    if(btn) btn.disabled=false;
});
}

// ─── RENAME FOLDER ────────────────────────────────────────────────
function renameFolder(id, name) {
    document.getElementById('rename-folder-id').value    = id;
    document.getElementById('rename-folder-input').value = name;
    bootstrap.Modal.getOrCreateInstance(document.getElementById('renameFolderModal')).show();
}
const renameForm = document.getElementById('rename-folder-form');
if (renameForm) {
renameForm.addEventListener('submit', function(e){
    e.preventDefault();
    const id = document.getElementById('rename-folder-id').value;
    const name = document.getElementById('rename-folder-input').value.trim();
    if(!name) return;
    const fd=new FormData(); fd.append('_method','PUT'); fd.append('name',name); fd.append('_token',CSRF);
    
    fetch(`/admin/folders/${id}`,{method:'POST',body:fd,headers:{'X-Requested-With':'XMLHttpRequest'}})
    .then(async r => {
        const d = await r.json();
        if(!r.ok) throw d;
        return d;
    })
    .then(d=>{
        bootstrap.Modal.getInstance(document.getElementById('renameFolderModal')).hide();
        showToast('success','Folder renamed.');
        setTimeout(()=>location.reload(),600);
    })
    .catch((err)=>{
        let m = err.message || 'Failed to rename folder.';
        if (err.errors) m += '\n' + Object.values(err.errors).flat().join('\n');
        showToast('error', m);
    });
});
}

// ─── DELETE FOLDER ───────────────────────────────────────────────
function deleteFolder(id) {
    showConfirm('Delete Folder', 'Are you sure? All files inside will be moved to the root folder.', 'delete', () => {
        fetch(`/admin/folders/${id}`,{method:'DELETE',headers:{'X-CSRF-TOKEN':CSRF,'Content-Type':'application/json','X-Requested-With':'XMLHttpRequest'}})
        .then(r=>r.json()).then(d=>{
            if(d.success){ showToast('success','Folder deleted.'); setTimeout(()=>location.reload(),600); }
            else showToast('error',d.message||'Failed.');
        }).catch(()=>showToast('error','Network error.'));
    });
}

// ─── UPLOAD ──────────────────────────────────────────────────────
function triggerUpload(){ 
    const fi = document.getElementById('file-upload-input');
    if(fi) fi.click(); 
}
const utb = document.getElementById('upload-trigger-btn');
if (utb) utb.addEventListener('click', triggerUpload);
const emptyBtn = document.getElementById('empty-upload-btn');
if(emptyBtn) emptyBtn.addEventListener('click', triggerUpload);

const fui = document.getElementById('file-upload-input');
if (fui) {
fui.addEventListener('change', function(){
    if(this.files.length) uploadFiles(this.files);
    this.value='';
});
}

function uploadFiles(files) {
    if(!files||!files.length) return;
    const fd=new FormData();
    const names=[];
    for(let i=0;i<files.length;i++){ fd.append('files[]',files[i]); names.push(files[i].name); }
    const fid='{{ request("folder_id") }}'; if(fid) fd.append('folder_id',fid);

    const pw=document.getElementById('upload-progress-wrap');
    const pb=document.getElementById('upload-bar');
    const pt=document.getElementById('upload-pct');
    const pn=document.getElementById('upload-names');
    pw.style.display='block'; pb.style.width='0%'; pt.textContent='0%';
    pn.textContent=names.slice(0,3).join(', ')+(names.length>3?` +${names.length-3} more`:'');

    const xhr=new XMLHttpRequest();
    xhr.open('POST','{{ route("admin.media.store") }}',true);
    xhr.setRequestHeader('X-CSRF-TOKEN',CSRF);
    xhr.setRequestHeader('X-Requested-With','XMLHttpRequest');
    xhr.upload.onprogress=e=>{
        if(e.lengthComputable){ const p=Math.round(e.loaded/e.total*100); pb.style.width=p+'%'; pt.textContent=p+'%'; }
    };
    xhr.onload=()=>{
        pw.style.display='none';
        try{
            const r=JSON.parse(xhr.responseText);
            if(xhr.status===200&&r.success){ showToast('success',r.message||'Uploaded!'); setTimeout(()=>location.reload(),700); }
            else{ let m=r.message||'Upload failed.'; if(r.errors)m+='\n'+Object.values(r.errors).flat().join('\n'); showToast('error',m); }
        }catch{ showToast('error','Server error (HTTP '+xhr.status+').'); }
    };
    xhr.onerror=()=>{ pw.style.display='none'; showToast('error','Network error.'); };
    xhr.send(fd);
}

// ─── DRAG & DROP (fullscreen overlay) ───────────────────────────
const overlay=document.getElementById('fm-drop-overlay');
let dragDepth=0;
document.addEventListener('dragenter',e=>{ e.preventDefault(); dragDepth++; overlay.classList.add('active'); });
document.addEventListener('dragleave',e=>{ dragDepth--; if(dragDepth<=0){ dragDepth=0; overlay.classList.remove('active'); } });
document.addEventListener('dragover',e=>e.preventDefault());
document.addEventListener('drop',e=>{ e.preventDefault(); dragDepth=0; overlay.classList.remove('active'); if(e.dataTransfer?.files.length) uploadFiles(e.dataTransfer.files); });

// ─── SELECTION (card checkbox) ───────────────────────────────────
let selectedIds=new Set();

function toggleCardState(cb, id) {
    const card=cb.closest('.fm-card');
    if(cb.checked){
        selectedIds.add(id);
        if(card) card.classList.add('fm-selected');
    } else {
        selectedIds.delete(id);
        if(card) card.classList.remove('fm-selected');
    }
    updateBulk();
}

function updateBulk() {
    const allCbs=[...document.querySelectorAll('.file-cb:checked')];
    selectedIds=new Set(allCbs.map(c=>parseInt(c.value)));
    const bar=document.getElementById('fm-bulk');
    const lbl=document.getElementById('bulk-label');
    if(selectedIds.size>0){
        lbl.textContent=`${selectedIds.size} file${selectedIds.size>1?'s':''} selected`;
        bar.classList.add('show');
    } else {
        bar.classList.remove('show');
    }
}

function selectAll(cb) {
    document.querySelectorAll('.file-cb').forEach(c=>{ c.checked=cb.checked; });
    // sync grid card selection
    document.querySelectorAll('.fm-card').forEach(card=>{
        if(cb.checked) card.classList.add('fm-selected');
        else card.classList.remove('fm-selected');
    });
    updateBulk();
}

function clearAll() {
    selectedIds.clear();
    document.querySelectorAll('.file-cb').forEach(c=>c.checked=false);
    document.querySelectorAll('.fm-card').forEach(c=>c.classList.remove('fm-selected'));
    const sa=document.getElementById('check-all'); if(sa) sa.checked=false;
    document.getElementById('fm-bulk').classList.remove('show');
}

// ─── BULK DELETE ─────────────────────────────────────────────────
function bulkDelete() {
    const ids=[...selectedIds];
    if(!ids.length) return;
    showConfirm('Bulk Delete', `Are you sure you want to permanently delete ${ids.length} selected file(s)?`, 'delete', () => {
        fetch('{{ route("admin.media.bulk_destroy") }}',{
            method:'POST', body:JSON.stringify({ids}),
            headers:{'X-CSRF-TOKEN':CSRF,'Content-Type':'application/json','X-Requested-With':'XMLHttpRequest'}
        }).then(r=>r.json()).then(d=>{
            if(d.success){ showToast('success',d.message||'Deleted.'); setTimeout(()=>location.reload(),700); }
            else showToast('error',d.message||'Failed.');
        }).catch(()=>showToast('error','Network error.'));
    });
}

// ─── GRID / LIST TOGGLE ──────────────────────────────────────────
const viewGrid=document.getElementById('view-grid');
const viewList=document.getElementById('view-list');
const btnGrid=document.getElementById('btn-grid');
const btnList=document.getElementById('btn-list');

if (btnGrid && btnList && viewGrid && viewList) {
    btnGrid.addEventListener('click',()=>{ viewGrid.style.display=''; viewList.style.display='none'; btnGrid.classList.add('active'); btnList.classList.remove('active'); localStorage.setItem('fm-view','grid'); });
    btnList.addEventListener('click',()=>{ viewGrid.style.display='none'; viewList.style.display=''; btnList.classList.add('active'); btnGrid.classList.remove('active'); localStorage.setItem('fm-view','list'); });
    (()=>{ if(localStorage.getItem('fm-view')==='list') btnList.click(); else btnGrid.click(); })();
}

// ─── SEARCH CLEAR ────────────────────────────────────────────────
function clearSearch(){
    document.querySelector('[name=search]').value='';
    document.getElementById('filter-form').submit();
}
</script>
@endsection

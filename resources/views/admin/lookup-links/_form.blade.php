<div style="margin-bottom:18px;">
    <label style="display:block;margin-bottom:8px;font-weight:600;">Tiêu đề</label>
    <input type="text"
           name="title"
           value="{{ old('title', $lookupLink->title ?? '') }}"
           style="width:100%;min-height:42px;border:1px solid #cbd5e1;border-radius:8px;padding:9px 12px;"
           placeholder="Ví dụ: Dịch vụ công trực tuyến">

    @error('title')
        <div style="margin-top:6px;color:#dc2626;font-size:13px;">{{ $message }}</div>
    @enderror
</div>

<div style="margin-bottom:18px;">
    <label style="display:block;margin-bottom:8px;font-weight:600;">Liên kết</label>
    <input type="url"
           name="url"
           value="{{ old('url', $lookupLink->url ?? '') }}"
           style="width:100%;min-height:42px;border:1px solid #cbd5e1;border-radius:8px;padding:9px 12px;"
           placeholder="https://...">

    @error('url')
        <div style="margin-top:6px;color:#dc2626;font-size:13px;">{{ $message }}</div>
    @enderror
</div>

<div style="margin-bottom:18px;">
    <label style="display:block;margin-bottom:8px;font-weight:600;">Ảnh / Banner</label>
    <input type="file"
           name="image"
           accept="image/*"
           style="width:100%;min-height:42px;border:1px solid #cbd5e1;border-radius:8px;padding:9px 12px;">

    @error('image')
        <div style="margin-top:6px;color:#dc2626;font-size:13px;">{{ $message }}</div>
    @enderror

    @if(!empty($lookupLink->image_path))
        <div style="margin-top:10px;">
            <img src="{{ asset('storage/' . $lookupLink->image_path) }}"
                 alt="{{ $lookupLink->title }}"
                 style="width:160px;height:90px;object-fit:cover;border-radius:8px;border:1px solid #e5e7eb;">
        </div>
    @endif
</div>

<div style="margin-bottom:18px;">
    <label style="display:block;margin-bottom:8px;font-weight:600;">Màu nền</label>
    <input type="text"
           name="background_color"
           value="{{ old('background_color', $lookupLink->background_color ?? '#eef6ff') }}"
           style="width:100%;min-height:42px;border:1px solid #cbd5e1;border-radius:8px;padding:9px 12px;"
           placeholder="#eef6ff">
</div>

<div style="margin-bottom:18px;">
    <label style="display:block;margin-bottom:8px;font-weight:600;">Thứ tự hiển thị</label>
    <input type="number"
           name="sort_order"
           value="{{ old('sort_order', $lookupLink->sort_order ?? 0) }}"
           min="0"
           style="width:100%;min-height:42px;border:1px solid #cbd5e1;border-radius:8px;padding:9px 12px;">
</div>

<div style="margin-bottom:12px;">
    <label>
        <input type="checkbox" name="open_new_tab" value="1" @checked(old('open_new_tab', $lookupLink->open_new_tab ?? false))>
        Mở liên kết trong tab mới
    </label>
</div>

<div>
    <label>
        <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $lookupLink->is_active ?? true))>
        Hiển thị ngoài trang chủ
    </label>
</div>
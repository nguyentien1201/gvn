<div class="form-group">
    <label>Tiêu đề</label>

    <input type="text"
           name="title"
           class="form-control"
           value="{{ old('title',$event->title ?? '') }}">
</div>

<div class="form-group">
    <label>Ảnh bìa</label>

    <input type="file"
           name="thumbnail"
           class="form-control">
</div>

<div class="form-group">
    <label>Mô tả ngắn</label>

    <textarea name="short_description"
              class="form-control"
              rows="3">{{ old('short_description',$event->short_description ?? '') }}</textarea>
</div>

<div class="form-group">
    <label>Nội dung</label>

    <textarea name="content"
              class="form-control editor"
              rows="10">{{ old('content',$event->content ?? '') }}</textarea>
</div>

<div class="form-group">
    <label>Link đăng ký</label>

    <input type="text"
           name="register_link"
           class="form-control"
           value="{{ old('register_link',$event->register_link ?? '') }}">
</div>

<div class="form-group">
    <label>Ngày bắt đầu</label>

    <input type="datetime-local"
           name="start_date"
           class="form-control">
</div>

<div class="form-group">
    <label>Ngày kết thúc</label>

    <input type="datetime-local"
           name="end_date"
           class="form-control">
</div>

<div class="form-group">
    <label>Hiển thị</label>

    <input type="checkbox"
           name="status"
           value="1"
           checked>
</div>

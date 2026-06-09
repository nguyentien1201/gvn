<div class="form-group">
    <label>Time</label>

    <input type="text"
           name="year"
           class="form-control"
           value="{{ old('year',$timeline->year ?? '') }}"
           placeholder="2012-2018">
</div>

<div class="form-group">
    <label>Title</label>

    <input type="text"
           name="title"
           class="form-control"
           value="{{ old('title',$timeline->title ?? '') }}">
</div>

<div class="form-group">
    <label>Description</label>

    <textarea name="description"
              rows="5"
              class="form-control">{{ old('description',$timeline->description ?? '') }}</textarea>
</div>

<div class="form-group">
    <label>Icon</label>

    @if(!empty($timeline->icon))
        <div class="mb-2">
            <img src="{{ asset('storage/' . $timeline->icon) }}"
                 width="80"
                 alt="icon">
        </div>
    @endif

    <input type="file"
           name="icon"
           class="form-control-file"
           accept="image/*">
</div>

<div class="form-group">
    <label>Color</label>

    <input type="color"
           name="color"
           class="form-control"
           value="{{ old('color',$timeline->color ?? '#dc3545') }}">
</div>

<div class="form-group">
    <label>Sort Order</label>

    <input type="number"
           name="sort_order"
           class="form-control"
           value="{{ old('sort_order',$timeline->sort_order ?? 0) }}">
</div>

<div class="form-group">

    <label>

        <input type="checkbox"
               name="status"
               value="1"
               {{ ($timeline->status ?? 1) ? 'checked' : '' }}>

        Active

    </label>

</div>

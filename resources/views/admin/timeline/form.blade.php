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

    <select name="icon" class="form-control">

        <option value="fa-play"
            {{ ($timeline->icon ?? '') == 'fa-play' ? 'selected' : '' }}>
            Start
        </option>

        <option value="fa-list-check"
            {{ ($timeline->icon ?? '') == 'fa-list-check' ? 'selected' : '' }}>
            Checklist
        </option>

        <option value="fa-code"
            {{ ($timeline->icon ?? '') == 'fa-code' ? 'selected' : '' }}>
            Code
        </option>

        <option value="fa-award"
            {{ ($timeline->icon ?? '') == 'fa-award' ? 'selected' : '' }}>
            Award
        </option>

        <option value="fa-rocket"
            {{ ($timeline->icon ?? '') == 'fa-rocket' ? 'selected' : '' }}>
            Rocket
        </option>

        <option value="fa-leaf"
            {{ ($timeline->icon ?? '') == 'fa-leaf' ? 'selected' : '' }}>
            Leaf
        </option>

    </select>
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

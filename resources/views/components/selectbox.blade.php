<div class="form-group mb-3 {{ $col ?? '' }} {{ $required ?? '' }}">
    <label for="{{ $name }}">{{ $labelName }}</label>
    <select class="form-select {{ $name ?? '' }}" aria-label="Default select example" name="{{ $name }}"
        id="{{ $name }}">
        <option value="">Select Please</option>
        {{ $slot }}
    </select>
</div>

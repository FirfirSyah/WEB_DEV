<label for="name">Nama Kategori</label>
<input type="text" id="name" name="name" value="{{ old('name', $category->name ?? '') }}" required autofocus>
@error('name') <small class="field-error">{{ $message }}</small> @enderror
@error('slug') <small class="field-error">{{ $message }}</small> @enderror

<label for="description">Deskripsi (opsional)</label>
<textarea id="description" name="description" rows="4">{{ old('description', $category->description ?? '') }}</textarea>
@error('description') <small class="field-error">{{ $message }}</small> @enderror

<div class="actions">
    <button type="submit" class="btn btn-gold">Simpan</button>
    <a href="{{ route('admin.categories.index') }}" class="btn btn-light">Batal</a>
</div>
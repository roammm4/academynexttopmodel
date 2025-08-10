<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>{{ __('messages.editmodel_title') }}</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Fondamento&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/alpinejs" defer></script>
  <style>
    body { font-family: 'Open Sans', sans-serif; }
    .font-fondamento { font-family: 'Fondamento', cursive; }
  </style>
</head>
<body class="bg-black text-white">
  @include('navbar')

  <div class="flex items-center justify-center px-4 py-8 text-sm">
    <div class="max-w-6xl w-full grid grid-cols-1 md:grid-cols-2 gap-6 items-start">
      
      <!-- Kolom Kiri: Ilustrasi Gambar -->
      <div class="w-full h-6/7 py-10">
      <img src="{{ $model->photo ? asset('storage/' . $model->photo) : asset('img/login.jpg') }}" alt="Ilustrasi Model" class="w-full h-full object-cover rounded-lg shadow-lg">
    </div>
    <!-- Kolom Kanan: Form -->
    <form action="{{ route('models.update', $model->id_model) }}" method="POST" enctype="multipart/form-data" class="space-y-4" x-data="{ preview: null }">
      @csrf
      @method('PUT')
      <h1 class="text-3xl font-fondamento text-center mb-2">{{ __('messages.editmodel_title') }}</h1>
      @if ($errors->any())
        <div class="bg-red-600 text-white p-2 rounded mb-2 text-xs">
          <ul class="space-y-1">
            @foreach ($errors->all() as $error)
              <li>{{ __('messages.editmodel_error_prefix') }} {{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
      <div class="grid grid-cols-2 gap-4">
        <div>
          <label>{{ __('messages.editmodel_name') }}</label>
          <input type="text" name="nama_model" value="{{ old('nama_model', $model->nama_model) }}" class="w-full p-1.5 rounded text-black text-sm" required>
        </div>
        <div>
          <label>{{ __('messages.editmodel_city') }}</label>
          <input type="text" name="city" value="{{ old('city', $model->city) }}" class="w-full p-1.5 rounded text-black text-sm" required>
        </div>
      </div>
      <div class="grid grid-cols-4 gap-4">
        <div>
          <label>{{ __('messages.editmodel_height') }}</label>
          <input type="number" name="height" value="{{ old('height', $model->height) }}" class="w-full p-1.5 rounded text-black text-sm" required>
        </div>
        <div>
          <label>{{ __('messages.editmodel_weight') }}</label>
          <input type="number" name="weight" value="{{ old('weight', $model->weight) }}" class="w-full p-1.5 rounded text-black text-sm" required>
        </div>
        <div>
          <label>{{ __('messages.editmodel_age') }}</label>
          <input type="number" name="age" value="{{ old('age', $model->age) }}" class="w-full p-1.5 rounded text-black text-sm" required>
        </div>
        <div>
          <label>{{ __('messages.editmodel_shoes') }}</label>
          <input type="number" name="shoes_size" value="{{ old('shoes_size', $model->shoes_size) }}" class="w-full p-1.5 rounded text-black text-sm">
        </div>
        <div>
          <label>{{ __('messages.editmodel_size') }}</label>
          <input type="text" name="size" value="{{ old('size', $model->size) }}" class="w-full p-1.5 rounded text-black text-sm">
        </div>
        <div>
          <label>{{ __('messages.editmodel_bust') }}</label>
          <input type="number" name="bust" value="{{ old('bust', $model->bust) }}" class="w-full p-1.5 rounded text-black text-sm">
        </div>
        <div>
          <label>{{ __('messages.editmodel_waist') }}</label>
          <input type="number" name="waist" value="{{ old('waist', $model->waist) }}" class="w-full p-1.5 rounded text-black text-sm">
        </div>
        <div>
    <label>{{ __('messages.editmodel_experience') }}</label>
    <div class="flex gap-2">
        <input type="number" min="0" name="experience_value" value="{{ old('experience_value', $model->experience_value ?? '') }}" class="w-1/2 p-1 rounded text-black text-sm" required>
        <select name="experience_unit" class="w-1/2 p-1.5 rounded text-black text-sm" required>
            <option value="months" {{ (old('experience_unit', $model->experience_unit ?? '') == 'months') ? 'selected' : '' }}>{{ __('messages.portofolio_months') }}</option>
            <option value="years" {{ (old('experience_unit', $model->experience_unit ?? '') == 'years') ? 'selected' : '' }}>{{ __('messages.portofolio_years') }}</option>
        </select>
    </div>
</div>
      </div>
      <div class="grid grid-cols-2 gap-4">
        <div>
          <label>{{ __('messages.editmodel_category') }}</label>
          <select name="categories" class="w-full p-1.5 rounded text-black text-sm" required>
            <option value="">{{ __('messages.editmodel_select_category') }}</option>
            <option value="kids" {{ old('categories', $model->categories) == 'kids' ? 'selected' : '' }}>{{ __('messages.editmodel_kids') }}</option>
            <option value="teens" {{ old('categories', $model->categories) == 'teens' ? 'selected' : '' }}>{{ __('messages.editmodel_teens') }}</option>
          </select>
        </div>
        <div>
          <label>{{ __('messages.editmodel_status') }}</label>
          <select name="status" class="w-full p-1.5 rounded text-black text-sm" required>
            <option value="">{{ __('messages.editmodel_select_status') }}</option>
            <option value="available" {{ old('status', $model->status) == 'available' ? 'selected' : '' }}>{{ __('messages.editmodel_available') }}</option>
            <option value="unavailable" {{ old('status', $model->status) == 'unavailable' ? 'selected' : '' }}>{{ __('messages.editmodel_unavailable') }}</option>
          </select>
        </div>
      </div>
      <!-- Upload Foto -->
      <div>
        <label class="block text-sm font-semibold mb-1">{{ __('messages.editmodel_photo') }}</label>
        <label for="photo" class="relative flex items-center justify-center w-full h-48 border-2 border-dashed rounded-md cursor-pointer hover:bg-gray-800 transition">
          <div class="text-gray-400 text-xs text-center" x-show="!preview">
            <svg aria-hidden="true" class="w-6 h-6 mx-auto mb-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path>
            </svg>
            {{ __('messages.editmodel_upload_hint') }}
            @if($model->photo)
              <div class="mt-2 text-center">
                <span class="block text-xs text-gray-400">{{ __('messages.editmodel_current_photo') }}</span>
                <img src="{{ asset('storage/' . $model->photo) }}" alt="Current Photo" class="mx-auto w-16 h-16 object-cover rounded mt-1">
              </div>
            @endif
          </div>
          <div class="absolute w-24 h-24 rounded-md overflow-hidden" x-show="preview">
            <img :src="preview" alt="Preview" class="object-cover w-full h-full">
          </div>
          <input id="photo" type="file" name="photo" accept="image/*" class="hidden"
            @change="const file = $event.target.files[0]; preview = URL.createObjectURL(file)">
        </label>
      </div>
      <div class="text-center mt-3">
        <button type="submit" class="bg-white text-black px-4 py-1.5 rounded font-semibold text-sm hover:bg-gray-200">
          {{ __('messages.editmodel_submit') }}
        </button>
      </div>
    </form>
  </div>
</body>
</html>

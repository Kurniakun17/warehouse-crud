@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="mb-0">Edit Barang - {{ $item->name }}</h3>
                        <a href="{{ route('items.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('items.update', $item->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="code" class="form-label">Kode Barang <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('code') is-invalid @enderror" 
                                   id="code" name="code" value="{{ old('code', $item->code) }}" required>
                            @error('code')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Barang <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name', $item->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="category" class="form-label">Kategori <span class="text-danger">*</span></label>
                            <select class="form-select @error('category') is-invalid @enderror" 
                                    id="category" name="category" required>
                                <option value="">Pilih Kategori</option>
                                <option value="Baut L12x25mm" {{ old('category') == 'Baut L12x25mm' ? 'selected' : '' }}>Baut L12x25mm</option>
                                <option value="Baut L12x85mm" {{ old('category') == 'Baut L12x85mm' ? 'selected' : '' }}>Baut L12x85mm</option>
                                <option value="Baut L12x30mm" {{ old('category') == 'Baut L12x30mm' ? 'selected' : '' }}>Baut L12x30mm</option>
                                <option value="Baut L12x45mm" {{ old('category') == 'Baut L12x45mm' ? 'selected' : '' }}>Baut L12x45mm</option>
                                <option value="Baut L6x25mm" {{ old('category') == 'Baut L6x25mm' ? 'selected' : '' }}>Baut L6x25mm</option>
                                <option value="Nut M8" {{ old('category') == 'Nut M8' ? 'selected' : '' }}>Nut M8</option>
                                <option value="Nut M10" {{ old('category') == 'Nut M10' ? 'selected' : '' }}>Nut M10</option>
                                <option value="Nut M12" {{ old('category') == 'Nut M12' ? 'selected' : '' }}>Nut M12</option>
                                <option value="CLOCK PORTAFILTER" {{ old('category') == 'CLOCK PORTAFILTER' ? 'selected' : '' }}>CLOCK PORTAFILTER</option>
                                <option value="LOCK PORTAFILTER" {{ old('category') == 'LOCK PORTAFILTER' ? 'selected' : '' }}>LOCK PORTAFILTER</option>
                                <option value="PORTAFILTER" {{ old('category') == 'PORTAFILTER' ? 'selected' : '' }}>PORTAFILTER</option>
                                <option value="Power Support 80mm" {{ old('category') == 'Power Support 80mm' ? 'selected' : '' }}>Power Support 80mm</option>
                                <option value="Pin Arm" {{ old('category') == 'Pin Arm' ? 'selected' : '' }}>Pin Arm</option>
                            </select>
                            @error('category')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="material" class="form-label">Material <span class="text-danger">*</span></label>
                            <select class="form-select @error('material') is-invalid @enderror" 
                                    id="material" name="material" required>
                                <option value="">Pilih Material</option>
                                <option value="Aluminium 6061" {{ old('material') == 'Aluminium 6061' ? 'selected' : '' }}>Aluminium 6061</option>
                                <option value="Duralumin" {{ old('material') == 'Duralumin' ? 'selected' : '' }}>Duralumin</option>
                                <option value="Rubber" {{ old('material') == 'Rubber' ? 'selected' : '' }}>Rubber</option>
                            </select>
                            @error('material')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="stock" class="form-label">Stok <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('stock') is-invalid @enderror" 
                                           id="stock" name="stock" value="{{ old('stock', $item->stock) }}" min="0" required>
                                    <small class="text-muted">Stok saat ini: {{ $item->stock }}</small>
                                    @error('stock')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="unit" class="form-label">Satuan <span class="text-danger">*</span></label>
                                    <select class="form-select @error('unit') is-invalid @enderror" 
                                            id="unit" name="unit" required>
                                        <option value="">Pilih Satuan</option>
                                        <option value="Pcs" {{ old('unit', $item->unit) == 'Pcs' ? 'selected' : '' }}>Pcs</option>
                                        <option value="Box" {{ old('unit', $item->unit) == 'Box' ? 'selected' : '' }}>Box</option>
                                        <option value="Kg" {{ old('unit', $item->unit) == 'Kg' ? 'selected' : '' }}>Kg</option>
                                        <option value="Liter" {{ old('unit', $item->unit) == 'Liter' ? 'selected' : '' }}>Liter</option>
                                        <option value="Lusin" {{ old('unit', $item->unit) == 'Lusin' ? 'selected' : '' }}>Lusin</option>
                                    </select>
                                    @error('unit')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="3">{{ old('description', $item->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Update Barang</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
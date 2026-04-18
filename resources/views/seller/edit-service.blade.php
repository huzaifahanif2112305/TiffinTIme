@extends('seller.layouts.app')

@section('title', 'Edit Service')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/sellerEditService.css') }}">
@endsection

@section('content')
    <div class="edit-service-container">
        <h2>
            <i class="fas fa-edit me-2"></i>Edit Service
        </h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('seller.updateService', $service->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="service_name">Service Name</label>
                <input type="text" id="service_name" name="service_name" class="form-control"
                    value="{{ old('service_name', $service->service_name) }}" required>
            </div>

            <div class="form-group">
                <label for="service_description">Service Description</label>
                <textarea id="service_description" name="service_description" class="form-control" rows="4"
                    required>{{ old('service_description', $service->service_description) }}</textarea>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="seller_city">City</label>
                        <input type="text" id="seller_city" name="seller_city" class="form-control"
                            value="{{ old('seller_city', $service->seller_city) }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="seller_area">Area</label>
                        <input type="text" id="seller_area" name="seller_area" class="form-control"
                            value="{{ old('seller_area', $service->seller_area) }}" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 mb-3">
                    <label class="form-label"><i class="fas fa-calendar-alt me-2"></i>Availability Days</label>
                    <div class="day-selector d-flex gap-2 flex-wrap">
                        @php $days = $service->availability_days ?? []; @endphp
                        @foreach(['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'] as $day)
                            <input type="checkbox" class="btn-check" name="availability_days[]" id="day_{{ $day }}"
                                value="{{ $day }}" autocomplete="off" {{ in_array($day, $days) ? 'checked' : '' }}>
                            <label class="btn btn-outline-primary rounded-pill" for="day_{{ $day }}">{{ $day }}</label>
                        @endforeach
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label"><i class="fas fa-clock me-2"></i>Time Slot</label>
                    <div class="input-group mb-2">
                        <span class="input-group-text">Start</span>
                        <input type="time" class="form-control" name="start_time" id="start_time"
                            value="{{ $service->start_time ? \Carbon\Carbon::parse($service->start_time)->format('H:i') : '' }}"
                            {{ !$service->start_time ? 'disabled' : '' }}>
                        <span class="input-group-text">End</span>
                        <input type="time" class="form-control" name="end_time" id="end_time"
                            value="{{ $service->end_time ? \Carbon\Carbon::parse($service->end_time)->format('H:i') : '' }}"
                            {{ !$service->end_time ? 'disabled' : '' }}>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="all_day" name="all_day" value="1" {{ !$service->start_time && !$service->end_time ? 'checked' : '' }}>
                        <label class="form-check-label" for="all_day">All Day Availability</label>
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="category_tag" class="form-label"><i class="fas fa-utensils me-2"></i>Category</label>
                    <select class="form-select" id="category_tag" name="category_tag">
                        <option value="">Select Category</option>
                        @foreach(['Breakfast', 'Lunch', 'Dinner', 'All-Day'] as $cat)
                            <option value="{{ $cat }}" {{ $service->category_tag == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="stock_quantity" class="form-label"><i class="fas fa-boxes me-2"></i>Daily Stock
                        Limit</label>
                    <input type="number" class="form-control" id="stock_quantity" name="stock_quantity" min="0"
                        value="{{ $service->stock_quantity }}" placeholder="Leave empty for unlimited">
                </div>

                <!-- Hidden field for backward compatibility -->
                <input type="hidden" name="availability" value="{{ $service->availability }}">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="service_delivery_time">Delivery Time</label>
                        <input type="text" id="service_delivery_time" name="service_delivery_time" class="form-control"
                            value="{{ old('service_delivery_time', $service->service_delivery_time) }}" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="seller_contact_no">Contact Number</label>
                        <input type="text" id="seller_contact_no" name="seller_contact_no" class="form-control"
                            value="{{ old('seller_contact_no', $service->seller_contact_no) }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="service_price">Service Price</label>
                        <div class="input-group">
                            <span class="input-group-text">৳</span>
                            <input type="number" id="service_price" name="service_price" class="form-control"
                                value="{{ old('service_price', $service->service_price) }}" step="0.01" required>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="image">Service Image</label>
                <div class="current-image">
                    <img src="{{ asset('storage/' . $service->image) }}" alt="Current service image">
                    <p>Current image</p>
                </div>
                <input type="file" id="image" name="image" class="form-control">
                <small class="form-text text-muted">Leave empty to keep current image</small>
            </div>

            <div class="button-group">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Update Service
                </button>
                <a href="{{ route('seller.panel') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Cancel
                </a>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // All Day Toggle Logic
            const allDaySwitch = document.getElementById('all_day');
            const startTimeInput = document.getElementById('start_time');
            const endTimeInput = document.getElementById('end_time');

            if(allDaySwitch) {
                allDaySwitch.addEventListener('change', function() {
                    if(this.checked) {
                        startTimeInput.disabled = true;
                        endTimeInput.disabled = true;
                        startTimeInput.value = '';
                        endTimeInput.value = '';
                        startTimeInput.removeAttribute('required');
                        endTimeInput.removeAttribute('required');
                    } else {
                        startTimeInput.disabled = false;
                        endTimeInput.disabled = false;
                        startTimeInput.setAttribute('required', 'required');
                        endTimeInput.setAttribute('required', 'required');
                    }
                });
            }
        });
    </script>
@endsection
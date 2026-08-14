@extends('layouts.app')

@section('title', 'Customer Reviews — NovelPoint')

@push('styles')
<style>
    .reviews-page {
        max-width: 1000px;
        margin: 40px auto;
        padding: 0 20px;
    }
    .reviews-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 20px;
        margin-top: 24px;
        margin-bottom: 30px;
    }
    .review-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 20px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    .review-book-strip {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 12px;
        padding-bottom: 10px;
        border-bottom: 1px solid #f1f5f9;
    }
    .review-book-tag {
        font-weight: 600;
        font-size: 0.9rem;
        color: #1e293b;
    }
    .review-head {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 12px;
    }
    .review-avatar {
        width: 40px;
        height: 40px;
        background: #6366f1;
        color: #fff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
    }
    .review-name {
        font-weight: 600;
        color: #0f172a;
        font-size: 0.95rem;
    }
    .review-stars {
        color: #f59e0b;
        font-size: 0.9rem;
    }
    .review-comment {
        color: #475569;
        font-size: 0.9rem;
        line-height: 1.5;
        margin: 0;
    }
    .review-form-wrap {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 24px;
        margin-top: 40px;
    }
    .star-picker {
        display: flex;
        gap: 6px;
        cursor: pointer;
        font-size: 1.5rem;
        color: #cbd5e1;
    }
    .star-picker .star.filled {
        color: #f59e0b;
    }
    .form-row {
        margin-bottom: 16px;
    }
    .form-row label {
        display: block;
        margin-bottom: 6px;
        font-weight: 600;
        font-size: 0.9rem;
    }
    .form-row select, .form-row textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #cbd5e1;
        border-radius: 6px;
        font-family: inherit;
    }
    .review-submit-btn {
        background: #1e293b;
        color: #ffffff;
        padding: 10px 24px;
        border: none;
        border-radius: 6px;
        font-weight: 600;
        cursor: pointer;
    }
    .alert-success {
        background-color: #dcfce7;
        border: 1px solid #86efac;
        color: #166534;
        padding: 12px 16px;
        border-radius: 8px;
        margin-bottom: 20px;
    }
    .alert-error {
        background-color: #fef2f2;
        border: 1px solid #fca5a5;
        color: #991b1b;
        padding: 12px 16px;
        border-radius: 8px;
        margin-bottom: 20px;
    }
</style>
@endpush

@section('content')
<div class="reviews-page">

    <div style="text-align: center; margin-bottom: 30px;">
        <h2 class="section-title">Customer Reviews &amp; Testimonials</h2>
        <p class="section-subtitle" style="color: #64748b;">Real words from real bibliophiles.</p>
    </div>

    {{-- Success Message --}}
    @if (session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Validation Errors --}}
    @if ($errors->any())
        <div class="alert-error">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Reviews Grid --}}
    <div class="reviews-grid">
        @forelse ($reviews as $r)
            @php
                $initial = strtoupper(substr(trim($r->customers_name), 0, 1) ?: '?');
                $stars = str_repeat('★', max(0, min(5, (int) $r->rating))) . str_repeat('☆', 5 - max(0, min(5, (int) $r->rating)));
            @endphp
            <div class="review-card">
                <div>
                    <div class="review-book-strip">
                        <i class="fa fa-book" style="color: #6366f1;"></i>
                        <span class="review-book-tag">{{ $r->product->productname ?? $r->product->name ?? 'Book' }}</span>
                    </div>
                    <div class="review-head">
                        <div class="review-avatar">{{ $initial }}</div>
                        <div>
                            <div class="review-name">{{ $r->customers_name }}</div>
                            <div class="review-stars">{{ $stars }}</div>
                        </div>
                    </div>
                    <p class="review-comment">{{ $r->comment }}</p>
                </div>
            </div>
        @empty
            <div style="grid-column: 1 / -1; text-align: center; color: #64748b; padding: 40px 0;">
                No reviews found. Be the first to leave a review below!
            </div>
        @endforelse
    </div>

    {{-- Pagination Links --}}
    <div style="margin-bottom: 40px;">
        {{ $reviews->links() }}
    </div>

    {{-- Submit Review Form --}}
    <div class="review-form-wrap">
        <h3>Write a Review</h3>
        <p style="color:#718096; margin-bottom:16px; font-size:0.9rem;">
            Share your reading experience with NovelPoint!
        </p>

        <form method="POST" action="{{ route('reviews.store') }}">
            @csrf

            {{-- Select Product to Review --}}
            <div class="form-row">
                <label for="product_id">Select Book</label>
                <select name="product_id" id="product_id" required>
                    <option value="">-- Choose a Book --</option>
                    @foreach (\App\Models\Product::all() as $product)
                        <option value="{{ $product->id }}" {{ old('product_id', request('product_id')) == $product->id ? 'selected' : '' }}>
                            {{ $product->productname ?? $product->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Interactive Star Rating --}}
            <div class="form-row">
                <label>Your Rating</label>
                <div class="star-picker" id="starPicker">
                    <span class="star" data-value="1">★</span>
                    <span class="star" data-value="2">★</span>
                    <span class="star" data-value="3">★</span>
                    <span class="star" data-value="4">★</span>
                    <span class="star" data-value="5">★</span>
                </div>
                <input type="hidden" id="ratingInput" name="rating" value="{{ old('rating', 0) }}">
            </div>

            {{-- Review Comment --}}
            <div class="form-row">
                <label for="reviewComment">Your Review</label>
                <textarea id="reviewComment" name="comment" rows="4" placeholder="Share your reading experience..." required>{{ old('comment') }}</textarea>
            </div>

            <button type="submit" class="review-submit-btn">Submit Review</button>
        </form>
    </div>

</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const starPicker = document.getElementById('starPicker');
    const stars = starPicker.querySelectorAll('.star');
    const ratingInput = document.getElementById('ratingInput');
    let selectedRating = parseInt(ratingInput.value, 10) || 0;

    function paintStars(value) {
        stars.forEach(s => s.classList.toggle('filled', parseInt(s.dataset.value, 10) <= value));
    }

    // Initial paint in case of old validation inputs
    if (selectedRating > 0) paintStars(selectedRating);

    stars.forEach(star => {
        star.addEventListener('mouseenter', () => paintStars(parseInt(star.dataset.value, 10)));
        star.addEventListener('click', () => {
            selectedRating = parseInt(star.dataset.value, 10);
            ratingInput.value = selectedRating;
            paintStars(selectedRating);
        });
    });

    starPicker.addEventListener('mouseleave', () => paintStars(selectedRating));
});
</script>
@endpush


<?php $__env->startSection('title', 'NovelPoint — A Haven for Every Bibliophile'); ?>

<?php $__env->startSection('content'); ?>

<!-- Hero Section -->
<section class="hero" id="hero">
    <img class="hero-float f1" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTqGnzsLx0luaF6yYNZQRpSzPapvCllRMKwazVEJmbiZg&s=10" alt="Book cover">
    <img class="hero-float f2" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRsdOxBiUCVBI9c7AWBDm5ye_6ckaz3LTUC9ALtORtkYg&s=10" alt="Book cover">
    <img class="hero-float f3" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSsGDJrl3mQl8qtWCRoCfrpW8rs568A7zs9hx_Rozipiw&s=10" alt="Book cover">
    <img class="hero-float f4" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT5s_969n9M8S33xV6n9gzPWZzaZJNXHWaKmS7JE0v-Ow&s=10" alt="Book cover">

    <div class="hero-inner">
        <div class="brand-tagline">NovelPoint · Est. for readers</div>
        <h1>A Haven for Every Bibliophile</h1>
        <p class="tagline">Curated books, instant digital access, and a community built by readers, for readers.</p>
    </div>

    <div class="scroll-indicator" id="scrollIndicator">
        <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="6 9 12 15 18 9"></polyline>
        </svg>
    </div>
</section>

<!-- Slider Section -->
<section class="slider-section" id="slider-section">
    <div class="slider" id="slider">
        <div class="slider-track-wrap">
            <div class="slider-track" id="sliderTrack">

                <div class="slide">
                    <svg class="slide-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <span class="slide-badge">Curated Literary Treasure</span>
                    <h3>Curated Collections, World-Renowned Authors</h3>
                    <p class="slide-lead">Step into a world crafted for true bibliophiles. From timeless literary masterpieces to the freshest indie debuts, every title on our virtual shelves is meticulously hand-picked by seasoned literature enthusiasts.</p>
                    <p class="slide-perk"><i class="fa fa-check-circle"></i> Up to <strong>30% OFF</strong> featured staff picks this week only!</p>
                    <a href="#products" class="slide-btn">Explore The Collection</a>
                </div>

                <div class="slide">
                    <svg class="slide-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <rect x="5" y="3" width="14" height="18" rx="2" stroke-linecap="round" stroke-linejoin="round" />
                        <line x1="10" y1="19" x2="14" y2="19" stroke-linecap="round" />
                    </svg>
                    <span class="slide-badge">Seamless Reading Experience</span>
                    <h3>Instant Digital Access, Eco-Friendly Sync</h3>
                    <p class="slide-lead">Never lose your page again. Purchase any physical hardback or paperback and instantly unlock its high-definition E-Book counterpart—ready to stream directly to your tablet, phone, or e-reader.</p>
                    <p class="slide-perk"><i class="fa fa-check-circle"></i> Zero waiting time—start reading the exact moment you order!</p>
                    <a href="#products" class="slide-btn">Claim Digital Pass</a>
                </div>

                <div class="slide">
                    <svg class="slide-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <circle cx="9" cy="8" r="3" stroke-linecap="round" stroke-linejoin="round" />
                        <circle cx="17" cy="9" r="2.4" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M3 20c0-3 2.7-5 6-5s6 2 6 5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M14.5 20c.3-2.2 1.9-3.8 4-3.8" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <span class="slide-badge">Exclusive Bibliophile Circle</span>
                    <h3>A Vibrant Community Built for Readers</h3>
                    <p class="slide-lead">Connect with thousands of avid readers around the globe. Join live author Q&A sessions, participate in monthly book club debates, and unlock exclusive VIP discounts unavailable anywhere else.</p>
                    <p class="slide-perk"><i class="fa fa-check-circle"></i> Complimentary <strong>6-Month VIP Pass</strong> included with every order!</p>
                    <a href="#benefits" class="slide-btn">Learn More</a>
                </div>

            </div>
        </div>
    </div>
</section>

<!-- Products / Filter Section -->
<section id="products">
    <h2 class="section-title">Explore the Shelves</h2>
    <p class="section-subtitle">Search by title, then narrow it down by category, author, publisher or language.</p>

    <form method="GET" action="<?php echo e(route('home')); ?>#products" class="search-form" id="shopForm">

        <div class="search-bar-row">
            <input type="text" name="search" placeholder="Search books..." value="<?php echo e($search); ?>">
            <button type="submit" class="search-submit-btn"><i class="fa fa-search"></i> Search</button>

            <button type="button" class="filter-toggle-btn" id="filterToggleBtn">
                <i class="fa fa-sliders"></i> Filters
                <?php if($activeFilterCount > 0): ?>
                <span class="filter-count-badge"><?php echo e($activeFilterCount); ?></span>
                <?php endif; ?>
            </button>
        </div>

        <div class="shop-layout <?php echo e($hasActiveFilters ? 'has-sidebar' : ''); ?>" id="shopLayout">

            <div class="filters-backdrop" id="filtersBackdrop"></div>

            <!-- Filter Sidebar -->
            <aside class="filters-sidebar <?php echo e($hasActiveFilters ? 'active' : ''); ?>" id="filtersSidebar">
                <div class="filters-head">
                    <h3><i class="fa fa-sliders"></i> Filters</h3>
                    <button type="button" class="filters-close" id="filtersClose" aria-label="Close filters">&times;</button>
                </div>
                <div class="filters-actions">
                    <a href="<?php echo e(route('home')); ?>#products" class="btn-clear-filters">Clear All</a>
                </div>

                <!-- Categories -->
                <?php if($categories->isNotEmpty()): ?>
                <details class="filter-group" open>
                    <summary>Category</summary>
                    <div class="filter-options">
                        <label class="filter-option filter-select-all">
                            <input type="checkbox" class="select-all-checkbox">
                            <span><strong>Select All</strong></span>
                        </label>
                        <div class="filter-options-list">
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <label class="filter-option">
                                <input type="checkbox" name="category[]" value="<?php echo e($cat->CategoryID); ?>"
                                    <?php if(in_array($cat->CategoryID, $selectedCategories)): echo 'checked'; endif; ?>>
                                <span><?php echo e($cat->CategoryName); ?></span>
                            </label>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <?php if($categories->count() > 5): ?>
                        <button type="button" class="btn-toggle-see-more">+ See More</button>
                        <?php endif; ?>
                    </div>
                </details>
                <?php endif; ?>

                <!-- Authors -->
                <?php if($authors->isNotEmpty()): ?>
                <details class="filter-group" open>
                    <summary>Author</summary>
                    <div class="filter-options">
                        <label class="filter-option filter-select-all">
                            <input type="checkbox" class="select-all-checkbox">
                            <span><strong>Select All</strong></span>
                        </label>
                        <div class="filter-options-list">
                            <?php $__currentLoopData = $authors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $author): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <label class="filter-option">
                                <input type="checkbox" name="author[]" value="<?php echo e($author); ?>"
                                    <?php if(in_array($author, $selectedAuthors)): echo 'checked'; endif; ?>>
                                <span><?php echo e($author); ?></span>
                            </label>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <?php if($authors->count() > 5): ?>
                        <button type="button" class="btn-toggle-see-more">+ See More</button>
                        <?php endif; ?>
                    </div>
                </details>
                <?php endif; ?>

                <!-- Publishers -->
                <?php if($publishers->isNotEmpty()): ?>
                <details class="filter-group" open>
                    <summary>Publisher</summary>
                    <div class="filter-options">
                        <label class="filter-option filter-select-all">
                            <input type="checkbox" class="select-all-checkbox">
                            <span><strong>Select All</strong></span>
                        </label>
                        <div class="filter-options-list">
                            <?php $__currentLoopData = $publishers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $publisher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <label class="filter-option">
                                <input type="checkbox" name="publisher[]" value="<?php echo e($publisher); ?>"
                                    <?php if(in_array($publisher, $selectedPublishers)): echo 'checked'; endif; ?>>
                                <span><?php echo e($publisher); ?></span>
                            </label>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <?php if($publishers->count() > 5): ?>
                        <button type="button" class="btn-toggle-see-more">+ See More</button>
                        <?php endif; ?>
                    </div>
                </details>
                <?php endif; ?>

                <!-- Languages -->
                <?php if($languages->isNotEmpty()): ?>
                <details class="filter-group" open>
                    <summary>Language</summary>
                    <div class="filter-options">
                        <label class="filter-option filter-select-all">
                            <input type="checkbox" class="select-all-checkbox">
                            <span><strong>Select All</strong></span>
                        </label>
                        <div class="filter-options-list">
                            <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <label class="filter-option">
                                <input type="checkbox" name="language[]" value="<?php echo e($language); ?>"
                                    <?php if(in_array($language, $selectedLanguages)): echo 'checked'; endif; ?>>
                                <span><?php echo e($language); ?></span>
                            </label>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <?php if($languages->count() > 5): ?>
                        <button type="button" class="btn-toggle-see-more">+ See More</button>
                        <?php endif; ?>
                    </div>
                </details>
                <?php endif; ?>
            </aside>

            <!-- Results Panel -->
            <div class="results-panel">
                <?php if($products->isEmpty()): ?>
                <div class="empty-state">
                    <?php echo e($hasActiveFilters ? 'No products match your filters.' : 'No products available yet — check back soon.'); ?>

                </div>
                <?php else: ?>
                <div class="product-grid">
                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                    $firstImg = $p->images->first()?->image_path;
                    $thumb = !empty($firstImg) ? asset($firstImg) : 'https://via.placeholder.com/300x400?text=No+Cover';
                    ?>

                    <!-- Make the card clickable -->
                    <a href="<?php echo e(route('product.show', $p->id)); ?>" class="product-card-link" style="text-decoration:none; color:inherit;">
                        <div class="product-card" data-category="<?php echo e($p->category_id); ?>">
                            <div class="product-thumb-wrap">
                                <img src="<?php echo e($thumb); ?>" alt="<?php echo e($p->name); ?>"
                                    onerror="this.onerror=null;this.src='https://via.placeholder.com/300x400?text=No+Cover';">
                                <span class="product-badge"><?php echo e($p->category->name ?? 'General'); ?></span>
                            </div>
                            <div class="product-info">
                                <h4><?php echo e($p->name); ?></h4>
                                <div class="product-price">$<?php echo e(number_format($p->price, 2)); ?></div>
                                <div class="product-actions">
                                    <span class="quick-add-cart">View Details</span>
                                </div>
                            </div>
                        </div>
                    </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <!-- Laravel Built-in Pagination Links -->
                <?php if($hasActiveFilters && method_exists($products, 'hasPages') && $products->hasPages()): ?>
                <div class="d-flex justify-content-center mt-4">
                    <?php echo e($products->links()); ?>

                </div>
                <?php endif; ?>
                <?php endif; ?>
            </div>

        </div>
    </form>
</section>

<!-- Benefits Section -->
<section id="benefits" class="why-section">
    <div class="why-left">
        <h2>Why Choose NovelPoint?</h2>
        <p class="why-text">
            More than just an online bookstore. NovelPoint is built for passionate readers who want a seamless, enjoyable and trusted reading experience.
        </p>
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQlVDQpQFAOtat5qyDcoAcvKKpX3imvCdyXTtdeE6nEbA&s=10" alt="Readers enjoying books" class="why-image">
    </div>

    <div class="why-right">
        <div class="why-card">
            <div class="why-icon"><i class="fa fa-book"></i></div>
            <div>
                <h3>Curated Collection</h3>
                <p>Carefully selected books from bestselling authors, timeless classics and hidden gems.</p>
            </div>
        </div>
        <div class="why-card">
            <div class="why-icon"><i class="fa fa-download"></i></div>
            <div>
                <h3>Instant Digital Access</h3>
                <p>Receive your digital edition immediately after purchase and continue reading anywhere.</p>
            </div>
        </div>
        <div class="why-card">
            <div class="why-icon"><i class="fa fa-shield"></i></div>
            <div>
                <h3>Trusted Quality</h3>
                <p>Premium quality books, secure checkout, and reliable delivery on every order.</p>
            </div>
        </div>
        <div class="why-card">
            <div class="why-icon"><i class="fa fa-users"></i></div>
            <div>
                <h3>Reader Community</h3>
                <p>Join book clubs, author events, reading discussions and exclusive member rewards.</p>
            </div>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Process each filter section options
        document.querySelectorAll('.filter-options').forEach(group => {
            const optionsList = group.querySelector('.filter-options-list');
            if (!optionsList) return;

            const options = Array.from(optionsList.querySelectorAll('.filter-option'));
            const toggleBtn = group.querySelector('.btn-toggle-see-more');

            const hasCheckedHiddenOptions = options.slice(5).some(option => {
                const checkbox = option.querySelector('input[type="checkbox"]');
                return checkbox && checkbox.checked;
            });

            let isExpanded = hasCheckedHiddenOptions;

            function updateOptionsVisibility() {
                options.forEach((option, index) => {
                    if (index >= 5) {
                        option.classList.toggle('is-hidden', !isExpanded);
                    }
                });

                if (toggleBtn) {
                    toggleBtn.textContent = isExpanded ? '- See Less' : '+ See More';
                }
            }

            if (options.length > 5 && toggleBtn) {
                updateOptionsVisibility();
                toggleBtn.addEventListener('click', (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    isExpanded = !isExpanded;
                    updateOptionsVisibility();
                });
            }
        });
    });

    const hamburgerBtn = document.getElementById('hamburgerBtn');
    const mobileDrawer = document.getElementById('mobileDrawer');
    const mobileDrawerClose = document.getElementById('mobileDrawerClose');

    hamburgerBtn?.addEventListener('click', () => mobileDrawer.classList.add('open'));
    mobileDrawerClose?.addEventListener('click', () => mobileDrawer.classList.remove('open'));

    document.getElementById('scrollIndicator')?.addEventListener('click', () => {
        document.getElementById('slider-section').scrollIntoView({
            behavior: 'smooth'
        });
    });

    // Slider logic
    const sliderTrack = document.getElementById('sliderTrack');
    const slides = sliderTrack ? sliderTrack.querySelectorAll('.slide') : [];
    let currentIndex = 0;

    function renderSlider() {
        if (sliderTrack) {
            sliderTrack.style.transform = `translateX(-${currentIndex * 33.333333}%)`;
        }
    }

    function nextSlide() {
        if (slides.length > 0) {
            currentIndex = (currentIndex + 1) % slides.length;
            renderSlider();
        }
    }
    setInterval(nextSlide, 5000);

    // Filter Sidebar Logic
    const shopLayout = document.getElementById('shopLayout');
    const filtersSidebar = document.getElementById('filtersSidebar');
    const filterToggleBtn = document.getElementById('filterToggleBtn');
    const filtersClose = document.getElementById('filtersClose');
    const filtersBackdrop = document.getElementById('filtersBackdrop');

    function openFilters() {
        shopLayout?.classList.add('has-sidebar');
        filtersSidebar?.classList.add('active', 'mobile-open');
        filtersBackdrop?.classList.add('active');
    }

    function closeFilters() {
        filtersSidebar?.classList.remove('mobile-open');
        filtersBackdrop?.classList.remove('active');
        if (filtersSidebar && !filtersSidebar.querySelector('input[type="checkbox"]:checked')) {
            shopLayout?.classList.remove('has-sidebar');
            filtersSidebar.classList.remove('active');
        }
    }

    filterToggleBtn?.addEventListener('click', () => {
        if (filtersSidebar?.classList.contains('mobile-open') || (shopLayout?.classList.contains('has-sidebar') && window.innerWidth > 900)) {
            closeFilters();
        } else {
            openFilters();
        }
    });

    filtersClose?.addEventListener('click', closeFilters);
    filtersBackdrop?.addEventListener('click', closeFilters);

    // Auto-submit form when filter checkboxes are toggled
    filtersSidebar?.querySelectorAll('input[type="checkbox"]:not(.select-all-checkbox)').forEach(box => {
        box.addEventListener('change', () => {
            document.getElementById('shopForm').submit();
        });
    });

    // Select All functionality
    filtersSidebar?.querySelectorAll('.select-all-checkbox').forEach(selectAllBox => {
        const group = selectAllBox.closest('.filter-options');
        const groupBoxes = () => Array.from(group.querySelectorAll('input[type="checkbox"]:not(.select-all-checkbox)'));

        const initBoxes = groupBoxes();
        const initChecked = initBoxes.filter(b => b.checked).length;
        selectAllBox.checked = initBoxes.length > 0 && initChecked === initBoxes.length;
        selectAllBox.indeterminate = initChecked > 0 && initChecked < initBoxes.length;

        selectAllBox.addEventListener('change', () => {
            groupBoxes().forEach(b => {
                b.checked = selectAllBox.checked;
            });
            selectAllBox.indeterminate = false;
            document.getElementById('shopForm').submit();
        });

        groupBoxes().forEach(box => {
            box.addEventListener('change', () => {
                const boxes = groupBoxes();
                const checkedCount = boxes.filter(b => b.checked).length;
                selectAllBox.checked = checkedCount === boxes.length;
                selectAllBox.indeterminate = checkedCount > 0 && checkedCount < boxes.length;
            });
        });
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Bookstore\resources\views/home.blade.php ENDPATH**/ ?>
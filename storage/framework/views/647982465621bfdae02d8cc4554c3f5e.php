<?php if (isset($component)) { $__componentOriginal23a33f287873b564aaf305a1526eada4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal23a33f287873b564aaf305a1526eada4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layout','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <main class="pb-16 px-6">
        <div class="max-w-4xl mx-auto text-center mt-12">
            <div class="inline-block border border-white/10 bg-white/5 rounded-full px-4 py-1.5 mb-6 backdrop-blur-sm">
                <span class="text-xs font-semibold text-cyan-400 uppercase tracking-widest flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    AI-Powered Reviews
                </span>
            </div>
            
            <h1 class="text-5xl md:text-7xl font-extrabold tracking-tight mb-6 leading-tight">
                Don't just watch. <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-gray-400 to-gray-100">Experience it.</span>
            </h1>
            
            <p class="text-lg md:text-xl text-gray-400 mb-10 max-w-2xl mx-auto">
                Read what the world thinks about your next favorite movie, book, or song. AI-summarized insights, zero spoilers.
            </p>

            <form action="<?php echo e(route('movie.search')); ?>" method="GET" class="relative max-w-2xl mx-auto group">
                <div class="absolute -inset-1 bg-gradient-to-r from-purple-500 to-cyan-500 rounded-full blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200"></div>
                <input type="text" name="query" placeholder="Search for a movie, book, or artist..." required class="relative w-full bg-[#18181b] text-white px-8 py-5 rounded-full text-lg border border-white/10 focus:outline-none focus:border-cyan-500 transition-colors shadow-2xl placeholder-gray-500">
                <button type="submit" class="absolute right-3 top-3 bg-white text-black p-2.5 rounded-full hover:scale-110 transition-transform">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </button>
            </form>
        </div>
    </main>

    <section class="max-w-7xl mx-auto px-6 py-12">
        <h2 class="text-2xl font-bold mb-8 flex items-center gap-2">
            Trending This Week <span class="text-xl">🔥</span>
        </h2>
        
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-6">
            
            <?php $__currentLoopData = $trendingMovies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $movie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="/movie/<?php echo e($movie['id']); ?>" class="group cursor-pointer block">
                <div class="relative overflow-hidden rounded-2xl aspect-[2/3] bg-gray-800">
                    <img src="https://image.tmdb.org/t/p/w500<?php echo e($movie['poster_path']); ?>" alt="<?php echo e($movie['title'] ?? $movie['name']); ?>" class="object-cover w-full h-full group-hover:scale-110 transition-transform duration-500 opacity-80 group-hover:opacity-100">
                    
                    <div class="absolute bottom-0 w-full bg-gradient-to-t from-black via-black/80 to-transparent p-4">
                        <div class="flex items-center gap-1 text-yellow-400 text-sm font-bold mb-1">
                            ★ <?php echo e(number_format($movie['vote_average'], 1)); ?>

                        </div>
                    </div>
                </div>
                
                <h3 class="mt-3 font-semibold text-lg truncate"><?php echo e($movie['title'] ?? $movie['name']); ?></h3>
                
                <p class="text-sm text-gray-500">
                    <?php echo e(isset($movie['release_date']) ? \Carbon\Carbon::parse($movie['release_date'])->format('Y') : (isset($movie['first_air_date']) ? \Carbon\Carbon::parse($movie['first_air_date'])->format('Y') : 'N/A')); ?> • Movie
                </p>
            </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>
    </section>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal23a33f287873b564aaf305a1526eada4)): ?>
<?php $attributes = $__attributesOriginal23a33f287873b564aaf305a1526eada4; ?>
<?php unset($__attributesOriginal23a33f287873b564aaf305a1526eada4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal23a33f287873b564aaf305a1526eada4)): ?>
<?php $component = $__componentOriginal23a33f287873b564aaf305a1526eada4; ?>
<?php unset($__componentOriginal23a33f287873b564aaf305a1526eada4); ?>
<?php endif; ?><?php /**PATH C:\Users\DELL\Herd\le8sea\resources\views/welcome.blade.php ENDPATH**/ ?>
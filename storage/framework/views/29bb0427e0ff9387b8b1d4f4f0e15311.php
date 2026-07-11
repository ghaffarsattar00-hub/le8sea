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
    <main class="pt-32 pb-16 px-6 max-w-7xl mx-auto">
        <h1 class="text-3xl font-bold mb-8 flex items-center gap-3">
            Search Results for: <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-cyan-400">"<?php echo e($query); ?>"</span>
        </h1>

        <?php if(count($searchResults) > 0): ?>
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-6">
                <?php $__currentLoopData = $searchResults; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        // Check karna ke yeh Movie hai ya TV Show
                        $isMovie = $result['media_type'] === 'movie';
                        $link = $isMovie ? '/movie/' . $result['id'] : '/tv/' . $result['id'];
                        $title = $isMovie ? ($result['title'] ?? 'Unknown') : ($result['name'] ?? 'Unknown');
                        $date = $isMovie ? ($result['release_date'] ?? null) : ($result['first_air_date'] ?? null);
                    ?>

                    <a href="<?php echo e($link); ?>" class="group cursor-pointer block">
                        <div class="relative overflow-hidden rounded-2xl aspect-[2/3] bg-gray-800 border border-white/5">
                            <?php if(isset($result['poster_path'])): ?>
                                <img src="https://image.tmdb.org/t/p/w500<?php echo e($result['poster_path']); ?>" alt="<?php echo e($title); ?>" class="object-cover w-full h-full group-hover:scale-110 transition-transform duration-500 opacity-80 group-hover:opacity-100">
                            <?php else: ?>
                                <div class="flex items-center justify-center w-full h-full text-gray-500">No Image</div>
                            <?php endif; ?>
                            
                            <div class="absolute top-2 right-2 bg-black/60 backdrop-blur-md text-xs font-bold px-2 py-1 rounded-md border border-white/10 <?php echo e($isMovie ? 'text-purple-400' : 'text-cyan-400'); ?>">
                                <?php echo e($isMovie ? 'Movie' : 'TV Show'); ?>

                            </div>
                        </div>
                        <h3 class="mt-3 font-semibold text-lg truncate"><?php echo e($title); ?></h3>
                        <p class="text-sm text-gray-500">
                            <?php echo e($date ? \Carbon\Carbon::parse($date)->format('Y') : 'N/A'); ?>

                        </p>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php else: ?>
            <div class="bg-[#18181b] p-16 rounded-2xl border border-white/10 text-center shadow-lg">
                <div class="text-5xl mb-4">🎬</div>
                <p class="text-gray-400 text-lg mb-6">No movies or TV shows found matching "<span class="text-white"><?php echo e($query); ?></span>".</p>
                <a href="/" class="inline-block bg-white text-black font-bold py-2.5 px-6 rounded-full hover:scale-105 transition-transform text-sm">Go back home</a>
            </div>
        <?php endif; ?>
    </main>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal23a33f287873b564aaf305a1526eada4)): ?>
<?php $attributes = $__attributesOriginal23a33f287873b564aaf305a1526eada4; ?>
<?php unset($__attributesOriginal23a33f287873b564aaf305a1526eada4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal23a33f287873b564aaf305a1526eada4)): ?>
<?php $component = $__componentOriginal23a33f287873b564aaf305a1526eada4; ?>
<?php unset($__componentOriginal23a33f287873b564aaf305a1526eada4); ?>
<?php endif; ?><?php /**PATH C:\Users\DELL\Herd\le8sea\resources\views/search.blade.php ENDPATH**/ ?>
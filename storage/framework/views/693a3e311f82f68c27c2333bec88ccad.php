    <head> <title>Dashboard</title></head>
    <?php echo $__env->make('header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
    <div class="bg"></div>
    <div class="bg-overlay"></div>
    <main class="flex flex-col items-center justify-center pt-2 m-0 md:p-4">
        <?php if(Session::has('success')): ?>
        <div class="alert alert-success"><?php echo e(Session::get('success')); ?></div>
        <?php endif; ?>
        <?php if(Session::has('fail')): ?>
            <div class="alert alert-danger"><?php echo e(Session::get('fail')); ?></div>
        <?php endif; ?>
        <?php if(Session::has('error')): ?>
            <div class="alert alert-danger"><?php echo e(Session::get('fail')); ?></div>
        <?php endif; ?>
        <div class="main-container">
            <form action="<?php echo e(route('postcreateApi')); ?>" method="POST" class="dual-button-form">
                <?php echo csrf_field(); ?>
                <div class="md:flex-1">
                    <input type="text" name="title" placeholder="Enter the post title" required class="dual-white-form placeholder-gray-600">
                </div>
                <div class="md:flex-1">
                    <input type="number" step="0.01" name="price" placeholder="Price" required class="dual-white-form placeholder-gray-600 ">
                </div>
                <div class="md:flex-1">
                    <input type="text" name="description" placeholder="Enter the description" required class="dual-white-form placeholder-gray-600">
                </div>
                <div class="md:flex-shrink-0">
                    <button type="submit" class="dual-black-form">Submit</button>
                </div>
            </form>
            <?php
                $sortedPosts = collect($posts['data'])->sortByDesc(function ($post) {
                    return $post['attributes']['created_at']; });
                $user = session('user');
            ?>
            <?php $__currentLoopData = $sortedPosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php  $post = $p['attributes']; $puserid = $p['relationships']['id']; ?>
                <div class="product-container">
                    <div class="flex flex-row md:justify-between justify-between items-start">

                        <div class="flex flex-col items-start">
                            <h2 class="text-base md:text-xl font-hkgrotesk-medium"> <?php echo e($post['title']); ?></h2>
                            <span class="text-sm md:text-base font-hkgrotesk-italic text">$<?php echo e($post['price']); ?></span>
                        </div>

                        <div class="flex flex-col items-end">
                            <div class="text-left  text-base md:text-xl font-absans md:text-left"><?php echo e($post['user_first']); ?> <?php echo e($post['user_last']); ?></div>
                            <div class="flex justify-end space-x-2 mt-2 md:mt-0">
                                <button onclick="location.href='<?php echo e(route('postIndex', ['id' => $p['id']])); ?>'" class="btn-svg">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.0" class="svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 
                                            0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        </svg>
                                    </button>                                    
                                    <?php if($user["id"] == $puserid): ?>
                                    <button onclick="location.href='<?php echo e(route('postIndex', ['id' => $p['id']])); ?>'" class="btn-svg">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" class="svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 
                                                1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                            </svg>
                                        </button>
                                        <form action="<?php echo e(route('postdeleteApi', $p['id'])); ?>" method="POST" class="p-0 m-0 flex items-center" onsubmit="return confirm('Are you sure you want to delete this post?');">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn-svg">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" class="svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                </svg>
                                            </button>
                                        </form>
                                    <?php endif; ?>
                            </div>
                        </div>      
                    </div>
                    <div class="flex justify-start">
                        <p class="mt-2 text-sm md:text-base font-hkgrotesk-regular"><?php echo e($post['description']); ?></p>
                    </div>
                    <hr class="border-t-1 border-gray-700 mt-4">
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        
        </div>
    </main><?php /**PATH /var/www/resources/views/dashboard.blade.php ENDPATH**/ ?>
<head> <title>Post View</title></head>
    <?php echo $__env->make('header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="bg"></div>
    <div class="bg-overlay"></div>
    <main class="p-4">
        <div class="main-container">
            <?php 
                $p = $post['data']['attributes'];
                $puserid = $post['data']['relationships']['id']; 
                $user = session('user');
            ?>
            <div class="flex flex-col-reverse items-start space-y-2 md:space-x-2 md:flex-row md:justify-between md:items-center">
                <span class="text-sm md:text-base font-hkgrotesk-italic text">$<?php echo e($p['price']); ?></span>
                <h2 class="text-base md:text-xl font-hkgrotesk-medium"><?php echo e($p['title']); ?></h2>
                <div class="text-left  text-base md:text-xl font-absans md:text-left"><?php echo e($p['user_first']); ?> <?php echo e($p['user_last']); ?></div>
            </div>  
            <p class="mt-2 text-sm md:text-base font-hkgrotesk-regular"><?php echo e($p['description']); ?></p>
            <?php if($user["id"] == $puserid): ?>
                <div class="flex flex-row items-center justify-end space-x-2">
                    <button id="edit-btn" class="btn-svg">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" class="svg">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 
                            1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                        </svg>
                    </button>
                    <form action="<?php echo e(route('postdeleteApi', $post['data']['id'])); ?>" method="POST" class="p-0 m-0 flex items-center" onsubmit="return confirm('Are you sure you want to delete this post?');">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn-svg">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" class="svg">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                            </svg>
                        </button>
                    </form>
                </div>
                <form id="edit-form" action="<?php echo e(route('postupdateApi', ['post' => $post['data']['id']])); ?>" method="POST" class="mt-4 space-y-4 p-4 rounded" style="display: none;">
                    <?php echo method_field('POST'); ?>  <?php echo csrf_field(); ?>
                    <div class="flex flex-col space-y-4">
                        <input type="text" name="title" value="<?php echo e($post['data']['attributes']['title']); ?>" placeholder="Enter the post title" required class="input-field">
                        <input type="number" step="0.01" name="price" value="<?php echo e($post['data']['attributes']['price']); ?>" placeholder="Price" required class="input-field">
                        <textarea name="description" placeholder="Enter the description" required class="input-field"><?php echo e($post['data']['attributes']['description']); ?></textarea>
                        <button type="submit" class="form-button">Update</button>
                    </div>
                </form>
            <?php endif; ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('edit-btn').addEventListener('click', function() {
                    var editForm = document.getElementById('edit-form');
                    if (editForm.style.display === 'none') {
                        editForm.style.display = 'block';
                    } else {
                        editForm.style.display = 'none';
                    }
                });
            });
        </script>
                 
        </div>
    </main>
    
</body>
</html><?php /**PATH /var/www/resources/views/post/view.blade.php ENDPATH**/ ?>
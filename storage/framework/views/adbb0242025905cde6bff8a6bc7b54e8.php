<head> <title>Login</title></head>
<?php echo $__env->make('header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 

<main class="flex flex-col items-center justify-center min-h-screen p-4">
    <div class="login-form">
        <h1 class="form-heading">Login</h1>
        <?php if(Session::has('success')): ?>
            <div class="alert alert-success"><?php echo e(Session::get('success')); ?></div>
        <?php endif; ?>
        <?php if(Session::has('fail')): ?>
            <div class="alert alert-danger"><?php echo e(Session::get('fail')); ?></div>
        <?php endif; ?>
        <?php if(Session::has('error')): ?>
            <div class="alert alert-danger"><?php echo e(Session::get('fail')); ?></div>
        <?php endif; ?>
        <form action="<?php echo e(route('login')); ?>" method="post" class="space-y-4">
            <?php echo csrf_field(); ?>
            <div>
                <input type="email" placeholder="Email" name="email" value="<?php echo e(old('email')); ?>" autocomplete="off" required class="input-field">
                <span class="error-text"><?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><?php echo e($message); ?> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></span>
            </div>
            <div>
                <input type="password" placeholder="Password" name="password" autocomplete="off" required class="input-field">
                <span class="error-text"><?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><?php echo e($message); ?> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></span>
            </div>
            <p class="form-text">New here? <a href="<?php echo e(route('register')); ?>" class="form-link">Sign up now</a></p>
            <button type="submit" class="form-button">Login</button>
        </form>
    </div>
</main>
</body>
</html>
<?php /**PATH C:\Users\macbl\Desktop\project\klefrontend\resources\views/login.blade.php ENDPATH**/ ?>
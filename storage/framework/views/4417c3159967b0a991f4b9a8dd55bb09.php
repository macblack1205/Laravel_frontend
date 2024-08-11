<head> <title>Register</title></head>
<?php echo $__env->make('header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="register-container">
    <div class="register-form">
        <h1 class="form-heading">Sign up</h1>
        <?php if(Session::has('success')): ?>
            <div class="alert alert-success"><?php echo e(Session::get('success')); ?></div>
        <?php endif; ?>
        <?php if(Session::has('fail')): ?>
            <div class="alert alert-danger"><?php echo e(Session::get('fail')); ?></div>
        <?php endif; ?>
        <form action="<?php echo e(route('register')); ?>" method="post" class="space-y-4">
            <?php echo csrf_field(); ?>
            <div class="passfield">
                <input type="text" placeholder="Name" name="first" value="<?php echo e(old('first')); ?>" autocomplete="off" required class="input-field font-absans">
                <span class="error-text"><?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><?php echo e($message); ?> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> </span>
                <input type="text" placeholder="Last Name" name="last" value="<?php echo e(old('last')); ?>" autocomplete="off" required class="input-field font-absans">
                <span class="error-text"><?php $__errorArgs = ['last'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><?php echo e($message); ?> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> </span>
            </div>
            <input type="email" placeholder="Email" name="email" value="<?php echo e(old('email')); ?>" autocomplete="off" required class="input-field">
            <span class="error-text"><?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><?php echo e($message); ?> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> </span>
            <div class="passfield">
                <input type="password" placeholder="Password" name="password" autocomplete="off" required class="input-field">
                <input type="password" placeholder="Password repeat" name="password_confirmation" autocomplete="off" required class="input-field">
            </div>
            <span class="error-text"><?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><?php echo e($message); ?> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> </span> 
            <span class="error-text"><?php $__errorArgs = ['password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><?php echo e($message); ?> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> </span>             
            <p class="form-text">Already a member? <a href="<?php echo e(route('login')); ?>" class="form-link">Login here</a></p>
            <button type="submit" class="form-button">Sign up</button>
        </form>
    </div>
</div>
</body>
</html>
<?php /**PATH C:\Users\macbl\Desktop\project\klefrontend\resources\views/register.blade.php ENDPATH**/ ?>
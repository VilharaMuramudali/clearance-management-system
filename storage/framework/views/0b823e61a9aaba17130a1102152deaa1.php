<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="<?php echo e(asset('welcomelogin.css')); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100..900&display=swap" rel="stylesheet">
</head>
<body>
    <?php echo $__env->make('components.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="center-container">
    <div class="form-wrapper">
        <h2 class="form-title">Log in to your account</h2>
        <h3 class="form-sub-title">Welcome to CMS</h3>

        <form method="POST" action="<?php echo e(route('login')); ?>">
            <?php echo csrf_field(); ?>
            <div class="form-group">
                <!-- Email Address -->
                <input id="email" type="email" name="email" required autofocus placeholder="Email Address">
            </div>

            <div class="form-group">
                <!-- Password -->
                <input id="password" type="password" name="password" required placeholder="Password">
            </div>

            <div class="remember-me">
                <!-- Remember Me -->
                

                <?php if(Route::has('password.request')): ?>
                    <a href="<?php echo e(route('password.request')); ?>" class="forgot-password">Forgot your password?</a>
                <?php endif; ?>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="submit-btn">Login</button>
        </form>

        
    </div>
    <img src="/images/lg_art.png" alt="Descriptive Alt Text" class="side-image">

    </div>
</body>
</html>
<?php /**PATH C:\laragon\www\student-clearance-system\resources\views/welcome.blade.php ENDPATH**/ ?>
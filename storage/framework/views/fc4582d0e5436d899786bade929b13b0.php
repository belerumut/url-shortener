<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>URL Shortener</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container text-center" style="margin-top: 50px;">
        <h1>URL Shortener</h1>
        <form action="/shorten" method="POST">
            <?php echo csrf_field(); ?>
            <div class="form-group">
                <input type="url" name="url" class="form-control" placeholder="Enter URL" required>
            </div>
            <button type="submit" class="btn btn-primary">Shorten</button>
        </form>
        <?php if(session('shortened_url')): ?>
            <div class="alert alert-success" style="margin-top: 20px;">
                Shortened URL: <a href="<?php echo e(url(session('shortened_url'))); ?>"><?php echo e(url(session('shortened_url'))); ?></a>
            </div>
        <?php endif; ?>
        <?php if($errors->any()): ?>
            <div class="alert alert-danger" style="margin-top: 20px;">
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
<?php /**PATH C:\xampp\url-shortener\resources\views/welcome.blade.php ENDPATH**/ ?>
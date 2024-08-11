<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?>
</head>
<body class="bg-gray-500  dark:bg-gray-900 dark:text-gray-300">
<?php  $user = session('user'); ?>
    <header class="header">
        <div class="logo"><a href="home" >
            <span class="font-light">Kle</span> 
            <span class="font-bold hidden md:inline">Academy</span>
            </a>
        </div>
        <?php if($user): ?>
        <div id="upper-header" class="flex flex-row justify-between">
            <div class="hidden md:flex dual-button">
                <button onclick="location.href='<?php echo e(route('dashboard')); ?>'" class="dual-black">Main</button>
                <button onclick="location.href='<?php echo e(route('home')); ?>'" class="dual-white">Home</button>
            </div>
            
        </div>
        <?php else: ?>
        <div class="hidden md:flex dual-button">
            <button onclick="location.href='<?php echo e(route('login')); ?>'" class="dual-black">Sign In</button>
            <button  onclick="location.href='<?php echo e(route('register')); ?>'" class="dual-white">Sign Up</button>
        </div>
        <?php endif; ?>
        <button id="menuToggle" class="md:hidden text-white p-1 stroke-width=1.5 bg-transparent hover:bg-transparent border-none focus:outline-none">☰</button>
    
        <div class="hidden md:flex flex-row p-0 m-0 space-x-1 items-center">
            <?php if($user): ?>
                <p class="text-base font-absans font-regular">Welcome, <span class="text-xl cursor-auto font-bold font-absans hover:underline hover:underline-offset-4"><?php echo e($user['first']); ?>  <?php echo e($user['last']); ?>!</span></p>
                <a href="<?php echo e(route('profile')); ?>">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-7 text-gray-300 hover:text-gray-100 ">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 
                    0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                </svg>
                </a>
                <form action="<?php echo e(route('logoutApi')); ?>" method="POST" class="inline-block border-0 p-0 m-0">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="bg-transparent border-0 p-0 m-0 hover:bg-transparent">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-7 text-gray-300 hover:text-gray-100">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15M12 9l3 3m0 0-3 3m3-3H2.25" />
                        </svg>
                    </button>
                </form>
            <?php endif; ?>
            <button id="darkmode" class="p-2 bg-transparent hover:bg-transparent border-none focus:outline-none">
                <!-- Moon icon (Dark mode) -->
                <svg id="darkIcon" xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="focus:outline-none size-6 hover:bg-none">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 
                0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z" />
                </svg>
                <!-- Sun icon (Light mode) -->
                <svg id="lightIcon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 hidden focus:outline-none">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 
                    6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
                </svg>              
        </button>
        </div>
    </header>
    <div id="mobileMenu" class="md:hidden flex flex-col justify-center items-center p-1">
        <?php if($user): ?>
            <div class="flex dual-button">
                <button onclick="location.href='<?php echo e(route('dashboard')); ?>'" class="dual-black">Main</button>
                <button onclick="location.href='<?php echo e(route('home')); ?>'" class="dual-white">Home</button>
            </div>
        <?php else: ?>
            <div class="flex dual-button">
                <button onclick="location.href='<?php echo e(route('login')); ?>'" class="dual-black">Sign In</button>
                <button  onclick="location.href='<?php echo e(route('register')); ?>'" class="dual-white">Sign Up</button>
            </div>
        <?php endif; ?>
        <div class="flex flex-row justify-center items-center mt-2">
            <?php if($user): ?>
            <div class="flex flex-row items-center" >
                <a href="<?php echo e(route('profile')); ?>">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-7 text-gray-300 hover:text-gray-100 ">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 
                    0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                </svg>
                </a>
                <form action="<?php echo e(route('logoutApi')); ?>" method="POST" class="inline-block border-0 p-0 m-0">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="bg-transparent border-0 p-0 m-0 hover:bg-transparent">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-7 text-gray-300 hover:text-gray-100">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15M12 9l3 3m0 0-3 3m3-3H2.25" />
                        </svg>
                    </button>
                </form>
            </div>
            <?php endif; ?>
            <button id="darkmodeMobile" class="md:hidden flex p-0 m-0 items-center bg-transparent hover:bg-transparent border-none focus:outline-none">
                <svg id="darkIcon2" xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="focus:outline-none size-6 m-0 p-0 hover:bg-none">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 
                0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z" />
                </svg>
                <!-- Sun icon (Light mode) -->
                <svg id="lightIcon2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 hidden focus:outline-none">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 
                    6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
                </svg>  
            </button>
        </div>
    </div>
    
    <script>
       document.getElementById('darkmode').addEventListener('click', () => {
            const darkIcon = document.getElementById('darkIcon');
            const lightIcon = document.getElementById('lightIcon');
            const isDarkMode = document.documentElement.classList.toggle('dark');

            // Toggle icon visibility
            darkIcon.classList.toggle('hidden', isDarkMode);
            lightIcon.classList.toggle('hidden', !isDarkMode);
        });
        
       document.getElementById('darkmodeMobile').addEventListener('click', () => {
            const darkIcon = document.getElementById('darkIcon2');
            const lightIcon = document.getElementById('lightIcon2');
            const isDarkMode = document.documentElement.classList.toggle('dark');

            // Toggle icon visibility
            darkIcon.classList.toggle('hidden', isDarkMode);
            lightIcon.classList.toggle('hidden', !isDarkMode);
        });


        document.getElementById('menuToggle').addEventListener('click', () => {
            const menu = document.getElementById('mobileMenu');
            menu.classList.toggle('hidden');
        });

        document.addEventListener("DOMContentLoaded", function() {
            const maxWords = 30;
            const textElement = document.getElementById('text-content');
            const text = textElement.innerText;

            const words = text.split(' ');
            if (words.length > maxWords) {
                const truncatedText = words.slice(0, maxWords).join(' ') + '...    View post to Read More';
                textElement.innerText = truncatedText;
                textElement.classList.add('truncate-text'); 
            }        
        });
    </script>
</body>
</html>

   

    <?php /**PATH C:\Users\macbl\Desktop\project\klefrontend\resources\views/header.blade.php ENDPATH**/ ?>
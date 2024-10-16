<?php

if (!isset($_GET["theme"])) {

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PAIGAM DO REGISTRATION</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            .dotted-line::before {
                content: " ";
                position: absolute;
                left: 100%;
                top: 50%;
                width: 400px;
                z-index: -1;
                border-bottom: 5px dashed rgba(0, 0, 0, 0.15);
            }
        </style>
    </head>

    <body class="w-full bg-white relative">
        <div
            role="alert"
            id="login-alert"
            class="rounded hidden max-w-[400px] border-s-4 z-50 border-red-500 bg-red-50 p-4 absolute right-4 top-4 transition-opacity duration-300 ease-in-out opacity-0">
            <div class="flex items-center gap-2 text-red-800">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                    <path
                        fill-rule="evenodd"
                        d="M9.401 3.003c1.155-2 4.043-2 5.197 0l7.355 12.748c1.154 2-.29 4.5-2.599 4.5H4.645c-2.309 0-3.752-2.5-2.598-4.5L9.4 3.003zM12 8.25a.75.75 0 01.75.75v3.75a.75.75 0 01-1.5 0V9a.75.75 0 01.75-.75zm0 8.25a.75.75 0 100-1.5.75.75 0 000 1.5z"
                        clip-rule="evenodd" />
                </svg>

                <strong class="block font-medium" id="alert-title">Something went wrong</strong>
            </div>

            <p class="mt-2 text-sm text-red-700" id="alert-message">
                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nemo quasi assumenda numquam deserunt
                consectetur autem nihil quos debitis dolor culpa.
            </p>
        </div>


        <div class="container mx-auto flex flex-col justify-center items-center w-full h-screen">

            <div class="login-form flex justify-between text-gray-800 relative">
                <div class="w-[120px] h-[120px] rounded-full absolute z-1 right-[20px] bottom-[10px]"
                    style="background: linear-gradient(135deg, #FF5E5B, #FFD93D);"></div>

                <div class="w-[200px] h-[200px] rounded-full absolute z-1 right-[290px]"
                    style="background: linear-gradient(135deg, #6A0572, #29C7AC);"></div>

                <div class="flex justify-center items-start flex-col w-[550px]">
                    <h2 class="text-6xl tracking-wider font-bold">PAIGAM DO</h2>
                    <div class="dotted-line flex items-center relative">
                        <span class="border-2 select-text py-2 px-4 ml-3 mt-2 font-bold border-gray-400 italic">
                            MESSENGER
                        </span>
                    </div>
                </div>

                <div class="mx-auto min-w-[320px] relative z-30 w-[460px] rounded-xl shadow-lg px-2 py-20 sm:px-6 lg:px-8" style="background: linear-gradient(135deg, #ffffff, #ffffffe5);">
                    <div class="absolute right-10 top-10">
                        <button onclick="location.href = `./register.php?theme=dark`"
                            class="p-3 transition duration-500 ease-in group relative overflow-hidden rounded-full  hover:bg-gray-700 bg-slate-100  transition-colors duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-6 w-6  transition duration-300 ease-in group-hover:translate-x-[150%] group-hover:translate-y-[50%] fill-yellow-500 "
                                viewBox="0 0 24 24">
                                <g data-name="Layer 2">
                                    <g data-name="sun">
                                        <rect width="24" height="24" transform="rotate(180 12 12)" opacity="0" />
                                        <path d="M12 6a1 1 0 0 0 1-1V3a1 1 0 0 0-2 0v2a1 1 0 0 0 1 1z" />
                                        <path d="M21 11h-2a1 1 0 0 0 0 2h2a1 1 0 0 0 0-2z" />
                                        <path d="M6 12a1 1 0 0 0-1-1H3a1 1 0 0 0 0 2h2a1 1 0 0 0 1-1z" />
                                        <path
                                            d="M6.22 5a1 1 0 0 0-1.39 1.47l1.44 1.39a1 1 0 0 0 .73.28 1 1 0 0 0 .72-.31 1 1 0 0 0 0-1.41z" />
                                        <path
                                            d="M17 8.14a1 1 0 0 0 .69-.28l1.44-1.39A1 1 0 0 0 17.78 5l-1.44 1.42a1 1 0 0 0 0 1.41 1 1 0 0 0 .66.31z" />
                                        <path d="M12 18a1 1 0 0 0-1 1v2a1 1 0 0 0 2 0v-2a1 1 0 0 0-1-1z" />
                                        <path
                                            d="M17.73 16.14a1 1 0 0 0-1.39 1.44L17.78 19a1 1 0 0 0 .69.28 1 1 0 0 0 .72-.3 1 1 0 0 0 0-1.42z" />
                                        <path
                                            d="M6.27 16.14l-1.44 1.39a1 1 0 0 0 0 1.42 1 1 0 0 0 .72.3 1 1 0 0 0 .67-.25l1.44-1.39a1 1 0 0 0-1.39-1.44z" />
                                        <path d="M12 8a4 4 0 1 0 4 4 4 4 0 0 0-4-4zm0 6a2 2 0 1 1 2-2 2 2 0 0 1-2 2z" />
                                    </g>
                                </g>
                            </svg>
                            <svg
                                class="h-6 w-6 text-gray-400 absolute transition duration-300 ease-in top-[25%] translate-y-[50%] group-hover:translate-y-0 -translate-x-[150%] text-slate-200 group-hover:translate-x-0 "
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M17.293 13.293A8.002 8.002 0 017.707 2.707a8.002 8.002 0 109.586 10.586z" />
                            </svg>
                        </button>
                    </div>
                    <div class="mx-auto max-w-lg">
                        <h1 class="text-2xl font-medium text-gray-900">Register</h1>
                        <p class="mt-1 text-gray-600">Some details to get started chatting!</p>
                    </div>

                    <form id="registerForm"
                        class="mx-auto mb-0 mt-8 max-w-md space-y-4">

                        <div class="flex flex-col gap-1">
                            <div>
                                <label for="username" class="sr-only">Username</label>
                                <div class="relative">
                                    <input type="text" name="username" autocomplete="off"
                                        class="w-full rounded-lg border border-gray-300 p-4 pe-8 text-sm shadow-sm transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="Username" />
                                    <span class="absolute inset-y-0 end-0 grid place-content-center px-4">

                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                            class="size-5 text-gray-400" fill="none" stroke="currentColor">
                                            <g data-name="Layer 2">
                                                <g data-name="person">
                                                    <rect width="24" height="24" opacity="0" />
                                                    <path
                                                        d="M12 11a4 4 0 1 0-4-4 4 4 0 0 0 4 4zm0-6a2 2 0 1 1-2 2 2 2 0 0 1 2-2z" />
                                                    <path
                                                        d="M12 13a7 7 0 0 0-7 7 1 1 0 0 0 2 0 5 5 0 0 1 10 0 1 1 0 0 0 2 0 7 7 0 0 0-7-7z" />
                                                </g>
                                            </g>
                                        </svg>
                                    </span>
                                </div>
                            </div>

                            <div>
                                <label for="email" class="sr-only">Email</label>
                                <div class="relative">
                                    <input type="email" name="email"
                                        class="w-full rounded-lg border border-gray-300 p-4 pe-8 text-sm shadow-sm transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="Email" />
                                    <span class="absolute inset-y-0 end-0 grid place-content-center px-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="size-5 text-gray-400" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col gap-1">
                            <div>
                                <label for="password" class="sr-only">Password</label>
                                <div class="relative">
                                    <input id="password" name="password" type="password"
                                        class="w-full rounded-lg border border-gray-300 p-4 pe-8 text-sm shadow-sm transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="Password" />
                                    <span class="absolute inset-y-0 end-0 grid place-content-center px-4 cursor-pointer"
                                        onclick="togglePassword(0)">
                                        <!-- Eye Icon (Visible) -->
                                        <svg id="eye" xmlns="http://www.w3.org/2000/svg" class="size-5 text-gray-400"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>

                                        <!-- Eye Slash Icon (Hidden) -->
                                        <svg id="eye-slash" xmlns="http://www.w3.org/2000/svg"
                                            class="hidden size-5 text-gray-400" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13.875 18.825A9.959 9.959 0 0112 19c-5.006 0-9.293-3.663-10.35-8.5C2.707 7.663 6.994 4 12 4c.95 0 1.865.131 2.725.378M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 3l18 18" />
                                        </svg>
                                    </span>
                                </div>
                            </div>

                            <div>
                                <label for="confirm_password" class="sr-only">Confirm Password</label>
                                <div class="relative">
                                    <input id="confirm_password" name="confirm_password" type="password"
                                        class="w-full rounded-lg border border-gray-300 p-4 pe-8 text-sm shadow-sm transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="Confirm Password" />
                                    <span class="absolute inset-y-0 end-0 grid place-content-center px-4 cursor-pointer"
                                        onclick="togglePassword(1)">
                                        <!-- Eye Icon (Visible) -->
                                        <svg id="con_eye" xmlns="http://www.w3.org/2000/svg" class="size-5 text-gray-400"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>

                                        <!-- Eye Slash Icon (Hidden) -->
                                        <svg id="con_eye-slash" xmlns="http://www.w3.org/2000/svg"
                                            class="hidden size-5 text-gray-400" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13.875 18.825A9.959 9.959 0 0112 19c-5.006 0-9.293-3.663-10.35-8.5C2.707 7.663 6.994 4 12 4c.95 0 1.865.131 2.725.378M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 3l18 18" />
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <button type="submit"
                            class="w-full rounded-lg bg-blue-500 px-5 py-3 text-sm font-medium text-white shadow-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400">
                            Register
                        </button>

                        <div class="text-center">
                            <a href="#" class="text-sm text-blue-500 hover:underline">Forgot password?</a>
                            <p class="text-sm text-gray-600 pt-2">
                                Already have an account?
                                <a class="text-blue-500 hover:underline" href="./login.php">Sign in</a>
                            </p>
                        </div>
                    </form>

                </div>
            </div>

        </div>

        <script>
            function showAlert(title, message) {
                $('#alert-title').text(title);
                $('#alert-message').text(message);

                // Show the alert with fade-in effect
                $('#login-alert').removeClass('hidden').css('opacity', 0).animate({
                    opacity: 1
                }, 300);

                // Hide the alert after 5 seconds with a fade-out effect
                setTimeout(() => {
                    $('#login-alert').animate({
                        opacity: 0
                    }, 300, function() {
                        $(this).addClass('hidden');
                    });
                }, 5000);
            }


            $('#registerForm').on('submit', function(e) {
                e.preventDefault();

                const formData = new FormData(this);

                $.ajax({
                    url: '../controller/registerController.php',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        if (data.success) {
                            window.location.href = "./login.php";
                        } else {
                            if (data.errors) {
                                const firstError = Object.values(data.errors)[0];
                                showAlert("Error", firstError);
                            } else {
                                showAlert("Error", data.message || "An unknown error occurred.");
                            }
                        }
                    },
                    error: function() {
                        showAlert("Error", "An error occurred. Please try again.");
                    }
                });
            });




            function togglePassword(type) {
                const field = type ? document.getElementById('confirm_password') : document.getElementById('password');
                const eye = type ? document.getElementById('con_eye') : document.getElementById('eye');
                field.type = field.type === 'password' ? 'text' : 'password';
            }
        </script>
    </body>

    </html>


<?php
} elseif ($_GET["theme"] === "dark") {


?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PAIGAM DO REGISTRATION</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            .dotted-line::before {
                content: " ";
                position: absolute;
                left: 100%;
                top: 50%;
                width: 400px;
                z-index: -1;
                border-bottom: 5px dashed rgba(255, 255, 255, 0.215);
            }
        </style>
    </head>

    <body class="w-full bg-[#0F0F0F] relative">
        <div
            role="alert"
            id="login-alert"
            class="rounded hidden max-w-[400px] border-s-4 z-50 border-red-500 bg-red-50 p-4 absolute right-4 top-4 transition-opacity duration-300 ease-in-out opacity-0">
            <div class="flex items-center gap-2 text-red-800">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                    <path
                        fill-rule="evenodd"
                        d="M9.401 3.003c1.155-2 4.043-2 5.197 0l7.355 12.748c1.154 2-.29 4.5-2.599 4.5H4.645c-2.309 0-3.752-2.5-2.598-4.5L9.4 3.003zM12 8.25a.75.75 0 01.75.75v3.75a.75.75 0 01-1.5 0V9a.75.75 0 01.75-.75zm0 8.25a.75.75 0 100-1.5.75.75 0 000 1.5z"
                        clip-rule="evenodd" />
                </svg>

                <strong class="block font-medium" id="alert-title">Something went wrong</strong>
            </div>

            <p class="mt-2 text-sm text-red-700" id="alert-message">
                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nemo quasi assumenda numquam deserunt
                consectetur autem nihil quos debitis dolor culpa.
            </p>
        </div>

        <div class="container mx-auto flex flex-col justify-center items-center w-full h-screen ">

            <div class="login-form flex justify-between text-white relative">
                <div class="w-[120px] h-[120px] rounded-full absolute z-1 right-[20px] bottom-[10px]"
                    style="background: linear-gradient(135deg, #530061, #0D0A30);"></div>
                <div class="w-[200px] h-[200px] rounded-full absolute z-1 right-[290px]"
                    style="background: linear-gradient(135deg, #530061, #0D0A30);"></div>
                <div class="flex justify-center items-start flex-col w-[550px]">
                    <h2 class="text-6xl tracking-wider font-bold">PAIGAM DO</h2>
                    <div class="dotted-line flex items-center relative">

                        <span
                            class="border-2 select-text py-2 px-4 ml-3 mt-2 font-bold border-slate-300 italic">MESSANGER</span>
                    </div>
                </div>
                <div class="mx-auto min-w-[320px] relative z-30 w-[460px] rounded-xl bg-gray-900 px-2 py-20 sm:px-6 lg:px-8"
                    style="background: linear-gradient(135deg, #1616163e, #0000003e);">
                    <div class="absolute right-10 top-10">
                        <button onclick="location.href = './register.php'"
                            class="p-3 transition duration-500 ease-in group relative overflow-hidden rounded-full  hover:bg-gray-700 bg-slate-200  transition-colors duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-6 w-6  transition duration-300 ease-in translate-x-[150%] group-hover:translate-x-0 translate-y-[50%] group-hover:translate-y-0 fill-yellow-500 "
                                viewBox="0 0 24 24">
                                <g data-name="Layer 2">
                                    <g data-name="sun">
                                        <rect width="24" height="24" transform="rotate(180 12 12)" opacity="0" />
                                        <path d="M12 6a1 1 0 0 0 1-1V3a1 1 0 0 0-2 0v2a1 1 0 0 0 1 1z" />
                                        <path d="M21 11h-2a1 1 0 0 0 0 2h2a1 1 0 0 0 0-2z" />
                                        <path d="M6 12a1 1 0 0 0-1-1H3a1 1 0 0 0 0 2h2a1 1 0 0 0 1-1z" />
                                        <path
                                            d="M6.22 5a1 1 0 0 0-1.39 1.47l1.44 1.39a1 1 0 0 0 .73.28 1 1 0 0 0 .72-.31 1 1 0 0 0 0-1.41z" />
                                        <path
                                            d="M17 8.14a1 1 0 0 0 .69-.28l1.44-1.39A1 1 0 0 0 17.78 5l-1.44 1.42a1 1 0 0 0 0 1.41 1 1 0 0 0 .66.31z" />
                                        <path d="M12 18a1 1 0 0 0-1 1v2a1 1 0 0 0 2 0v-2a1 1 0 0 0-1-1z" />
                                        <path
                                            d="M17.73 16.14a1 1 0 0 0-1.39 1.44L17.78 19a1 1 0 0 0 .69.28 1 1 0 0 0 .72-.3 1 1 0 0 0 0-1.42z" />
                                        <path
                                            d="M6.27 16.14l-1.44 1.39a1 1 0 0 0 0 1.42 1 1 0 0 0 .72.3 1 1 0 0 0 .67-.25l1.44-1.39a1 1 0 0 0-1.39-1.44z" />
                                        <path d="M12 8a4 4 0 1 0 4 4 4 4 0 0 0-4-4zm0 6a2 2 0 1 1 2-2 2 2 0 0 1-2 2z" />
                                    </g>
                                </g>
                            </svg>
                            <svg
                                class="h-6 w-6 absolute transition duration-300 ease-in top-[25%]  translate-y-0 group-hover:translate-y-[50%] group-hover:-translate-x-[150%] text-slate-200 "
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="gray">
                                <path d="M17.293 13.293A8.002 8.002 0 017.707 2.707a8.002 8.002 0 109.586 10.586z" />
                            </svg>
                        </button>
                    </div>
                    <div class="mx-auto max-w-lg">
                        <h1 class="text-2xl font-medium">Register</h1>

                        <p class="mt-1 font-base">
                            Some details to get started chatting!
                        </p>
                    </div>
                    <form id="registerForm" class="mx-auto mb-0 mt-8 max-w-md space-y-4">
                        <div class="flex flex-col gap-1">
                            <div>
                                <label for="email" class="sr-only">Username</label>
                                <div class="relative">
                                    <input type="text" name="username" autocomplete="off"
                                        class="w-full bg-transparent rounded-lg border border-gray-200 p-4 pe-8 text-sm shadow-sm transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400 hover:shadow-md"
                                        placeholder="Username" />
                                    <span class="absolute inset-y-0 end-0 grid place-content-center px-4">

                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                            class="size-5 text-gray-400" fill="none" stroke="currentColor">
                                            <g data-name="Layer 2">
                                                <g data-name="person">
                                                    <rect width="24" height="24" opacity="0" />
                                                    <path
                                                        d="M12 11a4 4 0 1 0-4-4 4 4 0 0 0 4 4zm0-6a2 2 0 1 1-2 2 2 2 0 0 1 2-2z" />
                                                    <path
                                                        d="M12 13a7 7 0 0 0-7 7 1 1 0 0 0 2 0 5 5 0 0 1 10 0 1 1 0 0 0 2 0 7 7 0 0 0-7-7z" />
                                                </g>
                                            </g>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                            <div>
                                <label for="email" class="sr-only">Email</label>
                                <div class="relative">
                                    <input type="email" name="email"
                                        class="w-full bg-transparent rounded-lg border border-gray-200 p-4 pe-8 text-sm shadow-sm transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400 hover:shadow-md"
                                        placeholder="Email" />
                                    <span class="absolute inset-y-0 end-0 grid place-content-center px-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="size-5 text-gray-400" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col gap-1">
                            <div>
                                <label for="password" class="sr-only">Password</label>
                                <div class="relative">
                                    <input id="password" name="password" type="password"
                                        class="w-full bg-transparent rounded-lg border border-gray-200 p-4 pe-8 text-sm shadow-sm transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400 hover:shadow-md"
                                        placeholder="Password" />
                                    <span class="absolute inset-y-0 end-0 grid place-content-center px-4 cursor-pointer"
                                        onclick="togglePassword(0)">
                                        <!-- Eye Icon (Visible) -->
                                        <svg id="eye" xmlns="http://www.w3.org/2000/svg" class="size-5 text-gray-400"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>

                                        <!-- Eye Slash Icon (Hidden) -->
                                        <svg id="eye-slash" xmlns="http://www.w3.org/2000/svg"
                                            class="hidden size-5 text-gray-400" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13.875 18.825A9.959 9.959 0 0112 19c-5.006 0-9.293-3.663-10.35-8.5C2.707 7.663 6.994 4 12 4c.95 0 1.865.131 2.725.378M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 3l18 18" />
                                        </svg>
                                    </span>
                                </div>
                            </div>
                            <div>
                                <label for="confirm_password" class="sr-only">Confirm Password</label>
                                <div class="relative">
                                    <input id="confirm_password" name="confirm_password" type="password"
                                        class="w-full bg-transparent rounded-lg border border-gray-200 p-4 pe-8 text-sm shadow-sm transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400 hover:shadow-md"
                                        placeholder="Confirm Password" />
                                    <span class="absolute inset-y-0 end-0 grid place-content-center px-4 cursor-pointer"
                                        onclick="togglePassword(1)">
                                        <!-- Eye Icon (Visible) -->
                                        <svg id="con_eye" xmlns="http://www.w3.org/2000/svg" class="size-5 text-gray-400"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>

                                        <!-- Eye Slash Icon (Hidden) -->
                                        <svg id="con_eye-slash" xmlns="http://www.w3.org/2000/svg"
                                            class="hidden size-5 text-gray-400" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13.875 18.825A9.959 9.959 0 0112 19c-5.006 0-9.293-3.663-10.35-8.5C2.707 7.663 6.994 4 12 4c.95 0 1.865.131 2.725.378M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 3l18 18" />
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <button type="submit" style="background: linear-gradient(135deg, #0785bc, #810c96, #130e46);"
                            class="inline-block w-full rounded-lg text-lg px-5 py-3 text-sm font-medium text-white shadow-lg transform transition duration-300 ease-in-out hover:scale-102 hover:shadow-lg hover:opacity-90">
                            Register
                        </button>


                        <!-- Forget password link -->
                        <div class="text-center">
                            <a href="#" class="text-sm text-slate-300 hover:text-slate-400 hover:underline">Forgot
                                password?</a>
                            <p class="text-sm text-slate-300 pt-2">
                                Already have an account?
                                <a class="underline hover:text-slate-400" href="./login.php?theme=dark">Sign in</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>

        </div>



        <script>
            function showAlert(title, message) {
                $('#alert-title').text(title);
                $('#alert-message').text(message);

                // Show the alert with fade-in effect
                $('#login-alert').removeClass('hidden').css('opacity', 0).animate({
                    opacity: 1
                }, 300);

                // Hide the alert after 5 seconds with a fade-out effect
                setTimeout(() => {
                    $('#login-alert').animate({
                        opacity: 0
                    }, 300, function() {
                        $(this).addClass('hidden');
                    });
                }, 5000);
            }

            $('#registerForm').on('submit', function(e) {
                e.preventDefault();

                const formData = new FormData(this);

                $.ajax({
                    url: '../controller/registerController.php',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(data) {
                        if (data.success) {
                            window.location.href = "./login.php?theme=dark";
                        } else {
                            if (data.errors) {
                                const firstError = Object.values(data.errors)[0];
                                showAlert("Error", firstError);
                            } else {
                                showAlert("Error", data.message || "An unknown error occurred.");
                            }
                        }
                    },
                    error: function() {
                        showAlert("Error", "An error occurred. Please try again.");
                    }
                });
            });

            function togglePassword(index) {
                const passwordInput = index === 0 ? $('#password') : $('#confirm_password');
                const eyeIcon = index === 0 ? $('#eye') : $('#con_eye');
                const eyeSlashIcon = index === 0 ? $('#eye-slash') : $('#con_eye-slash');

                if (passwordInput.attr('type') === 'password') {
                    passwordInput.attr('type', 'text');
                    eyeIcon.addClass('hidden');
                    eyeSlashIcon.removeClass('hidden');
                } else {
                    passwordInput.attr('type', 'password');
                    eyeIcon.removeClass('hidden');
                    eyeSlashIcon.addClass('hidden');
                }
            }
        </script>
    </body>

    </html>

<?php

}

?>
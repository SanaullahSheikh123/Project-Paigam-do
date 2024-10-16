<?php

include "./includes/config.php";
session_start();

if ($_SESSION["user"]["logged_in"] !== true) {
    header("Location: ./views/login.php");
    exit();
}

if (!$_SESSION["user"]["setup_completed"]) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SETUP | Paigam Do - Messenger</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    </head>

    <body class="relative">
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
        <div class="flex justify-center items-center h-screen bg-[#0F0F0F]" id="setup_profile">
            <form
                id="setupForm"
                enctype="multipart/form-data"
                class="p-10 pt-12 w-[450px] rounded-2xl shadow-2xl space-y-8"
                style="background: linear-gradient(235deg, #2b2b2b, #161616);">

                <div class="flex flex-col items-center px-4 space-y-5">
                    <div
                        id="profilePictureContainer"
                        style="background-image: url(./assets/images/guest.svg);"
                        class="relative w-[160px] h-[160px] rounded-full bg-cover bg-center border-4 border-gray-600 group hover:ring-4 hover:ring-blue-500 transition duration-300 overflow-hidden cursor-pointer">

                        <input
                            type="file"
                            name="profile_picture"
                            id="profile_picture"
                            class="absolute inset-0 opacity-0 cursor-pointer z-10"
                            accept="image/*">

                        <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <g data-name="Layer 2">
                                    <g data-name="cloud-upload">
                                        <path d="M12.71 11.29a1 1 0 0 0-1.4 0l-3 2.9a1 1 0 1 0 1.38 1.44L11 14.36V20a1 1 0 0 0 2 0v-5.59l1.29 1.3a1 1 0 0 0 1.42 0 1 1 0 0 0 0-1.42z" />
                                        <path d="M17.67 7A6 6 0 0 0 6.33 7a5 5 0 0 0-3.08 8.27A1 1 0 1 0 4.75 14 3 3 0 0 1 7 9h.1a1 1 0 0 0 1-.8 4 4 0 0 1 7.84 0 1 1 0 0 0 1 .8H17a3 3 0 0 1 2.25 5 1 1 0 0 0 .09 1.42 1 1 0 0 0 .66.25 1 1 0 0 0 .75-.34A5 5 0 0 0 17.67 7z" />
                                    </g>
                                </g>
                            </svg>
                        </div>
                    </div>

                    <input
                        type="text"
                        name="display_name"
                        class="w-full px-4 py-3 bg-gray-800 text-gray-300 border border-gray-600 rounded-lg focus:ring focus:ring-blue-500 focus:outline-none transition duration-300"
                        placeholder="Enter your Display Name"
                        autofocus>
                    <span class="text-red-400 hidden" id="display_name_error">Please enter a display name</span>

                    <button
                        type="submit"
                        class="w-full py-3 rounded-lg text-white font-semibold bg-gradient-to-r from-blue-600 via-purple-600 to-indigo-800 hover:scale-105 transition-transform duration-300">
                        Continue
                    </button>
                </div>
            </form>
        </div>


        <script>
            document.getElementById('profile_picture').addEventListener('change', function(event) {
                const file = event.target.files[0];
                const PictureContainer = document.getElementById('profilePictureContainer');

                if (file) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        PictureContainer.style.backgroundImage = `url(${e.target.result})`;
                    };
                    reader.readAsDataURL(file);
                }
            });

            function showAlert(title, message) {
                $('#alert-title').text(title);
                $('#alert-message').html(message);

                $('#login-alert').removeClass('hidden').css('opacity', 0).animate({
                    opacity: 1
                }, 300);

                setTimeout(() => {
                    $('#login-alert').animate({
                        opacity: 0
                    }, 300, function() {
                        $(this).addClass('hidden');
                    });
                }, 5000);
            }

            $('#setupForm').on('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);

                $.ajax({
                    url: './controller/setupController.php',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(response) {
                        console.log("Response from setup: ", response);
                        if (response.errors) {
                            let errorMessage = "";
                            if (response.errors.display_name) {
                                errorMessage += response.errors.display_name + "<br>";
                            }
                            if (response.errors.profile_picture) {
                                errorMessage += response.errors.profile_picture + "<br>";
                            }
                            showAlert("Error", errorMessage || "An unknown error occurred.");
                        } else if (response.success) {
                            $("#setup_profile").remove();
                            location.reload();
                        } else {
                            console.log("Unexpected response: ", response);
                            showAlert("Error", "Unexpected response received.");
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Error from setup: ", error);
                        showAlert("Error", "An error occurred. Please try again.");
                    }
                });
            });
        </script>

    </body>

    </html>
<?php
} else {

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>PAIGAM DO MESSENGER</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <style>
            .active {
                background-color: #e5e7eb;
                border-right: 2px solid #7d7d7d;
            }

            .groups-container {
                scrollbar-gutter: stable;
            }
        </style>
    </head>

    <body>
        <div class="flex w-screen h-screen relative bg-blue-100">
            <div class="sidebar min-w-20 z-50">
                <div class="wrapper w-full h-full flex flex-col justify-between items-center px-1 py-4 bg-slate-100 rounded-r-xl">
                    <div id="show-profile" class="profile w-full flex justify-center group rounded-full group py-2 my-2">
                        <img
                            src="<?= $_SESSION['user']['user_picture'] ?>"
                            class="rounded-full size-14 transform cursor-pointer transition duration-300 group-hover:shadow-xl"
                            alt="user" />
                    </div>

                    <nav class="flex flex-col justify-center gap-4 p-6 w-20 bg-gray-100">
                        <ul class="space-y-2 flex flex-col items-center">
                            <li class="group relative">
                                <div
                                    class="p-4 rounded-lg cursor-pointer hover:bg-gray-300 transition-colors tab"
                                    data-tab="home">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="w-6 h-6 text-gray-700 group-hover:text-black transition-colors"
                                        viewBox="0 0 24 24">
                                        <g data-name="Layer 2">
                                            <g data-name="home">
                                                <rect width="24" height="24" opacity="0" />
                                                <path
                                                    d="M20.42 10.18L12.71 2.3a1 1 0 0 0-1.42 0l-7.71 7.89A2 2 0 0 0 3 11.62V20a2 2 0 0 0 1.89 2h14.22A2 2 0 0 0 21 20v-8.38a2.07 2.07 0 0 0-.58-1.44zM10 20v-6h4v6zm9 0h-3v-7a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v7H5v-8.42l7-7.15 7 7.19z" />
                                            </g>
                                        </g>
                                    </svg>
                                </div>
                                <span
                                    class="absolute left-16 top-3 bg-gray-900 text-white text-xs py-1 px-2 rounded-lg opacity-0 translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all duration-300">
                                    Home
                                </span>
                            </li>
                            <li class="group relative">
                                <div
                                    class="p-4 rounded-lg cursor-pointer hover:bg-gray-300 transition-colors tab active"
                                    data-tab="messages">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="w-6 h-6 text-gray-700 group-hover:text-black"
                                        class="w-6 h-6 text-gray-700 group-hover:text-black transition-colors"
                                        viewBox="0 0 24 24">
                                        <g data-name="Layer 2">
                                            <g data-name="message-circle">
                                                <circle cx="12" cy="12" r="1" />
                                                <circle cx="16" cy="12" r="1" />
                                                <circle cx="8" cy="12" r="1" />
                                                <path
                                                    d="M19.07 4.93a10 10 0 0 0-16.28 11 1.06 1.06 0 0 1 .09.64L2 20.8a1 1 0 0 0 .27.91A1 1 0 0 0 3 22h.2l4.28-.86a1.26 1.26 0 0 1 .64.09 10 10 0 0 0 11-16.28zm.83 8.36a8 8 0 0 1-11 6.08 3.26 3.26 0 0 0-1.25-.26 3.43 3.43 0 0 0-.56.05l-2.82.57.57-2.82a3.09 3.09 0 0 0-.21-1.81 8 8 0 0 1 6.08-11 8 8 0 0 1 9.19 9.19z" />
                                                <rect width="24" height="24" opacity="0" />
                                            </g>
                                        </g>
                                    </svg>
                                </div>
                                <span
                                    class="absolute left-16 top-3 bg-gray-900 text-white text-xs py-1 px-2 rounded-lg opacity-0 translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all duration-300">
                                    Messages
                                </span>
                            </li>
                            <li class="group relative">
                                <div
                                    class="p-4 rounded-lg cursor-pointer hover:bg-gray-300 transition-colors tab"
                                    data-tab="notifications">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="w-6 h-6 text-gray-700 group-hover:text-black transition-colors"
                                        viewBox="0 0 24 24">
                                        <g data-name="Layer 2">
                                            <g data-name="bell">
                                                <rect width="24" height="24" opacity="0" />
                                                <path
                                                    d="M20.52 15.21l-1.8-1.81V8.94a6.86 6.86 0 0 0-5.82-6.88 6.74 6.74 0 0 0-7.62 6.67v4.67l-1.8 1.81A1.64 1.64 0 0 0 4.64 18H8v.34A3.84 3.84 0 0 0 12 22a3.84 3.84 0 0 0 4-3.66V18h3.36a1.64 1.64 0 0 0 1.16-2.79zM14 18.34A1.88 1.88 0 0 1 12 20a1.88 1.88 0 0 1-2-1.66V18h4zM5.51 16l1.18-1.18a2 2 0 0 0 .59-1.42V8.73A4.73 4.73 0 0 1 8.9 5.17 4.67 4.67 0 0 1 12.64 4a4.86 4.86 0 0 1 4.08 4.9v4.5a2 2 0 0 0 .58 1.42L18.49 16z" />
                                            </g>
                                        </g>
                                    </svg>
                                </div>
                                <span
                                    class="absolute left-16 top-3 bg-gray-900 text-white text-xs py-1 px-2 rounded-lg opacity-0 translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all duration-300">
                                    Notifications
                                </span>
                            </li>
                            <li class="group relative">
                                <div
                                    class="p-4 rounded-lg cursor-pointer hover:bg-gray-300 transition-colors tab"
                                    data-tab="settings">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="w-6 h-6 text-gray-700 group-hover:text-black transition-colors"
                                        viewBox="0 0 24 24">
                                        <g data-name="Layer 2">
                                            <g data-name="settings">
                                                <rect width="24" height="24" opacity="0" />
                                                <path
                                                    d="M8.61 22a2.25 2.25 0 0 1-1.35-.46L5.19 20a2.37 2.37 0 0 1-.49-3.22 2.06 2.06 0 0 0 .23-1.86l-.06-.16a1.83 1.83 0 0 0-1.12-1.22h-.16a2.34 2.34 0 0 1-1.48-2.94L2.93 8a2.18 2.18 0 0 1 1.12-1.41 2.14 2.14 0 0 1 1.68-.12 1.93 1.93 0 0 0 1.78-.29l.13-.1a1.94 1.94 0 0 0 .73-1.51v-.24A2.32 2.32 0 0 1 10.66 2h2.55a2.26 2.26 0 0 1 1.6.67 2.37 2.37 0 0 1 .68 1.68v.28a1.76 1.76 0 0 0 .69 1.43l.11.08a1.74 1.74 0 0 0 1.59.26l.34-.11A2.26 2.26 0 0 1 21.1 7.8l.79 2.52a2.36 2.36 0 0 1-1.46 2.93l-.2.07A1.89 1.89 0 0 0 19 14.6a2 2 0 0 0 .25 1.65l.26.38a2.38 2.38 0 0 1-.5 3.23L17 21.41a2.24 2.24 0 0 1-3.22-.53l-.12-.17a1.75 1.75 0 0 0-1.5-.78 1.8 1.8 0 0 0-1.43.77l-.23.33A2.25 2.25 0 0 1 9 22a2 2 0 0 1-.39 0zM4.4 11.62a3.83 3.83 0 0 1 2.38 2.5v.12a4 4 0 0 1-.46 3.62.38.38 0 0 0 0 .51L8.47 20a.25.25 0 0 0 .37-.07l.23-.33a3.77 3.77 0 0 1 6.2 0l.12.18a.3.3 0 0 0 .18.12.25.25 0 0 0 .19-.05l2.06-1.56a.36.36 0 0 0 .07-.49l-.26-.38A4 4 0 0 1 17.1 14a3.92 3.92 0 0 1 2.49-2.61l.2-.07a.34.34 0 0 0 .19-.44l-.78-2.49a.35.35 0 0 0-.2-.19.21.21 0 0 0-.19 0l-.34.11a3.74 3.74 0 0 1-3.43-.57L15 7.65a3.76 3.76 0 0 1-1.49-3v-.31a.37.37 0 0 0-.1-.26.31.31 0 0 0-.21-.08h-2.54a.31.31 0 0 0-.29.33v.25a3.9 3.9 0 0 1-1.52 3.09l-.13.1a3.91 3.91 0 0 1-3.63.59.22.22 0 0 0-.14 0 .28.28 0 0 0-.12.15L4 11.12a.36.36 0 0 0 .22.45z"
                                                    data-name="&lt;Group&gt;" />
                                                <path
                                                    d="M12 15.5a3.5 3.5 0 1 1 3.5-3.5 3.5 3.5 0 0 1-3.5 3.5zm0-5a1.5 1.5 0 1 0 1.5 1.5 1.5 1.5 0 0 0-1.5-1.5z" />
                                            </g>
                                        </g>
                                    </svg>
                                </div>
                                <span
                                    class="absolute left-16 top-3 bg-gray-900 text-white text-xs py-1 px-2 rounded-lg opacity-0 translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all duration-300">
                                    Settings
                                </span>
                            </li>
                        </ul>
                    </nav>
                    <a href="./controller/logout.php" class="group relative my-2">
                        <div
                            class="p-4 rounded-lg cursor-pointer hover:bg-gray-300 transition-colors">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="w-6 h-6 text-gray-700 group-hover:text-black transition-colors"
                                viewBox="0 0 24 24">
                                <g data-name="Layer 2">
                                    <g data-name="log-out">
                                        <rect
                                            width="24"
                                            height="24"
                                            transform="rotate(90 12 12)"
                                            opacity="0" />
                                        <path
                                            d="M7 6a1 1 0 0 0 0-2H5a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h2a1 1 0 0 0 0-2H6V6z" />
                                        <path
                                            d="M20.82 11.42l-2.82-4a1 1 0 0 0-1.39-.24 1 1 0 0 0-.24 1.4L18.09 11H10a1 1 0 0 0 0 2h8l-1.8 2.4a1 1 0 0 0 .2 1.4 1 1 0 0 0 .6.2 1 1 0 0 0 .8-.4l3-4a1 1 0 0 0 .02-1.18z" />
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <span
                            class="absolute left-16 top-3 bg-gray-900 text-white text-xs py-1 px-2 rounded-lg opacity-0 translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all duration-300">
                            Logout
                        </span>
                    </a>
                </div>

            </div>
            <div id="profile" class="profile hidden absolute top-0 left-20 flex flex-col z-40 bg-white w-[390px] h-full shadow-md p-6 overflow-y-auto">
                <div class="flex flex-col">
                    <div class="flex justify-between items-center">
                        <h2 class="text-xl font-semibold text-gray-800">Profile</h2>
                        <button id="close-profile" class="text-gray-600 hover:text-gray-800 focus:outline-none" aria-label="Close">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <div class="flex flex-col gap-4 mt-8">
                        <img
                            src="<?= $_SESSION['user']['user_picture']; ?>"
                            alt="Profile Picture"
                            class="w-24 h-24 rounded-full object-cover border-4 border-gray-200 shadow-lg" />
                        <div>
                            <h2 class="text-lg font-semibold text-gray-800">Display name: <?= $_SESSION['user']['display_name']; ?></h2>
                            <p class="text-gray-600 text-md mt-2">username: @<?= $_SESSION['user']['username'] ?></p>
                            <p class="text-gray-500 text-md"><?php
                                                                $timestamp = strtotime($_SESSION['user']['created_at']);
                                                                $formattedDate = 'Joined: ' . date('F Y', $timestamp);
                                                                echo $formattedDate;
                                                                ?></p>
                        </div>
                    </div>
                    <div class="mt-8">
                        <h3 class="text-lg font-semibold text-gray-800">About Me</h3>
                        <p class="text-gray-600 text-md mt-2">
                            <?= $_SESSION['user']['desc']; ?>
                        </p>
                    </div>
                </div>
                <div class="mt-6 mt-auto flex space-x-4">
                    <button id="editProfileBtn" class="flex-1 bg-blue-500 text-white rounded-lg py-2 hover:bg-blue-600 transition duration-200">
                        Edit Profile
                    </button>
                    <button onclick="window.location.href = './controller/logout.php'" class="flex-1 bg-red-500 text-white rounded-lg py-2 hover:bg-red-600 transition duration-200">
                        Logout
                    </button>
                </div>
            </div>
            <div id="editProfileModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-50">
                <div class="bg-white p-6 rounded-lg shadow-md w-[400px]">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Edit Profile</h2>
                    <form id="editProfileForm" enctype="multipart/form-data">
                        <div class="mb-4">
                            <label class="block text-gray-700">Display Name</label>
                            <input type="text" name="display_name" value="<?= $_SESSION['user']['display_name']; ?>"
                                class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" />
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700">About Me</label>
                            <textarea name="desc" rows="3" class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400"><?= $_SESSION['user']['desc']; ?></textarea>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700">Profile Picture</label>
                            <input type="file" name="user_picture" class="w-full p-2 border rounded-md" />
                        </div>
                        <div class="flex justify-end space-x-4">
                            <button type="button" id="cancelEdit" class="py-2 px-4 bg-gray-400 text-white rounded-lg">Cancel</button>
                            <button type="submit" class="py-2 px-4 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Save</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- <div class="groups-container mt-5 bg-white shadow-lg rounded-xl">
                        <h3 class="font-bold pl-5 text-lg pt-5 pb-4">Groups</h3>
                        <div class="overflow-y-auto flex flex-col max-h-60 divide-y">
                            <div
                                class="flex items-center p-4 h-[70px] hover:bg-gray-100 cursor-pointer">
                                <img
                                    src="https://via.placeholder.com/40"
                                    alt="Group 1"
                                    class="w-10 h-10 rounded-full mr-4" />

                                <div class="flex flex-col gap-[3px] w-full">
                                    <h3 class="text-gray-800 text-sm font-semibold">
                                        Developers Hub
                                    </h3>
                                    <p
                                        class="text-xs text-gray-500 w-[160px] overflow-hidden text-ellipsis whitespace-nowrap">
                                        John: Check out the new update... Lorem ipsum dolor sit
                                        amet.
                                    </p>
                                </div>

                                <div class="flex flex-col items-end w-[40%] gap-2">
                                    <span class="text-xs text-gray-400 pb-2">10:24 AM</span>
                                    <span
                                        class="text-sm text-white bg-orange-600 py-[2px] px-2 rounded-full">5</span>
                                </div>
                            </div>
                        </div>
                    </div> -->
            <div class="flex w-screen h-screen relative" id="content">
                <div class="chats-section hidden lg:block p-2 h-[100vh] w-[550px]">
                    <div class="wrapper w-full h-full rounded-xl overflow-hidden">
                        <div class="search-chats flex relative items-center w-full max-w-md mx-auto bg-white shadow-md shadow-blue-200 rounded-xl p-2">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24"
                                class="w-6 h-6 absolute left-5 text-gray-500 mr-3">
                                <g data-name="Layer 2">
                                    <g data-name="search">
                                        <rect width="24" height="24" opacity="0" />
                                        <path
                                            d="M20.71 19.29l-3.4-3.39A7.92 7.92 0 0 0 19 11a8 8 0 1 0-8 8 7.92 7.92 0 0 0 4.9-1.69l3.39 3.4a1 1 0 0 0 1.42 0 1 1 0 0 0 0-1.42zM5 11a6 6 0 1 1 6 6 6 6 0 0 1-6-6z" />
                                    </g>
                                </g>
                            </svg>
                            <input
                                type="text"
                                placeholder="Search"
                                class="w-full h-full pl-12 p-2 bg-white outline-none text-gray-700 placeholder-gray-400" />
                        </div>

                        <div
                            class="mt-2 bg-white rounded-2xl shadow-lg overflow-hidden py-2">
                            <h3 class="font-bold pl-5 text-lg pt-5 pb-4">Chats</h3>

                            <div id="chats-container" class="flex flex-col h-[100%] flex-grow overflow-y-auto divide-y">


                            </div>
                        </div>
                    </div>
                </div>
                <?php
                if (isset($_GET["chat_id"])) {
                    $chat_partner_id = $_GET["chat_id"];
                    $_SESSION["chat_partner_id"] = $chat_partner_id;
                    $user_id = $_SESSION['user']['id'];

                    // 1. Mark all messages as read between the users.
                    $updateQuery = "UPDATE messages 
                                SET is_read = 1 
                                WHERE receiver_id = ? AND sender_id = ?";
                    $stmt = $conn->prepare($updateQuery);
                    $stmt->bind_param('ii', $user_id, $chat_partner_id);
                    $stmt->execute();
                    $stmt->close();

                    // 2. Check if there are any messages between the two users.
                    $checkMessagesQuery = "
                    SELECT COUNT(*) as message_count 
                    FROM messages 
                    WHERE (sender_id = ? AND receiver_id = ?) 
                       OR (sender_id = ? AND receiver_id = ?)";
                    $stmt = $conn->prepare($checkMessagesQuery);
                    $stmt->bind_param('iiii', $user_id, $chat_partner_id, $chat_partner_id, $user_id);
                    $stmt->execute();
                    $result = $stmt->get_result()->fetch_assoc();
                    $message_count = $result['message_count'];
                    $stmt->close();

                    // 3. If no messages exist, send a "Hi" message.
                    if ($message_count == 0) {
                        $hiMessage = "Hi!";
                        $insertQuery = "
                        INSERT INTO messages (sender_id, receiver_id, message, timestamp, is_read) 
                        VALUES (?, ?, ?, NOW(), 1)";
                        $stmt = $conn->prepare($insertQuery);
                        $stmt->bind_param('iis', $user_id, $chat_partner_id, $hiMessage);
                        $stmt->execute();
                        $stmt->close();
                    }

                    // 4. Fetch the chat partner's details.
                    $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
                    $stmt->bind_param('i', $chat_partner_id);
                    $stmt->execute();
                    $user = $stmt->get_result()->fetch_assoc();
                    $stmt->close();

                    function formatDateTime($dateTime)
                    {
                        $date = new DateTime($dateTime);
                        return $date->format('g:i A');
                    }

                    $formattedTime = formatDateTime($user["updated_at"]);
                ?>
                    <div class="messenger w-full mx-auto">
                        <div class="chat-layout flex py-2 flex-col w-full h-full bg-white">
                            <div
                                class="top-row mx-2 border-b-2 shadow-sm rounded-md mx-2 flex px-4 justify-between">
                                <div class="half flex items-center gap-4">
                                    <div
                                        class="profile w-full flex justify-center rounded-full py-2 my-2">
                                        <img
                                            src="<?= $user['profile_picture'] ?>"
                                            class="rounded-full size-12 transform cursor-pointer transition duration-300 hover:shadow-lg"
                                            alt="user" />
                                    </div>
                                    <div class="flex flex-col justify-center">
                                        <p class="text-mdw font-semibold"><?= $user['display_name'] ?></p>
                                        <span class="truncate text-xs"><?= $user['online'] ? "Online" : "Offline" ?> - Last seen, <?= $formattedTime ?></span>
                                    </div>
                                </div>
                                <div class="half flex items-center gap-1">
                                    <div
                                        class="profile w-full flex justify-center group rounded-full group cursor-pointer hover:bg-slate-100 px-2 py-2 my-2">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="rounded-full size-5"
                                            viewBox="0 0 24 24"
                                            fill="currentColor">
                                            <path
                                                d="M9.36556 10.6821C10.302 12.3288 11.6712 13.698 13.3179 14.6344L14.2024 13.3961C14.4965 12.9845 15.0516 12.8573 15.4956 13.0998C16.9024 13.8683 18.4571 14.3353 20.0789 14.4637C20.599 14.5049 21 14.9389 21 15.4606V19.9234C21 20.4361 20.6122 20.8657 20.1022 20.9181C19.5723 20.9726 19.0377 21 18.5 21C9.93959 21 3 14.0604 3 5.5C3 4.96227 3.02742 4.42771 3.08189 3.89776C3.1343 3.38775 3.56394 3 4.07665 3H8.53942C9.0611 3 9.49513 3.40104 9.5363 3.92109C9.66467 5.54288 10.1317 7.09764 10.9002 8.50444C11.1427 8.9484 11.0155 9.50354 10.6039 9.79757L9.36556 10.6821ZM6.84425 10.0252L8.7442 8.66809C8.20547 7.50514 7.83628 6.27183 7.64727 5H5.00907C5.00303 5.16632 5 5.333 5 5.5C5 12.9558 11.0442 19 18.5 19C18.667 19 18.8337 18.997 19 18.9909V16.3527C17.7282 16.1637 16.4949 15.7945 15.3319 15.2558L13.9748 17.1558C13.4258 16.9425 12.8956 16.6915 12.3874 16.4061L12.3293 16.373C10.3697 15.2587 8.74134 13.6303 7.627 11.6707L7.59394 11.6126C7.30849 11.1044 7.05754 10.5742 6.84425 10.0252Z"></path>
                                        </svg>
                                    </div>

                                    <div
                                        class="profile w-full flex justify-center group rounded-full group cursor-pointer hover:bg-slate-100 px-2 py-2 my-2">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="rounded-full size-5"
                                            viewBox="0 0 24 24"
                                            fill="currentColor">
                                            <path
                                                d="M17 9.2L22.2133 5.55071C22.4395 5.39235 22.7513 5.44737 22.9096 5.6736C22.9684 5.75764 23 5.85774 23 5.96033V18.0397C23 18.3158 22.7761 18.5397 22.5 18.5397C22.3974 18.5397 22.2973 18.5081 22.2133 18.4493L17 14.8V19C17 19.5523 16.5523 20 16 20H2C1.44772 20 1 19.5523 1 19V5C1 4.44772 1.44772 4 2 4H16C16.5523 4 17 4.44772 17 5V9.2ZM17 12.3587L21 15.1587V8.84131L17 11.6413V12.3587ZM3 6V18H15V6H3Z"></path>
                                        </svg>
                                    </div>
                                    <div
                                        class="profile w-full flex justify-center group rounded-full group ml-2 cursor-pointer hover:bg-slate-100 px-2 py-2 my-2">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="rounded-full size-5"
                                            viewBox="0 0 24 24"
                                            fill="currentColor">
                                            <path
                                                d="M12 3C11.175 3 10.5 3.675 10.5 4.5C10.5 5.325 11.175 6 12 6C12.825 6 13.5 5.325 13.5 4.5C13.5 3.675 12.825 3 12 3ZM12 18C11.175 18 10.5 18.675 10.5 19.5C10.5 20.325 11.175 21 12 21C12.825 21 13.5 20.325 13.5 19.5C13.5 18.675 12.825 18 12 18ZM12 10.5C11.175 10.5 10.5 11.175 10.5 12C10.5 12.825 11.175 13.5 12 13.5C12.825 13.5 13.5 12.825 13.5 12C13.5 11.175 12.825 10.5 12 10.5Z"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div id="messages-chat" class=" h-[100%] overflow-y-auto center-row flex-grow pt-6 pb-4 px-6">
                                <div class="message flex items-center gap-2 w-full py-2">
                                    <div class="status size-4 bg-slate-50 mt-4 rounded-full"></div>
                                    <div class="flex flex-col">
                                        <div class="text rounded-full shadow-xs bg-slate-50 py-2 px-6">
                                            <span class="text-sm">Hello there!</span>
                                        </div>
                                        <div class="time">
                                            <span class="text-xs text-gray-700 pl-2">Today, 10:00pm</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="message flex items-center gap-2 w-full py-2">
                                    <div class="status size-4 bg-slate-50 mt-4 rounded-full"></div>
                                    <div class="flex flex-col">
                                        <div class="text rounded-full shadow-xs bg-slate-50 py-2 px-6">
                                            <span class="text-sm">how are you!</span>
                                        </div>
                                        <div class="time">
                                            <span class="text-xs text-gray-700 pl-2">Today, 10:05pm</span>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="message flex items-center justify-end gap-2 w-full py-2">
                                    <div class="flex flex-col items-end">
                                        <div
                                            class="text rounded-full shadow-xs bg-purple-600 py-2 px-6">
                                            <span class="text-white text-sm">Im fine how about you?</span>
                                        </div>
                                        <div class="time">
                                            <span class="text-xs text-gray-700 pl-2">Today, 10:20pm</span>
                                        </div>
                                    </div>
                                    <div class="status size-4 bg-purple-600 mt-4 rounded-full"></div>
                                </div>
                                <div
                                    class="message flex items-center justify-end gap-2 w-full py-2">
                                    <div class="flex flex-col items-end">
                                        <div
                                            class="text rounded-full shadow-xs bg-purple-600 py-2 px-6">
                                            <span class="text-white text-sm">Who are you?</span>
                                        </div>
                                        <div class="time">
                                            <span class="text-xs text-gray-700 pl-2">Today, 10:33pm</span>
                                        </div>
                                    </div>
                                    <div class="status size-4 bg-purple-600 mt-4 rounded-full"></div>
                                </div>
                            </div>
                            <div class="bottom-row mx-2 flex items-center px-1 py-2">
                                <div
                                    class="message-input bg-[#EFF6FCDE] shadow-lg rounded-full flex h-14 items-center w-full">
                                    <div
                                        class="profile flex p-2 cursor-pointer hover:bg-slate-200 justify-center rounded-full group ml-3">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="rounded-full size-6 "
                                            viewBox="0 0 24 24"
                                            fill="currentColor">
                                            <path
                                                d="M14 13.5V8C14 5.79086 12.2091 4 10 4C7.79086 4 6 5.79086 6 8V13.5C6 17.0899 8.91015 20 12.5 20C16.0899 20 19 17.0899 19 13.5V4H21V13.5C21 18.1944 17.1944 22 12.5 22C7.80558 22 4 18.1944 4 13.5V8C4 4.68629 6.68629 2 10 2C13.3137 2 16 4.68629 16 8V13.5C16 15.433 14.433 17 12.5 17C10.567 17 9 15.433 9 13.5V8H11V13.5C11 14.3284 11.6716 15 12.5 15C13.3284 15 14 14.3284 14 13.5Z"></path>
                                        </svg>
                                    </div>
                                    <div class="flex-grow h-[100%]">
                                        <input
                                            type="text"
                                            class="w-full h-[100%] bg-transparent outline-none text-md pl-2 text-gray-700 placeholder:text-gray-600"
                                            autocomplete="off"
                                            placeholder="Type your message here..."
                                            name="send-message"
                                            id="send-message" />
                                    </div>

                                    <div class="profile flex p-2 cursor-pointer hover:bg-slate-200 justify-center rounded-full group">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="rounded-full size-6"
                                            viewBox="0 0 24 24"
                                            fill="currentColor">
                                            <path
                                                d="M10.5199 19.8634C10.5955 18.6615 10.8833 17.5172 11.3463 16.4676C9.81124 16.3252 8.41864 15.6867 7.33309 14.7151L8.66691 13.2248C9.55217 14.0172 10.7188 14.4978 12 14.4978C12.1763 14.4978 12.3501 14.4887 12.5211 14.471C14.227 12.2169 16.8661 10.7083 19.8634 10.5199C19.1692 6.80877 15.9126 4 12 4C7.58172 4 4 7.58172 4 12C4 15.9126 6.80877 19.1692 10.5199 19.8634ZM19.0233 12.636C15.7891 13.2396 13.2396 15.7891 12.636 19.0233L19.0233 12.636ZM22 12C22 12.1677 21.9959 12.3344 21.9877 12.5L12.5 21.9877C12.3344 21.9959 12.1677 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12ZM10 10C10 10.8284 9.32843 11.5 8.5 11.5C7.67157 11.5 7 10.8284 7 10C7 9.17157 7.67157 8.5 8.5 8.5C9.32843 8.5 10 9.17157 10 10ZM17 10C17 10.8284 16.3284 11.5 15.5 11.5C14.6716 11.5 14 10.8284 14 10C14 9.17157 14.6716 8.5 15.5 8.5C16.3284 8.5 17 9.17157 17 10Z"></path>
                                        </svg>
                                    </div>

                                    <div class="profile flex p-2 cursor-pointer mr-4 justify-center hover:bg-slate-200 rounded-full group">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="rounded-full size-6"
                                            viewBox="0 0 24 24"
                                            fill="currentColor">
                                            <path
                                                d="M9.82843 5L7.82843 7H4V19H20V7H16.1716L14.1716 5H9.82843ZM9 3H15L17 5H21C21.5523 5 22 5.44772 22 6V20C22 20.5523 21.5523 21 21 21H3C2.44772 21 2 20.5523 2 20V6C2 5.44772 2.44772 5 3 5H7L9 3ZM12 18C8.96243 18 6.5 15.5376 6.5 12.5C6.5 9.46243 8.96243 7 12 7C15.0376 7 17.5 9.46243 17.5 12.5C17.5 15.5376 15.0376 18 12 18ZM12 16C13.933 16 15.5 14.433 15.5 12.5C15.5 10.567 13.933 9 12 9C10.067 9 8.5 10.567 8.5 12.5C8.5 14.433 10.067 16 12 16Z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <button class="rounded-full mx-2 bg-green-400 transform transition-all linear duration-300  p-3 hover:p-[10px] hover:bg-green-500">
                                    <div class="profile flex cursor-pointer  justify-center rounded-full group">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="rounded-full size-8 "
                                            viewBox="0 0 24 24"
                                            fill="currentColor">
                                            <path
                                                d="M11.9998 3C10.3429 3 8.99976 4.34315 8.99976 6V10C8.99976 11.6569 10.3429 13 11.9998 13C13.6566 13 14.9998 11.6569 14.9998 10V6C14.9998 4.34315 13.6566 3 11.9998 3ZM11.9998 1C14.7612 1 16.9998 3.23858 16.9998 6V10C16.9998 12.7614 14.7612 15 11.9998 15C9.23833 15 6.99976 12.7614 6.99976 10V6C6.99976 3.23858 9.23833 1 11.9998 1ZM3.05469 11H5.07065C5.55588 14.3923 8.47329 17 11.9998 17C15.5262 17 18.4436 14.3923 18.9289 11H20.9448C20.4837 15.1716 17.1714 18.4839 12.9998 18.9451V23H10.9998V18.9451C6.82814 18.4839 3.51584 15.1716 3.05469 11Z"></path>
                                        </svg>
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>
            </div>
            <script>
                function fetchMessages() {
                    $.ajax({
                        url: './controller/fetch_messages.php',
                        method: 'POST',
                        success: function(data) {
                            $('#messages-chat').html(data);
                        },
                        error: function(err) {
                            console.error('Error fetching messages:', err);
                        }
                    });
                }

                setInterval(() => {
                    fetchMessages()
                }, 5000);
                fetchMessages();
            </script>
        <?php } else { ?>
            <div class="messenger w-full mx-auto flex justify-center items-center h-full">
                <div class="chat-layout flex flex-col items-center gap-4 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-16 h-16 text-gray-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 10h.01M12 14h.01M16 10h.01M21 16.58A16.88 16.88 0 0012 3a16.88 16.88 0 00-9 13.58M5.61 21a17.34 17.34 0 0012.78 0M15 19l-3 3m0 0l-3-3m3 3V10" />
                    </svg>
                    <h2 class="text-gray-600 font-semibold text-lg">
                        Select a user to start a conversation
                    </h2>
                    <p class="text-gray-500 text-sm">
                        Pick someone from the sidebar to send your first message.
                    </p>
                </div>
            </div>

        <?php } ?>
        </div>

        <script>
            const editProfileBtn = document.getElementById('editProfileBtn');
            const editProfileModal = document.getElementById('editProfileModal');
            const cancelEdit = document.getElementById('cancelEdit');
            const editProfileForm = document.getElementById('editProfileForm');

            $('#send-message').on('keypress', function(e) {
                if (e.which === 13 && !e.shiftKey) {
                    e.preventDefault();
                    const message = $(this).val().trim();
                    if (message !== '') {
                        sendMessage(message);
                        $(this).val('');
                    }
                }
            });

            function sendMessage(message) {
                $.ajax({
                    url: './controller/send_message.php',
                    method: 'POST',
                    data: {
                        message: message,
                    },
                    success: function(response) {
                        console.log('Message sent:', response);
                    },
                    error: function(xhr, status, error) {
                        console.error('Message send failed:', error);
                    }
                });
            };

            editProfileBtn.addEventListener('click', () => {
                editProfileModal.classList.remove('hidden');
            });

            cancelEdit.addEventListener('click', () => {
                editProfileModal.classList.add('hidden');
            });

            editProfileForm.addEventListener('submit', (e) => {
                e.preventDefault();

                const formData = new FormData(editProfileForm);

                fetch('./controller/update_profile.php', {
                        method: 'POST',
                        body: formData,
                    })
                    .then(response => response.text())
                    .then(data => {
                        alert(data);
                        location.reload();
                    })
                    .catch(error => console.error('Error:', error));
            });
            document.getElementById('show-profile').addEventListener('click', () => {
                document.getElementById('profile').classList.remove('hidden');
            });

            document.getElementById('close-profile').addEventListener('click', () => {
                document.getElementById('profile').classList.add('hidden');
            });


            const tabs = document.querySelectorAll(".tab");

            tabs.forEach((tab) => {
                tab.addEventListener("click", () => {
                    if (tab.getAttribute("data-tab") === "home") {
                        window.location.href = "./index.php?tab=home"
                    }
                    tabs.forEach((t) => t.classList.remove("active"));

                    tab.classList.add("active");
                });
            });

            function fetchUsers() {
                $.ajax({
                    url: './controller/fetch_users.php',
                    method: 'GET',
                    success: function(data) {
                        $('#chats-container').html(data);
                        Array.from(document.getElementsByClassName('user-chat')).forEach((chat) => {
                            chat.addEventListener('click', () => {
                                window.location.href = `./index.php?chat_id=${chat.getAttribute('data-id')}`
                            });
                        });
                    },
                    error: function(err) {
                        console.error('Error fetching users:', err);
                    }
                });
            }

            setInterval(fetchUsers, 5000);
            fetchUsers();
        </script>
    </body>

    </html>







<?php } ?>











<!-- <?php

        $query = "
SELECT 
    u.id,
    u.display_name,
    u.profile_picture,
    m.message AS last_message,
    m.timestamp AS last_message_time,
    (SELECT COUNT(*) FROM messages WHERE receiver_id = u.id AND is_read = 0) AS unread_count
FROM users u
LEFT JOIN messages m ON m.receiver_id = u.id
GROUP BY u.id
ORDER BY m.timestamp DESC
";
        $result = mysqli_query($conn, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            if ($row["id"] == $_SESSION['user']['id']) {
                continue;
            }
        ?>
                            <div class="flex items-center p-4 h-[70px] hover:bg-gray-100 cursor-pointer">
                                <img src="<?= htmlspecialchars($row['profile_picture']) ?>" alt="<?= htmlspecialchars($row['display_name']) ?>" class="w-10 h-10 rounded-full mr-4" />
                                <div class="flex flex-col gap-[3px] w-full">
                                    <h3 class="text-gray-800 text-sm font-semibold"><?= htmlspecialchars($row['display_name']) ?></h3>
                                    <p class="text-xs text-gray-500 w-[160px] overflow-hidden text-ellipsis whitespace-nowrap">
                                        <?= !empty($row['last_message']) ? htmlspecialchars($row['last_message']) : 'No messages yet...' ?>
                                    </p>
                                </div>
                                <div class="flex flex-col items-end w-[40%] gap-2">
                                    <span class="text-xs text-gray-400 pb-2">
                                        <?php
                                        if (!empty($row['last_message_time'])) {
                                            $lastMessageTime = strtotime($row['last_message_time']);
                                            echo date('g:i A', $lastMessageTime);
                                        } else {
                                            echo 'No messages';
                                        }
                                        ?>
                                    </span>
                                    <?php
                                    echo $row['unread_count'] > 0 ? "<span class='text-sm text-white bg-orange-600 py-[2px] px-2 rounded-full'>
                                          {$row['unread_count']}
                                    </span>" : '' ?>
                                </div>
                            </div>
                        <?php
                    }
                        ?> -->
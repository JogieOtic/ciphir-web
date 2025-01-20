<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('img/Web System logo.png') }}" type="image/png">

    <title>@yield('title', 'Profile')</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.4/flowbite.min.js"></script>
    <script src="https://kit.fontawesome.com/e7ad46b0ff.js" crossorigin="anonymous"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body style="
    background-image: url('{{ asset('img/NAGACITY.jpg') }}');
    background-size: cover;
    background-position: center;"
    class="font-inter tracking-wider">
    <div>
		<x-status />
	</div>
    <div class="w-screen h-screen grid backdrop-blur-sm place-items-center bg-transparent">
        <div class="w-full max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8  ">
            <form class="space-y-6" action="{{route('change-username')}}" method="POST">
                @csrf
                @method('PATCH')
                <h5 class="text-xl font-medium text-gray-900 ">Profile Information</h5>
                <div>
                    <label for="username" class="block mb-2 text-sm font-medium text-gray-900 ">Username</label>
                    <input type="oldUsername" name="oldUsername" value="{{$userInfo[0]->Username}}" hidden >
                    <input type="newUsername" name="newUsername" id="username" value="{{$userInfo[0]->Username}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" readonly />
                </div>
                <div>
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 ">Please enter your current password</label>
                    <input type="password" name="password" id="password" placeholder="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"  readonly />
                </div>
                <!-- Edit Button -->
                <button
                type="button"
                id="editButton"
                class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                Edit
                </button>
                <button data-modal-target="default-modal" data-modal-toggle="default-modal"  type="button" id="changePassword" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center disabled:bg-slate-500 disabled:pointer-events-none">Change Password</button>
                <button type="submit" id="saveBtn" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center disabled:bg-slate-500 disabled:pointer-events-none" disabled>Save</button>
            </form>
        </div>
    </div>


    <!-- Main modal -->
    <div id="default-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <form class="space-y-6" action="{{route('change-password')}}" method="POST">
                @csrf
                @method('PATCH')
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                        <h3 class="text-xl font-semibold text-gray-900 backdrop-blur-sm">
                            Change your password
                        </h3>
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="default-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-4 md:p-5 space-y-4">
                        <input type="text" name="Username" value="{{ $userInfo[0]->Username }}" hidden>
                        <!-- Old Password -->
                        <div>
                            <label for="oldPassword" class="block mb-2 text-sm font-medium text-gray-900">Old Password:</label>
                            <input type="password" name="oldPassword" id="old_password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                        </div>

                        <!-- New Password -->
                        <div>
                            <label for="newPassword" class="block mb-2 text-sm font-medium text-gray-900">New Password:</label>
                            <input type="password" name="newPassword" id="new_password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                        </div>

                        <!-- Confirm New Password -->
                        <div>
                            <label for="newPassword" class="block mb-2 text-sm font-medium text-gray-900">Confirm New Password:</label>
                            <input type="password" name="newPassword_confirmation" id="new_password_confirmation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                        </div>
                    </div>


                    <!-- Modal footer -->
                    <div class="flex justify-end p-4 md:p-5 border-t border-gray-200 rounded-b">
                        <button data-modal-hide="default-modal" type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Change Password</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
<script>
    document.getElementById('editButton').addEventListener('click', function () {
        const usernameInput = document.getElementById('username');
        const passwordInput = document.getElementById('password');
        const editBtn = document.getElementById('editButton');
        const save = document.getElementById('saveBtn');
        const changePass = document.getElementById('changePassword');


        // Toggle the "readonly" attribute
        if (usernameInput.hasAttribute('readonly')) {
            usernameInput.removeAttribute('readonly'); // Make it editable
            usernameInput.removeAttribute('required'); // Make it editable
            passwordInput.removeAttribute('readonly'); // Make it editable
            passwordInput.removeAttribute('required'); // Make it editable
            editBtn.textContent = 'Cancel';
            editBtn.style.backgroundColor = '#c70000';
            changePass.setAttribute('disabled', true);
            save.removeAttribute('disabled');
            usernameInput.focus(); // Optionally focus the input field
        console.log(changePass);

        } else {
            usernameInput.setAttribute('readonly', true); // Make it read-only again
            passwordInput.setAttribute('readonly', true); // Make it read-only again
            editBtn.textContent = 'Edit';
            save.setAttribute('disabled', true);
            changePass.removeAttribute('disabled');
            editBtn.style.backgroundColor = 'rgb(37 99 235)';
        }
    });
</script>

</html>
